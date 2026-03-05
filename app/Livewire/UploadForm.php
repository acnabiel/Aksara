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

        // Validate based on type and edit mode
        $fileRules = $this->editId
            ? ($this->type === 'photo' ? $this->editPhotoRules : $this->editVideoRules)
            : ($this->type === 'photo' ? $this->photoRules : $this->videoRules);

        if (!$this->isAdmin) {
            $this->category = Auth::user()->name;
        }

        $this->validate(array_merge([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string|max:1000',
            'category' => 'required|string|max:100',
            'type' => 'required|in:photo,video',
        ], $fileRules));

        if (!$this->isAdmin) {
            $finalCategory = Auth::user()->name;
        } else {
            $finalCategory = $this->category === '__custom__' ? $this->customCategory : $this->category;
        }

        if (!$finalCategory) {
            $this->addError('category', 'Kategori harus diisi.');
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
        $temporaryPath = $this->file->getRealPath();
        
        if ($this->type === 'video') {
            $compressedPath = $this->getTempPath();
            $this->compressVideo($temporaryPath, $compressedPath);
            
            $finalPath = 'galleries/videos/' . basename($compressedPath);
            \Illuminate\Support\Facades\Storage::disk('public')->put($finalPath, file_get_contents($compressedPath));
            unlink($compressedPath);
        } else {
            // Compress and Resize Photo if large
            $compressedPhotoPath = $this->getTempPath() . '.webp';
            $this->optimizePhoto($temporaryPath, $compressedPhotoPath);
            
            $finalPath = 'galleries/photos/' . basename($compressedPhotoPath);
            \Illuminate\Support\Facades\Storage::disk('public')->put($finalPath, file_get_contents($compressedPhotoPath));
            unlink($compressedPhotoPath);
        }

        Gallery::create([
            'title' => $this->title,
            'description' => $this->description ?: null,
            'file_path' => $finalPath,
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

            $temporaryPath = $this->file->getRealPath();

            if ($this->type === 'video') {
                $compressedPath = $this->getTempPath();
                $this->compressVideo($temporaryPath, $compressedPath);
                
                $finalPath = 'galleries/videos/' . basename($compressedPath);
                \Illuminate\Support\Facades\Storage::disk('public')->put($finalPath, file_get_contents($compressedPath));
                unlink($compressedPath);
            } else {
                // Compress and Resize Photo
                $compressedPhotoPath = $this->getTempPath() . '.webp';
                $this->optimizePhoto($temporaryPath, $compressedPhotoPath);
                
                $finalPath = 'galleries/photos/' . basename($compressedPhotoPath);
                \Illuminate\Support\Facades\Storage::disk('public')->put($finalPath, file_get_contents($compressedPhotoPath));
                unlink($compressedPhotoPath);
            }

            $data['file_path'] = $finalPath;
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

    private function compressVideo(string $source, string $destination): void
    {
        // Use ultrafast preset for maximum speed as requested
        $command = "ffmpeg -i " . escapeshellarg($source) . " -vcodec libx264 -crf 28 -preset ultrafast -acodec mp3 " . escapeshellarg($destination) . " 2>&1";
        
        exec($command, $output, $returnCode);

        if ($returnCode !== 0) {
            \Illuminate\Support\Facades\Log::error("FFmpeg Error: " . implode("\n", $output));
            copy($source, $destination);
        }
    }

    private function optimizePhoto(string $source, string $destination): void
    {
        try {
            // Use GD to resize and convert to WebP for better speed and compression
            $info = getimagesize($source);
            if (!$info) {
                copy($source, $destination);
                return;
            }

            $mime = $info['mime'];
            switch ($mime) {
                case 'image/jpeg': $img = imagecreatefromjpeg($source); break;
                case 'image/png':  $img = imagecreatefrompng($source); break;
                case 'image/webp': $img = imagecreatefromwebp($source); break;
                case 'image/gif':  $img = imagecreatefromgif($source); break;
                default: copy($source, $destination); return;
            }

            if (!$img) {
                copy($source, $destination);
                return;
            }

            // Max dimensions (e.g. 1920px)
            $maxWidth = 1920;
            $maxHeight = 1920;
            $width = imagesx($img);
            $height = imagesy($img);

            if ($width > $maxWidth || $height > $maxHeight) {
                $ratio = min($maxWidth / $width, $maxHeight / $height);
                $newWidth = (int)($width * $ratio);
                $newHeight = (int)($height * $ratio);
                
                $newImg = imagecreatetruecolor($newWidth, $newHeight);
                
                // Preserve transparency for PNG/WebP if needed (though we're converting to WebP)
                imagealphablending($newImg, false);
                imagesavealpha($newImg, true);
                
                imagecopyresampled($newImg, $img, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height);
                imagewebp($newImg, $destination, 80); // 80 quality for good balance
                imagedestroy($newImg);
            } else {
                imagewebp($img, $destination, 80);
            }

            imagedestroy($img);
        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::error("Photo Optimization Error: " . $e->getMessage());
            copy($source, $destination);
        }
    }

    private function getTempPath(): string
    {
        return sys_get_temp_dir() . DIRECTORY_SEPARATOR . 'temp_' . uniqid() . '.mp4';
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
