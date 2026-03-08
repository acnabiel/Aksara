<div class="min-h-screen bg-slate-950">
    {{-- Sidebar & Header --}}
    <nav class="fixed top-0 left-0 right-0 z-40 glass border-b border-slate-800/50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16">
                {{-- Logo --}}
                <a href="/" wire:navigate class="flex items-center gap-3 group">
                    <img src="{{ asset('image/aksara_logo.png') }}" alt="Logo" class="w-8 h-8 object-contain transition-transform group-hover:scale-110">
                    <h1 class="text-xl font-bold font-serif gradient-text">AKSARA</h1>
                    <span class="hidden sm:inline-block px-2 py-0.5 text-[10px] font-semibold uppercase tracking-wider bg-primary-500/20 text-primary-400 rounded-full border border-primary-500/30">Admin</span>
                </a>

                {{-- Actions --}}
                <div class="flex items-center gap-3">
                    <a href="/" wire:navigate class="text-sm text-slate-400 hover:text-white transition-colors flex items-center gap-1.5" title="Lihat Website">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                        <span class="hidden sm:inline">Website</span>
                    </a>
                    <button wire:click="logout" class="text-sm text-slate-400 hover:text-red-400 transition-colors flex items-center gap-1.5" title="Keluar">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                        <span class="hidden sm:inline">Keluar</span>
                    </button>
                </div>
            </div>
        </div>
    </nav>

    {{-- Main Container --}}
    <div class="pt-24 pb-16 px-4 sm:px-6 lg:px-8 max-w-[1400px] mx-auto flex flex-col md:flex-row gap-6">
        
        {{-- Sidebar --}}
        <aside class="w-full md:w-64 flex-shrink-0 animate-fade-in">
            <div class="glass rounded-xl p-4 sticky top-24 border border-slate-700/50 relative overflow-hidden">
                {{-- Decorative background --}}
                <div class="absolute -top-10 -right-10 w-32 h-32 bg-primary-500/10 rounded-full blur-2xl"></div>
                <div class="absolute -bottom-10 -left-10 w-32 h-32 bg-purple-500/10 rounded-full blur-2xl"></div>
                
                <div class="flex items-center gap-3 mb-6 px-2 relative z-10">
                    <div class="w-10 h-10 rounded-full bg-gradient-to-br from-primary-500/20 to-primary-600/20 flex items-center justify-center border border-primary-500/30 text-primary-400">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                    </div>
                    <div>
                        <p class="text-sm font-semibold text-white truncate max-w-[150px]">{{ Auth::user()->name }}</p>
                        <p class="text-[10px] text-primary-400 font-medium tracking-wide uppercase">{{ $isAdmin ? 'Administrator' : 'Class Dashboard' }}</p>
                    </div>
                </div>

                <div class="w-full h-px bg-gradient-to-r from-transparent via-slate-700/50 to-transparent mb-6 relative z-10"></div>

                <h3 class="text-[11px] font-bold text-slate-500 uppercase tracking-[0.2em] mb-4 px-2 relative z-10">Navigasi Utama</h3>
                <ul class="space-y-1.5 relative z-10 mb-6">
                    <li>
                        <a href="{{ route('admin.dashboard') }}" wire:navigate class="w-full flex items-center gap-3 px-3 py-2.5 rounded-xl transition-all duration-300 {{ request()->routeIs('admin.dashboard') ? 'bg-gradient-to-r from-primary-500/20 to-transparent text-primary-400 border border-primary-500/30 shadow-[0_0_15px_rgba(14,165,233,0.15)]' : 'text-slate-400 hover:bg-slate-800/50 hover:text-white border border-transparent hover:border-slate-700/50' }}">
                            <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                            <span class="text-sm font-medium text-left">Galeri / Album</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.students') }}" wire:navigate class="w-full flex items-center gap-3 px-3 py-2.5 rounded-xl transition-all duration-300 {{ request()->routeIs('admin.students') ? 'bg-gradient-to-r from-primary-500/20 to-transparent text-primary-400 border border-primary-500/30 shadow-[0_0_15px_rgba(14,165,233,0.15)]' : 'text-slate-400 hover:bg-slate-800/50 hover:text-white border border-transparent hover:border-slate-700/50' }}">
                            <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                            <span class="text-sm font-medium text-left">Data Siswa</span>
                        </a>
                    </li>
                </ul>
            </div>
        </aside>

        {{-- Main Content --}}
        <main class="flex-1 min-w-0">
            <div class="flex items-center justify-between mb-8">
                <div>
                    <h2 class="text-2xl font-bold text-white mb-1">Data Siswa</h2>
                    <p class="text-sm text-slate-400">Kelola informasi dan profil siswa untuk kelas {{ $isAdmin ? 'semua' : Auth::user()->name }}</p>
                </div>
                <button wire:click="create" class="flex items-center gap-2 px-4 py-2.5 bg-primary-600 hover:bg-primary-500 text-white rounded-xl text-sm font-semibold transition-all duration-300 shadow-[0_0_20px_rgba(14,165,233,0.3)]">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                    Tambah Siswa
                </button>
            </div>

            {{-- Filters --}}
            <div class="flex flex-col sm:flex-row items-start sm:items-center gap-4 mb-6">
                <div class="relative flex-1 w-full">
                    <svg class="absolute left-3.5 top-1/2 -translate-y-1/2 w-4 h-4 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                    <input
                        wire:model.live.debounce.300ms="search"
                        type="text"
                        placeholder="Cari berdasarkan nama atau instagram..."
                        class="w-full pl-10 pr-4 py-2.5 bg-slate-800/50 border border-slate-700/50 rounded-xl text-sm text-white placeholder-slate-500 transition-all duration-300 focus:border-primary-500/50"
                    >
                </div>
            </div>

            {{-- Loading State --}}
            <div wire:loading.delay wire:target="search" class="flex items-center justify-center py-8">
                <div class="flex items-center gap-3 text-slate-400">
                    <svg class="animate-spin h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                    </svg>
                    <span class="text-sm">Memuat...</span>
                </div>
            </div>

            {{-- Student List --}}
            <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-5" wire:loading.remove wire:target="search">
                @forelse($students as $student)
                    <div class="glass flex flex-col p-5 rounded-xl border border-slate-700/50 group hover:border-primary-500/30 transition-all duration-300">
                        <div class="flex items-start justify-between gap-4 mb-4">
                            <div class="flex items-center gap-3 w-full">
                                <img src="{{ $student->photo_url ?? 'https://ui-avatars.com/api/?name='.urlencode($student->name).'&color=fff&background=0284c7' }}" alt="{{ $student->name }}" class="w-12 h-12 rounded-full object-cover shrink-0 border border-slate-700">
                                <div class="min-w-0">
                                    <h4 class="text-sm font-semibold text-white truncate">{{ $student->name }}</h4>
                                    @if($isAdmin)
                                        <p class="text-xs text-primary-400">{{ $student->user->name }}</p>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="flex-1 space-y-3">
                            @if($student->instagram)
                                <a href="https://instagram.com/{{ ltrim($student->instagram, '@') }}" target="_blank" class="inline-flex items-center gap-1.5 text-xs text-slate-400 hover:text-pink-400 transition-colors">
                                    <svg class="w-4 h-4" viewBox="0 0 24 24" fill="currentColor"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zM12 0C8.741 0 8.333.014 7.053.072 2.695.272.273 2.69.073 7.052.014 8.333 0 8.741 0 12c0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98C8.333 23.986 8.741 24 12 24c3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98C15.668.014 15.259 0 12 0zm0 5.838a6.162 6.162 0 100 12.324 6.162 6.162 0 000-12.324zM12 16a4 4 0 110-8 4 4 0 010 8zm6.406-11.845a1.44 1.44 0 100 2.881 1.44 1.44 0 000-2.88z"/></svg>
                                    {{ $student->instagram }}
                                </a>
                            @endif

                            @if($student->quote)
                                <div class="text-xs text-slate-300 italic flex gap-2 w-full break-words bg-slate-800/30 p-2.5 rounded-lg border border-slate-700/50">
                                    <span class="text-primary-400 font-serif text-lg leading-none">"</span>
                                    <p class="leading-relaxed">{{ $student->quote }}</p>
                                </div>
                            @endif
                        </div>

                        <div class="mt-4 pt-4 border-t border-slate-700/50 flex gap-2 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                            <button wire:click="edit({{ $student->id }})" class="flex-1 py-1.5 px-3 rounded-lg bg-white/5 hover:bg-white/10 text-white text-xs font-medium transition-colors border border-white/10">Edit</button>
                            <button wire:click="confirmDelete({{ $student->id }})" class="flex-1 py-1.5 px-3 rounded-lg bg-red-500/10 hover:bg-red-500/20 text-red-400 text-xs font-medium transition-colors border border-red-500/20">Hapus</button>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full py-16 text-center">
                        <div class="w-16 h-16 mx-auto mb-4 rounded-full bg-slate-800/50 border border-slate-700/50 flex items-center justify-center">
                            <svg class="w-8 h-8 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 4.354A4 4 0 1112 12a4 4 0 010-7.646M12 12v9m0 0a9 9 0 009-9h-9m0 0H3m0 0a9 9 0 009-9v9z"/></svg>
                        </div>
                        <h3 class="text-lg font-medium text-slate-300">Belum ada siswa</h3>
                        <p class="text-sm text-slate-500 mt-1">Tambahkan data siswa untuk kelas ini</p>
                    </div>
                @endforelse
            </div>

            <div class="mt-8">
                {{ $students->links() }}
            </div>
        </main>
    </div>

    {{-- Form Modal --}}
    @if($showFormModal)
        <div class="fixed inset-0 z-50 flex items-center justify-center bg-black/60 backdrop-blur-sm animate-fade-in" wire:click.self="closeFormModal">
            <div class="glass rounded-2xl p-6 md:p-8 max-w-lg w-full mx-4 animate-scale-in max-h-[90vh] overflow-y-auto custom-scrollbar">
                <div class="flex items-center justify-between mb-6">
                    <h3 class="text-xl font-bold text-white">{{ $editingId ? 'Edit Siswa' : 'Tambah Siswa' }}</h3>
                    <button wire:click="closeFormModal" class="text-slate-400 hover:text-white transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
                    </button>
                </div>

                <form wire:submit="save" class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-slate-300 mb-1.5">Nama Lengkap <span class="text-red-400">*</span></label>
                        <input type="text" wire:model="name" class="w-full px-4 py-2.5 bg-slate-800/50 border border-slate-700/50 rounded-xl text-sm text-white placeholder-slate-500 focus:border-primary-500 focus:ring-1 focus:ring-primary-500 transition-all outline-none" placeholder="Masukkan nama...">
                        @error('name') <span class="text-xs text-red-400 mt-1 block">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-slate-300 mb-1.5">Instagram</label>
                        <div class="relative">
                            <span class="absolute left-4 top-1/2 -translate-y-1/2 text-slate-400 text-sm">@</span>
                            <input type="text" wire:model="instagram" class="w-full pl-8 pr-4 py-2.5 bg-slate-800/50 border border-slate-700/50 rounded-xl text-sm text-white placeholder-slate-500 focus:border-primary-500 focus:ring-1 focus:ring-primary-500 transition-all outline-none" placeholder="username">
                        </div>
                        @error('instagram') <span class="text-xs text-red-400 mt-1 block">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-slate-300 mb-1.5">Quote / Pesan Kesan</label>
                        <textarea wire:model="quote" rows="3" class="w-full px-4 py-2.5 bg-slate-800/50 border border-slate-700/50 rounded-xl text-sm text-white placeholder-slate-500 focus:border-primary-500 focus:ring-1 focus:ring-primary-500 transition-all outline-none" placeholder="Tuliskan quote atau pesan..."></textarea>
                        @error('quote') <span class="text-xs text-red-400 mt-1 block">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-slate-300 mb-1.5">Foto Profil</label>
                        <div class="flex items-start gap-4">
                            @if($photo)
                                <img src="{{ $photo->temporaryUrl() }}" class="w-16 h-16 rounded-xl object-cover shrink-0 border border-slate-700">
                            @elseif($existingPhoto)
                                <img src="{{ Storage::url($existingPhoto) }}" class="w-16 h-16 rounded-xl object-cover shrink-0 border border-slate-700">
                            @endif
                            <div class="flex-1">
                                <input type="file" wire:model="photo" accept="image/*" class="w-full text-sm text-slate-400 file:mr-4 file:py-2.5 file:px-4 file:rounded-xl file:border-0 file:text-sm file:font-semibold file:bg-primary-500/10 file:text-primary-400 hover:file:bg-primary-500/20 file:transition-all">
                                <p class="text-[10px] text-slate-500 mt-1">Format: JPG, PNG. Maksimal 2MB.</p>
                            </div>
                        </div>
                        @error('photo') <span class="text-xs text-red-400 mt-1 block">{{ $message }}</span> @enderror
                    </div>

                    <div class="pt-4 flex gap-3">
                        <button type="button" wire:click="closeFormModal" class="flex-1 py-2.5 px-4 rounded-xl border border-slate-700 text-slate-300 text-sm font-medium hover:bg-slate-800 transition-all">Batal</button>
                        <button type="submit" class="flex-1 py-2.5 px-4 rounded-xl bg-primary-600 hover:bg-primary-500 text-white text-sm font-medium transition-all shadow-[0_0_20px_rgba(14,165,233,0.3)]">
                            <span wire:loading.remove wire:target="save">Simpan Data</span>
                            <span wire:loading wire:target="save" class="flex items-center justify-center gap-2">
                                <svg class="animate-spin w-4 h-4" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"></path></svg>
                                Menyimpan...
                            </span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    @endif

    {{-- Delete Confirmation Modal --}}
    @if($showDeleteModal)
        <div class="fixed inset-0 z-50 flex items-center justify-center bg-black/60 backdrop-blur-sm animate-fade-in" wire:click.self="$set('showDeleteModal', false)">
            <div class="glass rounded-2xl p-6 max-w-sm w-full mx-4 animate-scale-in">
                <div class="text-center">
                    <div class="w-14 h-14 mx-auto mb-4 rounded-full bg-red-500/10 flex items-center justify-center border border-red-500/20">
                        <svg class="w-7 h-7 text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
                    </div>
                    <h3 class="text-lg font-semibold text-white mb-2">Hapus Data Siswa?</h3>
                    <p class="text-sm text-slate-400 mb-6">Data yang dihapus tidak dapat dikembalikan. Lanjutkan?</p>
                    <div class="flex gap-3">
                        <button wire:click="$set('showDeleteModal', false)" class="flex-1 py-2.5 px-4 rounded-xl border border-slate-700 text-slate-300 text-sm font-medium hover:bg-slate-800 transition-all">Batal</button>
                        <button wire:click="delete" class="flex-1 py-2.5 px-4 rounded-xl bg-red-500/80 hover:bg-red-500 text-white text-sm font-medium transition-all">
                            <span wire:loading.remove wire:target="delete">Hapus</span>
                            <span wire:loading wire:target="delete" class="flex items-center justify-center gap-2">
                                <svg class="animate-spin h-4 w-4" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"></path></svg>
                                Menghapus...
                            </span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
