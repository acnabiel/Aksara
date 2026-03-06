<?php

namespace App\Livewire;

use App\Models\Gallery as GalleryModel;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout('components.layouts.app')]
#[Title('AKSARA - Galeri Kenangan Sekolah')]
class GalleryPage extends Component
{
    use WithPagination;

    public string $filter = '';
    public string $category = '';
    public string $album = '';

    protected $queryString = [
        'filter' => ['except' => ''],
        'category' => ['except' => ''],
        'album' => ['except' => ''],
    ];

    public ?int $lightboxId = null;

    public function updatingFilter(): void
    {
        $this->resetPage();
    }

    public function updatingCategory(): void
    {
        $this->resetPage();
    }

    public function updatingAlbum(): void
    {
        $this->resetPage();
    }

    public function setFilter(string $type): void
    {
        $this->filter = $this->filter === $type ? '' : $type;
        $this->resetPage();
    }

    public function setCategory(string $cat): void
    {
        $this->category = $this->category === $cat ? '' : $cat;
        $this->resetPage();
    }

    public function setAlbum(string $alb): void
    {
        $this->album = $this->album === $alb ? '' : $alb;
        $this->resetPage();
    }

    public function openLightbox(int $id): void
    {
        $this->lightboxId = $id;
    }

    public function closeLightbox(): void
    {
        $this->lightboxId = null;
    }

    public function render()
    {
        $query = GalleryModel::query()->latest();

        if ($this->filter) {
            $query->where('type', $this->filter);
        }

        if ($this->category) {
            $query->where('category', $this->category);
        }

        if ($this->album) {
            $query->where('album', $this->album);
        }

        $categories = GalleryModel::select('category')
            ->distinct()
            ->orderBy('category')
            ->pluck('category');

        $lightboxItem = $this->lightboxId ? GalleryModel::find($this->lightboxId) : null;

        return view('livewire.gallery-page', [
            'items' => $query->paginate(12),
            'categories' => $categories,
            'lightboxItem' => $lightboxItem,
            'totalItems' => GalleryModel::count(),
        ]);
    }
}
