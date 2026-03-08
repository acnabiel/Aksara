<?php

namespace App\Livewire;

use App\Models\Student;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

#[Layout('components.layouts.app')]
#[Title('Data Siswa - AKSARA')]
class StudentManager extends Component
{
    use WithPagination, WithFileUploads;

    public string $search = '';
    public bool $showFormModal = false;
    public bool $showDeleteModal = false;
    public ?int $editingId = null;
    public ?int $deleteId = null;

    // Form fields
    public string $name = '';
    public string $instagram = '';
    public string $quote = '';
    public $photo;
    public ?string $existingPhoto = null;

    protected $rules = [
        'name' => 'required|min:3|max:255',
        'instagram' => 'nullable|string|max:255',
        'quote' => 'nullable|string',
        'photo' => 'nullable|image|max:2048', // max 2MB
    ];

    public function updatingSearch(): void
    {
        $this->resetPage();
    }

    public function create(): void
    {
        $this->resetValidation();
        $this->reset(['editingId', 'name', 'instagram', 'quote', 'photo', 'existingPhoto']);
        $this->showFormModal = true;
    }

    public function edit(int $id): void
    {
        $this->resetValidation();
        $this->reset(['photo']);
        
        $student = Student::findOrFail($id);
        
        // Ownership check
        if (!Auth::user()->email === 'admin@aksara.com' && !Auth::user()->email === 'admin@aksara.sch.id') {
            if ($student->user_id !== Auth::id()) {
                $this->dispatch('toast', ['message' => 'Akses ditolak.', 'type' => 'error']);
                return;
            }
        }

        $this->editingId = $student->id;
        $this->name = $student->name;
        $this->instagram = $student->instagram ?? '';
        $this->quote = $student->quote ?? '';
        $this->existingPhoto = $student->photo_path;

        $this->showFormModal = true;
    }

    public function save(): void
    {
        $this->validate();

        $data = [
            'name' => $this->name,
            'instagram' => $this->instagram ? (str_starts_with($this->instagram, '@') ? $this->instagram : '@' . $this->instagram) : null,
            'quote' => $this->quote,
        ];

        if ($this->photo) {
            if ($this->editingId) {
                $student = Student::find($this->editingId);
                if ($student && $student->photo_path) {
                    Storage::disk('public')->delete($student->photo_path);
                }
            }
            $data['photo_path'] = $this->photo->store('students/photos', 'public');
        }

        if ($this->editingId) {
            $student = Student::findOrFail($this->editingId);
            $student->update($data);
            $message = 'Data siswa berhasil diperbarui!';
        } else {
            $data['user_id'] = Auth::id();
            Student::create($data);
            $message = 'Data siswa berhasil ditambahkan!';
        }

        $this->showFormModal = false;
        $this->dispatch('toast', ['message' => $message, 'type' => 'success']);
        $this->resetPage();
    }

    public function confirmDelete(int $id): void
    {
        $student = Student::findOrFail($id);
        
        // Ownership check
        if (!Auth::user()->email === 'admin@aksara.com' && !Auth::user()->email === 'admin@aksara.sch.id') {
            if ($student->user_id !== Auth::id()) {
                $this->dispatch('toast', ['message' => 'Akses ditolak.', 'type' => 'error']);
                return;
            }
        }

        $this->deleteId = $id;
        $this->showDeleteModal = true;
    }

    public function delete(): void
    {
        if (!$this->deleteId) return;

        $student = Student::find($this->deleteId);
        
        if ($student) {
            if ($student->photo_path) {
                Storage::disk('public')->delete($student->photo_path);
            }
            $student->delete();
            $this->dispatch('toast', ['message' => 'Data siswa berhasil dihapus!', 'type' => 'success']);
        }

        $this->showDeleteModal = false;
        $this->deleteId = null;
        $this->resetPage();
    }

    public function closeFormModal(): void
    {
        $this->showFormModal = false;
        $this->resetValidation();
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
        $isAdmin = Auth::user()->email === 'admin@aksara.com' || Auth::user()->email === 'admin@aksara.sch.id';
        
        $query = Student::query();

        if (!$isAdmin) {
            $query->where('user_id', Auth::id());
        } else {
            // Admin can see all, maybe we load the associated class
            $query->with('user');
        }

        if ($this->search) {
            $query->where('name', 'like', '%' . $this->search . '%')
                  ->orWhere('instagram', 'like', '%' . $this->search . '%');
        }

        return view('livewire.student-manager', [
            'students' => $query->latest()->paginate(12),
            'isAdmin' => $isAdmin,
        ]);
    }
}
