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
    public ?int $deleteId = null;
    public bool $showDeleteModal = false;
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

    public function confirmDelete(int $id): void
    {
        try {
            $gallery = Gallery::findOrFail($id);
            
            // Ownership check: Admin or (User ID matches OR Category name matches)
            // Trim comparison to avoid whitespace issues
            $isOwner = $gallery->user_id === Auth::id() || trim($gallery->category) === trim(Auth::user()->name);

            if (!$this->isAdmin && !$isOwner) {
                $this->dispatch('toast', [
                    'message' => 'Anda tidak memiliki akses ke item ini.',
                    'type' => 'error'
                ]);
                return;
            }

            $this->deleteId = $id;
            $this->showDeleteModal = true;
        } catch (\Exception $e) {
            $this->dispatch('toast', [
                'message' => 'Item tidak ditemukan.',
                'type' => 'error'
            ]);
        }
    }

    public function cancelDelete(): void
    {
        $this->reset(['deleteId', 'showDeleteModal']);
    }

    public function deleteItem(): void
    {
        if (!$this->deleteId) {
            $this->cancelDelete();
            return;
        }

        try {
            $gallery = Gallery::findOrFail($this->deleteId);

            // Double check ownership
            $isOwner = $gallery->user_id === Auth::id() || trim($gallery->category) === trim(Auth::user()->name);

            if (!$this->isAdmin && !$isOwner) {
                $this->dispatch('toast', [
                    'message' => 'Anda tidak memiliki akses untuk menghapus item ini.',
                    'type' => 'error'
                ]);
                $this->cancelDelete();
                return;
            }

            // Delete files from storage
            if ($gallery->file_path && Storage::disk('public')->exists($gallery->file_path)) {
                Storage::disk('public')->delete($gallery->file_path);
            }
            if ($gallery->thumbnail_path && Storage::disk('public')->exists($gallery->thumbnail_path)) {
                Storage::disk('public')->delete($gallery->thumbnail_path);
            }

            $gallery->delete();

            $this->cancelDelete();
            $this->resetPage();

            $this->dispatch('toast', [
                'message' => 'Item berhasil dihapus!',
                'type' => 'success'
            ]);
        } catch (\Exception $e) {
            $this->dispatch('toast', [
                'message' => 'Gagal menghapus item: ' . $e->getMessage(),
                'type' => 'error'
            ]);
            $this->cancelDelete();
        }
    }

    #[On('gallery-uploaded')]
    public function refreshList(): void
    {
        // This will refresh the component automatically
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
