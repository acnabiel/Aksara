<?php

namespace App\Livewire;

use App\Models\Gallery;
use Illuminate\Support\Facades\Auth;
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

    #[Validate('required|in:photo,video')]
    public string $type = 'photo';

    #[Validate('nullable')]
    public $file = null;

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
        // Override PHP limits at runtime for large video uploads
        // Note: upload_max_filesize & post_max_size are set in .htaccess/.user.ini
        ini_set('max_execution_time', '300');
        ini_set('max_input_time', '300');
        ini_set('memory_limit', '256M');
    }

    public function updatedType(): void
    {
        // Reset file when type changes to avoid invalid file type errors
        $this->file = null;
        $this->resetValidation('file');
    }

    protected array $photoRules = [
        'file' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:10240', // 10MB
    ];

    protected array $videoRules = [
        'file' => 'required|mimetypes:video/mp4,video/mpeg,video/quicktime,video/webm,video/avi|max:102400', // 100MB
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

    public function editItem(int $id): void
    {
        $gallery = Gallery::findOrFail($id);
        $this->editId = $gallery->id;
        $this->title = $gallery->title;
        $this->description = $gallery->description ?? '';
        $this->category = $gallery->category;
        $this->type = $gallery->type;
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
            'type' => 'required|in:photo,video',
        ]);

        if (!$this->file && !$this->editId) {
            $this->addError('file', 'File harus dipilih.');
            $this->isUploading = false;
            return;
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

    private function createItem(string $category): void
    {
        $path = $this->type === 'photo'
            ? $this->file->store('galleries/photos', 'public')
            : $this->file->store('galleries/videos', 'public');

        Gallery::create([
            'title' => $this->title,
            'description' => $this->description ?: null,
            'file_path' => $path,
            'type' => $this->type,
            'category' => $category,
            'file_size' => $this->file->getSize(),
            'user_id' => Auth::id(),
        ]);

        $this->dispatch('toast', [
            'message' => 'Item berhasil ditambahkan!',
            'type' => 'success'
        ]);
        $this->dispatch('gallery-uploaded');
        $this->closeForm();
        $this->isUploading = false;
    }

    private function updateItem(string $category): void
    {
        $gallery = Gallery::findOrFail($this->editId);

        $data = [
            'title' => $this->title,
            'description' => $this->description ?: null,
            'category' => $category,
        ];

        if ($this->file) {
            // Delete old file
            if (\Illuminate\Support\Facades\Storage::disk('public')->exists($gallery->file_path)) {
                \Illuminate\Support\Facades\Storage::disk('public')->delete($gallery->file_path);
            }

            $path = $this->type === 'photo'
                ? $this->file->store('galleries/photos', 'public')
                : $this->file->store('galleries/videos', 'public');

            $data['file_path'] = $path;
            $data['file_size'] = $this->file->getSize();
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
        $this->reset(['title', 'description', 'category', 'customCategory', 'type', 'file', 'editId', 'isUploading']);
        
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
