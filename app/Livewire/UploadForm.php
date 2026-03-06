<?php

namespace App\Livewire;

use App\Models\Gallery;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Attributes\On;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\WithFileUploads;

class UploadForm extends Component
{
    use WithFileUploads;

    #[Validate('required|string|max:255')]
    public string $title = '';

    #[Validate('nullable|string|max:1000')]
    public string $description = '';

    #[Validate('required|string|max:100')]
    public string $category = '';

    public string $customCategory = '';

    #[Validate('required|in:Foto Profile,Foto Grub,Foto Lapangan,Foto dan Vidio Random')]
    public string $album = 'Foto dan Vidio Random';

    #[Validate('required|in:photo,video')]
    public string $type = 'photo';

    // Source: 'upload' or 'gdrive'
    public string $source = 'upload';

    #[Validate('nullable')]
    public $file = null;

    // Google Drive URLs (supports multiple, one per line)
    public string $googleDriveUrl = '';

    public bool $showForm = false;
    public bool $isUploading = false;
    public ?int $editId = null;
    public bool $isAdmin = false;

    public function mount(): void
    {
        $this->isAdmin = Auth::user()->email === 'admin@aksara.com' || Auth::user()->email === 'admin@aksara.sch.id';
        if (!$this->editId && !$this->isAdmin) {
            $this->category = Auth::user()->name;
        }
    }

    public function boot(): void
    {
        ini_set('max_execution_time', '300');
        ini_set('max_input_time', '300');
        ini_set('memory_limit', '256M');
    }

    public function updatedType(): void
    {
        $this->file = null;
        $this->resetValidation('file');
    }

    public function updatedSource(): void
    {
        // Reset file/URL when source changes
        $this->file = null;
        $this->googleDriveUrl = '';
        $this->resetValidation(['file', 'googleDriveUrl']);
    }

    protected array $photoRules = [
        'file' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:10240',
    ];

    protected array $videoRules = [
        'file' => 'required|mimetypes:video/mp4,video/mpeg,video/quicktime,video/webm,video/avi|max:102400',
    ];

    protected array $editPhotoRules = [
        'file' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:10240',
    ];

    protected array $editVideoRules = [
        'file' => 'nullable|mimetypes:video/mp4,video/mpeg,video/quicktime,video/webm,video/avi|max:102400',
    ];

    public function openForm(): void
    {
        $this->resetForm();
        $this->showForm = true;
    }

    public function closeForm(): void
    {
        $this->showForm = false;
        $this->resetForm();
    }

    #[On('editItem')]
    public function editItem($id): void
    {
        $actualId = is_array($id) ? ($id['id'] ?? $id[0] ?? null) : $id;

        if (!$actualId) return;

        $gallery = Gallery::findOrFail($actualId);

        $isOwner = $gallery->user_id === Auth::id() || trim($gallery->category) === trim(Auth::user()->name);

        if (!$this->isAdmin && !$isOwner) {
            $this->dispatch('toast', [
                'message' => 'Anda tidak memiliki akses ke item ini.',
                'type' => 'error'
            ]);
            return;
        }

        $this->resetValidation();
        
        $this->editId = $gallery->id;
        $this->title = $gallery->title;
        $this->description = $gallery->description ?? '';
        $this->category = $gallery->category;
        $this->album = $gallery->album ?? 'Foto dan Vidio Random';
        $this->type = $gallery->type;
        $this->source = $gallery->source ?? 'upload';
        $this->googleDriveUrl = $gallery->google_drive_url ?? '';
        $this->file = null;
        $this->showForm = true;
    }

    public function save(): void
    {
        $this->isUploading = true;

        if (!$this->isAdmin) {
            $this->category = Auth::user()->name;
        }

        $this->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string|max:1000',
            'category' => 'required|string|max:100',
            'album' => 'required|in:Foto Profile,Foto Grub,Foto Lapangan,Foto dan Vidio Random',
            'type' => 'required|in:photo,video',
        ]);

        // Validate based on source
        if ($this->source === 'gdrive') {
            if (empty(trim($this->googleDriveUrl))) {
                $this->addError('googleDriveUrl', 'Link Google Drive harus diisi.');
                $this->isUploading = false;
                return;
            }
            
            // Parse multiple URLs (separated by newlines, commas, or spaces)
            $urls = $this->parseGoogleDriveUrls($this->googleDriveUrl);
            
            if (empty($urls)) {
                $this->addError('googleDriveUrl', 'Tidak ditemukan link Google Drive yang valid.');
                $this->isUploading = false;
                return;
            }

            if ($this->editId && count($urls) > 1) {
                $this->addError('googleDriveUrl', 'Hanya satu link yang diperbolehkan saat mengedit.');
                $this->isUploading = false;
                return;
            }

            // Validate each URL
            foreach ($urls as $index => $url) {
                if (!str_contains($url, 'drive.google.com')) {
                    $this->addError('googleDriveUrl', 'URL ke-' . ($index + 1) . ' bukan link Google Drive yang valid.');
                    $this->isUploading = false;
                    return;
                }
                $fileId = Gallery::extractGoogleDriveFileId($url);
                if (!$fileId) {
                    $this->addError('googleDriveUrl', 'Format link ke-' . ($index + 1) . ' tidak valid. Gunakan link share dari Google Drive.');
                    $this->isUploading = false;
                    return;
                }
            }
        } else {
            // File upload validation
            if (!$this->file && !$this->editId) {
                $this->addError('file', 'File harus dipilih.');
                $this->isUploading = false;
                return;
            }
        }

        $finalCategory = $this->isAdmin 
            ? ($this->category === '__custom__' ? $this->customCategory : $this->category)
            : Auth::user()->name;

        if (!$finalCategory) {
            $this->addError('category', 'Kelas harus diisi.');
            $this->isUploading = false;
            return;
        }

        if ($this->editId) {
            $this->updateItem($finalCategory);
        } else {
            $this->createItem($finalCategory);
        }
    }

    /**
     * Parse Google Drive URLs from input text.
     * Supports URLs separated by newlines, commas, or spaces.
     */
    private function parseGoogleDriveUrls(string $input): array
    {
        // Split by newlines, commas, or multiple spaces
        $parts = preg_split('/[\n\r,]+/', $input);
        
        $urls = [];
        foreach ($parts as $part) {
            $part = trim($part);
            // Further split by spaces if part contains multiple URLs
            $subParts = preg_split('/\s+/', $part);
            foreach ($subParts as $subPart) {
                $subPart = trim($subPart);
                if (!empty($subPart) && str_contains($subPart, 'drive.google.com')) {
                    $urls[] = $subPart;
                }
            }
        }
        
        return array_values(array_unique($urls));
    }

    private function createItem(string $category): void
    {
        if ($this->source === 'gdrive') {
            // Parse and create one gallery entry per URL
            $urls = $this->parseGoogleDriveUrls($this->googleDriveUrl);
            $count = count($urls);
            
            foreach ($urls as $index => $url) {
                $itemTitle = $count > 1 
                    ? $this->title . ' (' . ($index + 1) . ')' 
                    : $this->title;
                
                Gallery::create([
                    'title' => $itemTitle,
                    'description' => $this->description ?: null,
                    'type' => $this->type,
                    'category' => $category,
                    'album' => $this->album,
                    'source' => 'gdrive',
                    'user_id' => Auth::id(),
                    'google_drive_url' => $url,
                    'file_path' => null,
                    'file_size' => 0,
                ]);
            }

            $message = $count > 1 
                ? $count . ' item berhasil ditambahkan dari Google Drive!' 
                : 'Item berhasil ditambahkan!';
        } else {
            $path = $this->type === 'photo'
                ? $this->file->store('galleries/photos', 'public')
                : $this->file->store('galleries/videos', 'public');

            Gallery::create([
                'title' => $this->title,
                'description' => $this->description ?: null,
                'type' => $this->type,
                'category' => $category,
                'album' => $this->album,
                'source' => $this->source,
                'user_id' => Auth::id(),
                'file_path' => $path,
                'file_size' => $this->file->getSize(),
            ]);

            $message = 'Item berhasil ditambahkan!';
        }

        $this->dispatch('toast', [
            'message' => $message,
            'type' => 'success'
        ]);
        $this->dispatch('gallery-uploaded');
        $this->closeForm();
        $this->isUploading = false;
    }

    private function updateItem(string $category): void
    {
        $gallery = Gallery::findOrFail($this->editId);

        $isOwner = $gallery->user_id === Auth::id() || trim($gallery->category) === trim(Auth::user()->name);

        if (!$this->isAdmin && !$isOwner) {
            $this->dispatch('toast', [
                'message' => 'Anda tidak memiliki akses untuk memperbarui item ini.',
                'type' => 'error'
            ]);
            $this->closeForm();
            return;
        }

        $data = [
            'title' => $this->title,
            'description' => $this->description ?: null,
            'category' => $category,
            'album' => $this->album,
            'source' => $this->source,
        ];

        if ($this->source === 'gdrive') {
            // Switching to Google Drive
            $urls = $this->parseGoogleDriveUrls($this->googleDriveUrl);
            $data['google_drive_url'] = !empty($urls) ? $urls[0] : $this->googleDriveUrl;
            
            // Delete old file if switching from upload to gdrive
            if ($gallery->source !== 'gdrive' && $gallery->file_path) {
                if (\Illuminate\Support\Facades\Storage::disk('public')->exists($gallery->file_path)) {
                    \Illuminate\Support\Facades\Storage::disk('public')->delete($gallery->file_path);
                }
            }
            $data['file_path'] = null;
            $data['file_size'] = 0;
        } else {
            // File upload
            if ($this->file) {
                // Delete old file
                if ($gallery->file_path && \Illuminate\Support\Facades\Storage::disk('public')->exists($gallery->file_path)) {
                    \Illuminate\Support\Facades\Storage::disk('public')->delete($gallery->file_path);
                }

                $path = $this->type === 'photo'
                    ? $this->file->store('galleries/photos', 'public')
                    : $this->file->store('galleries/videos', 'public');

                $data['file_path'] = $path;
                $data['file_size'] = $this->file->getSize();
            }
            $data['google_drive_url'] = null;
        }

        $gallery->update($data);

        $this->dispatch('toast', [
            'message' => 'Item berhasil diperbarui!',
            'type' => 'success'
        ]);
        $this->dispatch('gallery-uploaded');
        $this->closeForm();
        $this->isUploading = false;
    }


    private function resetForm(): void
    {
        $this->reset(['title', 'description', 'category', 'customCategory', 'album', 'type', 'file', 'editId', 'isUploading', 'source', 'googleDriveUrl']);
        
        if (!$this->isAdmin) {
            $this->category = Auth::user()->name;
        }
        
        $this->resetValidation();
    }

    public function render()
    {
        $existingCategories = Gallery::select('category')
            ->distinct()
            ->orderBy('category')
            ->pluck('category')
            ->toArray();

        // Default categories
        $defaultCategories = ['Umum', 'Angkatan 2022', 'Angkatan 2023', 'Angkatan 2024', 'Angkatan 2025', 'Kegiatan Sekolah', 'Ekstrakurikuler', 'Wisuda'];

        $allCategories = array_unique(array_merge($defaultCategories, $existingCategories));
        sort($allCategories);

        return view('livewire.upload-form', [
            'allCategories' => $allCategories,
        ]);
    }
}
