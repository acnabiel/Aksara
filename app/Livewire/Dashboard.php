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
    public ?int $deleteId = null;
    public bool $showDeleteModal = false;

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

    public function confirmDelete(int $id): void
    {
        $this->deleteId = $id;
        $this->showDeleteModal = true;
    }

    public function cancelDelete(): void
    {
        $this->deleteId = null;
        $this->showDeleteModal = false;
    }

    public function deleteItem(): void
    {
        if ($this->deleteId) {
            $gallery = Gallery::findOrFail($this->deleteId);

            // Delete files from storage
            if (Storage::disk('public')->exists($gallery->file_path)) {
                Storage::disk('public')->delete($gallery->file_path);
            }
            if ($gallery->thumbnail_path && Storage::disk('public')->exists($gallery->thumbnail_path)) {
                Storage::disk('public')->delete($gallery->thumbnail_path);
            }

            $gallery->delete();

            $this->showDeleteModal = false;
            $this->deleteId = null;

            $this->dispatch('toast', message: 'Item berhasil dihapus!', type: 'success');
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
        $this->redirect('/', navigate: true);
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

        if ($this->filterType) {
            $query->where('type', $this->filterType);
        }

        if ($this->filterCategory) {
            $query->where('category', $this->filterCategory);
        }

        $categories = Gallery::select('category')->distinct()->orderBy('category')->pluck('category');

        return view('livewire.dashboard', [
            'galleries' => $query->paginate(12),
            'categories' => $categories,
            'totalPhotos' => Gallery::where('type', 'photo')->count(),
            'totalVideos' => Gallery::where('type', 'video')->count(),
            'totalItems' => Gallery::count(),
        ]);
    }
}
