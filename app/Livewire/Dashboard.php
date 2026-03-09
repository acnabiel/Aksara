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
     * Download a file from Google Drive using cURL.
     * Handles redirect confirmations for large files.
     * Returns the path to the downloaded temp file, or null on failure.
     */
    private function downloadGoogleDriveFile(Gallery $gallery, string $downloadsPath): ?string
    {
        $downloadUrl = $gallery->getGoogleDriveDownloadUrl();
        if (!$downloadUrl) return null;

        $extension = $gallery->getDownloadExtension();
        $safeTitle = preg_replace('/[^a-zA-Z0-9_\-]/', '_', $gallery->title);
        $filename = ($safeTitle ?: 'gdrive_file') . "_{$gallery->id}.{$extension}";
        $tmpFilePath = $downloadsPath . '/' . $filename;

        // Use cURL to download with redirect following
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $downloadUrl);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_MAXREDIRS, 10);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_TIMEOUT, 120);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 30);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36');
        // Handle cookies for large file confirmation
        $cookieFile = $downloadsPath . '/gdrive_cookie_' . $gallery->id . '.tmp';
        curl_setopt($ch, CURLOPT_COOKIEJAR, $cookieFile);
        curl_setopt($ch, CURLOPT_COOKIEFILE, $cookieFile);

        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        // Check for Google Drive virus scan confirmation page (large files)
        if ($response && strpos($response, 'confirm=') !== false) {
            // Extract confirmation token
            if (preg_match('/confirm=([0-9A-Za-z_-]+)/', $response, $matches)) {
                $confirmUrl = $downloadUrl . '&confirm=' . $matches[1];
                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL, $confirmUrl);
                curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
                curl_setopt($ch, CURLOPT_MAXREDIRS, 10);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch, CURLOPT_TIMEOUT, 120);
                curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 30);
                curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
                curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36');
                curl_setopt($ch, CURLOPT_COOKIEFILE, $cookieFile);
                $response = curl_exec($ch);
                $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
                curl_close($ch);
            }
        }

        // Also try the export=download with confirm=t approach
        if (!$response || strlen($response) < 1000) {
            $fileId = Gallery::extractGoogleDriveFileId($gallery->google_drive_url);
            if ($fileId) {
                $altUrl = "https://drive.google.com/uc?export=download&confirm=t&id={$fileId}";
                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL, $altUrl);
                curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
                curl_setopt($ch, CURLOPT_MAXREDIRS, 10);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch, CURLOPT_TIMEOUT, 120);
                curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 30);
                curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
                curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36');
                curl_setopt($ch, CURLOPT_COOKIEFILE, $cookieFile);
                $response = curl_exec($ch);
                $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
                curl_close($ch);
            }
        }

        // Clean up cookie file
        if (file_exists($cookieFile)) @unlink($cookieFile);

        // Save the file if we got meaningful content (more than 500 bytes to rule out error pages)
        if ($response && strlen($response) > 500) {
            file_put_contents($tmpFilePath, $response);
            return $tmpFilePath;
        }

        return null;
    }

    /**
     * Bulk prepare & download files as a ZIP archive.
     * Google Drive files are downloaded directly as real files (jpg/mp4),
     * not as text links.
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

        // Prepare downloads directory
        $downloadsPath = storage_path('app/public/downloads');
        if (!file_exists($downloadsPath)) {
            mkdir($downloadsPath, 0755, true);
        }

        // If only 1 file is selected
        if ($galleries->count() === 1) {
            $gallery = $galleries->first();

            if ($gallery->isGoogleDrive()) {
                // Download the file from Google Drive directly
                $this->dispatch('toast', ['message' => 'Mengunduh file dari Google Drive...', 'type' => 'success']);
                $tmpFile = $this->downloadGoogleDriveFile($gallery, $downloadsPath);

                if ($tmpFile && file_exists($tmpFile)) {
                    $downloadName = basename($tmpFile);
                    return response()->download($tmpFile, $downloadName)->deleteFileAfterSend(true);
                }

                // Fallback: open in new tab if download fails
                $this->dispatch('open-url', ['url' => $gallery->google_drive_url]);
                $this->dispatch('toast', ['message' => 'Gagal mengunduh langsung, membuka link Google Drive...', 'type' => 'warning']);
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
        $zipFileName = 'AKSARA_Files_' . time() . '.zip';
        $zipFile = $downloadsPath . '/' . $zipFileName;

        $addedFiles = 0;
        $filesToZip = [];
        $tempGdriveFiles = []; // Track downloaded gdrive files for cleanup

        // Extract valid files to zip
        foreach ($galleries as $gallery) {
            if ($gallery->isGoogleDrive()) {
                // Download the actual file from Google Drive
                $tmpFile = $this->downloadGoogleDriveFile($gallery, $downloadsPath);
                if ($tmpFile && file_exists($tmpFile)) {
                    $filesToZip[basename($tmpFile)] = $tmpFile;
                    $tempGdriveFiles[] = $tmpFile;
                }
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
                $tmpPath = $downloadsPath . '/' . $filename;
                if ($path !== $tmpPath) {
                    copy($path, $tmpPath);
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
                    if (file_exists($cleanPath) && $cleanPath !== $zipFile) {
                        @unlink($cleanPath);
                    }
                }

                if ($returnCode !== 0) {
                    // Clean up any downloaded gdrive temp files
                    foreach ($tempGdriveFiles as $tmpFile) {
                        if (file_exists($tmpFile)) @unlink($tmpFile);
                    }
                    $this->dispatch('toast', ['message' => 'Gagal membuat file ZIP. Pastikan ekstensi PHP Zip terinstall.', 'type' => 'error']);
                    return;
                }
            }
        }

        // Clean up downloaded Google Drive temp files after zipping
        foreach ($tempGdriveFiles as $tmpFile) {
            if (file_exists($tmpFile)) @unlink($tmpFile);
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
