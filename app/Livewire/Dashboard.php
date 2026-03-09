<?php

namespace App\Livewire;

use App\Models\Gallery;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\Layout;
use Livewire\Attributes\On;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout('components.layouts.app')]
#[Title('Dashboard Admin - AKSARA')]
class Dashboard extends Component
{
    use WithPagination;

    public string $search = '';
    public string $filterType = '';
    public string $filterCategory = '';
    public string $filterAlbum = '';
    public bool $isAdmin = false;

    public function mount(): void
    {
        $this->isAdmin = Auth::user()->email === 'admin@aksara.com' || Auth::user()->email === 'admin@aksara.sch.id';
    }

    public function updatingSearch(): void
    {
        $this->resetPage();
    }

    public function updatingFilterType(): void
    {
        $this->resetPage();
    }

    public function updatingFilterCategory(): void
    {
        $this->resetPage();
    }

    public function updatingFilterAlbum(): void
    {
        $this->resetPage();
    }

    public function setAlbum(string $album): void
    {
        $this->filterAlbum = $album;
        $this->resetPage();
    }

    /**
     * Delete a single item by ID.
     */
    public function deleteItem(int $id): void
    {
        $gallery = Gallery::find($id);
        if (!$gallery) {
            $this->dispatch('toast', ['message' => 'Item tidak ditemukan.', 'type' => 'error']);
            return;
        }

        if (!$this->canManage($gallery)) {
            $this->dispatch('toast', ['message' => 'Anda tidak memiliki akses untuk menghapus item ini.', 'type' => 'error']);
            return;
        }

        $this->deleteGalleryFiles($gallery);
        $gallery->delete();

        $this->resetPage();
        $this->dispatch('toast', ['message' => 'Item berhasil dihapus!', 'type' => 'success']);
    }

    /**
     * Bulk prepare & download files as a ZIP archive
     */
    public function bulkDownload(array $ids)
    {
        if (empty($ids)) {
            $this->dispatch('toast', ['message' => 'Pilih item terlebih dahulu.', 'type' => 'error']);
            return;
        }

        $galleries = Gallery::whereIn('id', $ids)->get();
        if ($galleries->isEmpty()) {
            $this->dispatch('toast', ['message' => 'Item tidak ditemukan.', 'type' => 'error']);
            return;
        }

        $this->dispatch('bulk-action-done');

        // If only 1 file is selected
        if ($galleries->count() === 1) {
            $gallery = $galleries->first();
            
            if ($gallery->isGoogleDrive()) {
                // If it's a Google Drive file, dispatch an event to open it in a new tab
                $this->dispatch('open-url', ['url' => $gallery->google_drive_url]);
                $this->dispatch('toast', ['message' => 'Membuka link Google Drive...', 'type' => 'success']);
                return;
            }

            $path = storage_path('app/public/' . $gallery->file_path);
            if (!file_exists($path)) {
                $this->dispatch('toast', ['message' => 'File tidak ditemukan di server.', 'type' => 'error']);
                return;
            }

            $extension = pathinfo($path, PATHINFO_EXTENSION);
            $safeTitle = preg_replace('/[^a-zA-Z0-9_\-]/', '_', $gallery->title);
            $filename = $safeTitle ? "{$safeTitle}.{$extension}" : basename($path);

            return response()->download($path, $filename);
        }

        // Multiple files logic (ZIP)
        $downloadsPath = storage_path('app/public/downloads');
        if (!file_exists($downloadsPath)) {
            mkdir($downloadsPath, 0755, true);
        }

        $zipFileName = 'AKSARA_Files_' . time() . '.zip';
        $zipFile = $downloadsPath . '/' . $zipFileName;

        $addedFiles = 0;
        $gdriveLinks = [];
        $filesToZip = [];

        // Extract valid files to zip
        foreach ($galleries as $gallery) {
            if ($gallery->isGoogleDrive()) {
                // Save google drive links to be included in a text file
                $gdriveLinks[] = "Title: " . $gallery->title . "\nType: " . $gallery->type . "\nLink: " . $gallery->google_drive_url . "\n------------------------";
                continue; 
            }
            $path = storage_path('app/public/' . $gallery->file_path);
            if (file_exists($path)) {
                $extension = pathinfo($path, PATHINFO_EXTENSION);
                $safeTitle = preg_replace('/[^a-zA-Z0-9_\-]/', '_', $gallery->title);
                $filename = $safeTitle ? "{$safeTitle}_{$gallery->id}.{$extension}" : basename($path);
                $filesToZip[$filename] = $path;
            }
        }

        // Create a temporary text file for Google Drive links if any exist
        $gdriveTxtPath = null;
        if (!empty($gdriveLinks)) {
            $gdriveTxtPath = $downloadsPath . '/Google_Drive_Links_' . time() . '.txt';
            file_put_contents($gdriveTxtPath, "Link Google Drive untuk file yang tidak dapat didownload secara langsung:\n\n" . implode("\n", $gdriveLinks));
            $filesToZip['Link_Google_Drive.txt'] = $gdriveTxtPath;
        }

        if (empty($filesToZip)) {
            $this->dispatch('toast', ['message' => 'Tidak ada file untuk didownload.', 'type' => 'error']);
            return;
        }

        // Attempt to create ZIP using ZipArchive (if PHP extension is installed)
        if (class_exists('ZipArchive')) {
            $zip = new \ZipArchive();
            if ($zip->open($zipFile, \ZipArchive::CREATE | \ZipArchive::OVERWRITE) === TRUE) {
                foreach ($filesToZip as $filename => $path) {
                    $zip->addFile($path, $filename);
                    $addedFiles++;
                }
                $zip->close();
            }
        } else {
            // Fallback: Use OS zip command if ZipArchive is missing
            $chdir = "cd " . escapeshellarg($downloadsPath) . " && ";
            $zipCommandArgs = [];
            
            foreach ($filesToZip as $filename => $path) {
                if ($path !== $downloadsPath . '/' . escapeshellarg($filename)) { // Don't copy if it's already there (like the txt file)
                    $tmpPath = $downloadsPath . '/' . $filename;
                    if ($path !== $tmpPath) {
                       copy($path, $tmpPath);
                    }
                }
                $zipCommandArgs[] = escapeshellarg($filename);
                $addedFiles++;
            }
            
            if ($addedFiles > 0) {
                $command = $chdir . "zip -j -T " . escapeshellarg($zipFileName) . " " . implode(" ", $zipCommandArgs) . " > /dev/null 2>&1";
                exec($command, $output, $returnCode);
                
                // Cleanup temp files
                foreach ($zipCommandArgs as $tmpFile) {
                    $cleanPath = $downloadsPath . '/' . trim($tmpFile, "'\"");
                    if (file_exists($cleanPath) && $cleanPath !== $gdriveTxtPath && $cleanPath !== $zipFile) {
                        @unlink($cleanPath);
                    }
                }
                
                if ($returnCode !== 0) {
                    if ($gdriveTxtPath && file_exists($gdriveTxtPath)) @unlink($gdriveTxtPath);
                    $this->dispatch('toast', ['message' => 'Gagal membuat file ZIP. Pastikan ekstensi PHP Zip terinstall.', 'type' => 'error']);
                    return;
                }
            }
        }

        // Clean up the text file after zipped
        if ($gdriveTxtPath && file_exists($gdriveTxtPath)) {
            @unlink($gdriveTxtPath);
        }

        if ($addedFiles > 0 && file_exists($zipFile)) {
            return response()->download($zipFile)->deleteFileAfterSend(true);
        } else {
            $this->dispatch('toast', ['message' => 'Gagal membuat file ZIP. Ekstensi zip mungkin tidak aktif.', 'type' => 'error']);
        }
    }

    /**
     * Bulk delete items by array of IDs.
     */
    public function bulkDelete(array $ids): void
    {
        if (empty($ids)) {
            $this->dispatch('toast', ['message' => 'Pilih item terlebih dahulu.', 'type' => 'error']);
            return;
        }

        $galleries = Gallery::whereIn('id', $ids)->get();
        $deleted = 0;

        foreach ($galleries as $gallery) {
            if ($this->canManage($gallery)) {
                $this->deleteGalleryFiles($gallery);
                $gallery->delete();
                $deleted++;
            }
        }

        $this->resetPage();
        $this->dispatch('toast', [
            'message' => $deleted . ' item berhasil dihapus!',
            'type' => 'success',
        ]);
        $this->dispatch('bulk-delete-done');
    }

    /**
     * Check whether the current user can manage this gallery item.
     */
    private function canManage(Gallery $gallery): bool
    {
        if ($this->isAdmin) {
            return true;
        }
        if ((int) $gallery->user_id === (int) Auth::id()) {
            return true;
        }
        if (trim($gallery->category) === trim(Auth::user()->name)) {
            return true;
        }
        return false;
    }

    /**
     * Delete local files for a gallery item.
     */
    private function deleteGalleryFiles(Gallery $gallery): void
    {
        if ($gallery->file_path && Storage::disk('public')->exists($gallery->file_path)) {
            Storage::disk('public')->delete($gallery->file_path);
        }
        if ($gallery->thumbnail_path && Storage::disk('public')->exists($gallery->thumbnail_path)) {
            Storage::disk('public')->delete($gallery->thumbnail_path);
        }
    }

    #[On('gallery-uploaded')]
    public function refreshList(): void
    {
        // triggers re-render
    }

    public function logout(): void
    {
        Auth::logout();
        session()->invalidate();
        session()->regenerateToken();
        $this->redirect('/');
    }

    public function render()
    {
        $query = Gallery::query()->latest();

        if ($this->search) {
            $query->where(function ($q) {
                $q->where('title', 'like', '%' . $this->search . '%')
                  ->orWhere('description', 'like', '%' . $this->search . '%')
                  ->orWhere('category', 'like', '%' . $this->search . '%');
            });
        }

        if (!$this->isAdmin) {
            $query->where('category', Auth::user()->name);
        }

        if ($this->filterType) {
            $query->where('type', $this->filterType);
        }

        if ($this->filterCategory) {
            $query->where('category', $this->filterCategory);
        }

        if ($this->filterAlbum) {
            $query->where('album', $this->filterAlbum);
        }

        $categoriesQuery = Gallery::query();
        if (!$this->isAdmin) {
            $categoriesQuery->where('category', Auth::user()->name);
        }
        $categories = $categoriesQuery->select('category')->distinct()->orderBy('category')->pluck('category');

        $countsQuery = Gallery::query();
        if (!$this->isAdmin) {
            $countsQuery->where('category', Auth::user()->name);
        }
        if ($this->filterAlbum) {
            $countsQuery->where('album', $this->filterAlbum);
        }

        return view('livewire.dashboard', [
            'galleries' => $query->paginate(12),
            'categories' => $categories,
            'totalPhotos' => (clone $countsQuery)->where('type', 'photo')->count(),
            'totalVideos' => (clone $countsQuery)->where('type', 'video')->count(),
            'totalItems' => (clone $countsQuery)->count(),
        ]);
    }
}
