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
                    <button wire:click="logout" class="text-sm text-slate-400 hover:text-red-400 transition-colors flex items-center gap-1.5">
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

                <div class="w-full h-px bg-gradient-to-r from-transparent via-slate-700/50 to-transparent mb-6 relative z-10"></div>

                <h3 class="text-[11px] font-bold text-slate-500 uppercase tracking-[0.2em] mb-4 px-2 relative z-10">Kategori Album</h3>
                <ul class="space-y-1.5 relative z-10">
                    <li>
                        <button wire:click="setAlbum('')" class="w-full flex items-center gap-3 px-3 py-2.5 rounded-xl transition-all duration-300 {{ $filterAlbum === '' ? 'bg-gradient-to-r from-primary-500/20 to-transparent text-primary-400 border border-primary-500/30 shadow-[0_0_15px_rgba(14,165,233,0.15)]' : 'text-slate-400 hover:bg-slate-800/50 hover:text-white border border-transparent hover:border-slate-700/50' }}">
                            <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/></svg>
                            <span class="text-sm font-medium text-left">Semua Postingan</span>
                        </button>
                    </li>
                    <li>
                        <button wire:click="setAlbum('Foto Profile')" class="w-full flex items-center gap-3 px-3 py-2.5 rounded-xl transition-all duration-300 {{ $filterAlbum === 'Foto Profile' ? 'bg-gradient-to-r from-primary-500/20 to-transparent text-primary-400 border border-primary-500/30 shadow-[0_0_15px_rgba(14,165,233,0.15)]' : 'text-slate-400 hover:bg-slate-800/50 hover:text-white border border-transparent hover:border-slate-700/50' }}">
                            <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                            <span class="text-sm font-medium text-left truncate">Foto Profile</span>
                        </button>
                    </li>
                    <li>
                        <button wire:click="setAlbum('Foto Grub')" class="w-full flex items-center gap-3 px-3 py-2.5 rounded-xl transition-all duration-300 {{ $filterAlbum === 'Foto Grub' ? 'bg-gradient-to-r from-primary-500/20 to-transparent text-primary-400 border border-primary-500/30 shadow-[0_0_15px_rgba(14,165,233,0.15)]' : 'text-slate-400 hover:bg-slate-800/50 hover:text-white border border-transparent hover:border-slate-700/50' }}">
                            <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                            <span class="text-sm font-medium text-left truncate">Foto Grub</span>
                        </button>
                    </li>
                    <li>
                        <button wire:click="setAlbum('Foto Lapangan')" class="w-full flex items-center gap-3 px-3 py-2.5 rounded-xl transition-all duration-300 {{ $filterAlbum === 'Foto Lapangan' ? 'bg-gradient-to-r from-primary-500/20 to-transparent text-primary-400 border border-primary-500/30 shadow-[0_0_15px_rgba(14,165,233,0.15)]' : 'text-slate-400 hover:bg-slate-800/50 hover:text-white border border-transparent hover:border-slate-700/50' }}">
                            <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                            <span class="text-sm font-medium text-left truncate">Foto Lapangan</span>
                        </button>
                    </li>
                    <li>
                        <button wire:click="setAlbum('Foto dan Vidio Random')" class="w-full flex items-center gap-3 px-3 py-2.5 rounded-xl transition-all duration-300 {{ $filterAlbum === 'Foto dan Vidio Random' ? 'bg-gradient-to-r from-primary-500/20 to-transparent text-primary-400 border border-primary-500/30 shadow-[0_0_15px_rgba(14,165,233,0.15)]' : 'text-slate-400 hover:bg-slate-800/50 hover:text-white border border-transparent hover:border-slate-700/50' }}">
                            <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                            <span class="text-sm font-medium text-left truncate">Foto & Vidio Random</span>
                        </button>
                    </li>
                </ul>
            </div>
        </aside>

        {{-- Main Content --}}
        <main class="flex-1 min-w-0">
        {{-- Stats Cards --}}
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 mb-8 animate-fade-in">
            {{-- Total Items --}}
            <div class="glass rounded-xl p-5 transition-all duration-300 hover:border-slate-700/50">
                <div class="flex items-center gap-4">
                    <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-primary-500/20 to-primary-600/20 flex items-center justify-center border border-primary-500/20">
                        <svg class="w-6 h-6 text-primary-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/></svg>
                    </div>
                    <div>
                        <p class="text-2xl font-bold text-white">{{ $totalItems }}</p>
                        <p class="text-xs text-slate-400 uppercase tracking-wider">Total Item</p>
                    </div>
                </div>
            </div>

            {{-- Photos --}}
            <div class="glass rounded-xl p-5 transition-all duration-300 hover:border-slate-700/50">
                <div class="flex items-center gap-4">
                    <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-emerald-500/20 to-emerald-600/20 flex items-center justify-center border border-emerald-500/20">
                        <svg class="w-6 h-6 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                    </div>
                    <div>
                        <p class="text-2xl font-bold text-white">{{ $totalPhotos }}</p>
                        <p class="text-xs text-slate-400 uppercase tracking-wider">Foto</p>
                    </div>
                </div>
            </div>

            {{-- Videos --}}
            <div class="glass rounded-xl p-5 transition-all duration-300 hover:border-slate-700/50">
                <div class="flex items-center gap-4">
                    <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-purple-500/20 to-purple-600/20 flex items-center justify-center border border-purple-500/20">
                        <svg class="w-6 h-6 text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"/></svg>
                    </div>
                    <div>
                        <p class="text-2xl font-bold text-white">{{ $totalVideos }}</p>
                        <p class="text-xs text-slate-400 uppercase tracking-wider">Video</p>
                    </div>
                </div>
            </div>
        </div>

        {{-- Upload Component --}}
        <livewire:upload-form />

        {{-- Filters --}}
        <div class="flex flex-col sm:flex-row items-start sm:items-center gap-4 mb-6 mt-8">
            <div class="relative flex-1 w-full">
                <svg class="absolute left-3.5 top-1/2 -translate-y-1/2 w-4 h-4 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                <input
                    wire:model.live.debounce.300ms="search"
                    type="text"
                    placeholder="Cari berdasarkan judul, deskripsi, atau kategori..."
                    class="w-full pl-10 pr-4 py-2.5 bg-slate-800/50 border border-slate-700/50 rounded-xl text-sm text-white placeholder-slate-500 transition-all duration-300 focus:border-primary-500/50"
                >
            </div>

            <div class="flex items-center gap-3 w-full sm:w-auto">
                <select wire:model.live="filterType" class="bg-slate-800/50 border border-slate-700/50 rounded-xl text-sm text-white px-3 py-2.5 transition-all focus:border-primary-500/50 w-full sm:w-auto">
                    <option value="">Semua Tipe</option>
                    <option value="photo">Foto</option>
                    <option value="video">Video</option>
                </select>

                <select wire:model.live="filterCategory" class="bg-slate-800/50 border border-slate-700/50 rounded-xl text-sm text-white px-3 py-2.5 transition-all focus:border-primary-500/50 w-full sm:w-auto">
                    <option value="">Semua Kelas</option>
                    @foreach($categories as $cat)
                        <option value="{{ $cat }}">{{ $cat }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        {{-- Loading State --}}
        <div wire:loading.delay class="flex items-center justify-center py-8">
            <div class="flex items-center gap-3 text-slate-400">
                <svg class="animate-spin h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                </svg>
                <span class="text-sm">Memuat...</span>
            </div>
        </div>

        {{-- Gallery Grid --}}
        <div wire:loading.remove class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-5">
            @forelse($galleries as $item)
                <div class="gallery-item glass rounded-xl overflow-hidden group" wire:key="gallery-{{ $item->id }}">
                    {{-- Media Preview --}}
                    <div class="relative aspect-[4/3] overflow-hidden bg-slate-800">
                        @if($item->isPhoto())
                            @if($item->isGoogleDrive())
                                <img
                                    src="{{ $item->getDisplayUrl() }}"
                                    alt="{{ $item->title }}"
                                    class="w-full h-full object-cover"
                                    loading="lazy"
                                    referrerpolicy="no-referrer"
                                >
                            @else
                                <img
                                    src="{{ asset('storage/' . $item->file_path) }}"
                                    alt="{{ $item->title }}"
                                    class="w-full h-full object-cover"
                                    loading="lazy"
                                >
                            @endif
                        @else
                            @if($item->isGoogleDrive())
                                <img
                                    src="{{ $item->getGoogleDriveThumbnailUrl() }}"
                                    alt="{{ $item->title }}"
                                    class="w-full h-full object-cover"
                                    loading="lazy"
                                    referrerpolicy="no-referrer"
                                >
                            @else
                                <video
                                    src="{{ asset('storage/' . $item->file_path) }}"
                                    class="w-full h-full object-cover"
                                    preload="metadata"
                                ></video>
                            @endif
                            <div class="video-play-overlay">
                                <div class="w-12 h-12 rounded-full bg-white/20 backdrop-blur-sm flex items-center justify-center border border-white/30">
                                    <svg class="w-5 h-5 text-white ml-0.5" fill="currentColor" viewBox="0 0 24 24"><path d="M8 5v14l11-7z"/></svg>
                                </div>
                            </div>
                        @endif

                        {{-- Type Badge --}}
                        <div class="absolute top-3 left-3">
                            <span class="inline-flex items-center gap-1 px-2 py-1 text-[10px] font-semibold uppercase tracking-wider rounded-lg {{ $item->isPhoto() ? 'bg-emerald-500/20 text-emerald-300 border border-emerald-500/30' : 'bg-purple-500/20 text-purple-300 border border-purple-500/30' }} backdrop-blur-sm">
                                @if($item->isPhoto())
                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                @else
                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"/></svg>
                                @endif
                                {{ $item->type }}
                            </span>
                        </div>

                        {{-- Source Badge --}}
                        @if($item->isGoogleDrive())
                            <div class="absolute top-3 right-3">
                                <span class="inline-flex items-center gap-1 px-2 py-1 text-[10px] font-semibold rounded-lg bg-blue-500/20 text-blue-300 border border-blue-500/30 backdrop-blur-sm">
                                    <svg class="w-3 h-3" viewBox="0 0 24 24" fill="currentColor"><path d="M4.433 22l3.091-5.356h12.943L17.376 22H4.433zm6.837-10.2L4.433 2h6.163l6.837 9.8h-6.163zm1.57.9l-3.091 5.356L3.6 7.656l3.091-5.356L12.84 12.7z"/></svg>
                                    Drive
                                </span>
                            </div>
                        @endif

                        {{-- Actions Overlay --}}
                        <div class="absolute inset-x-0 bottom-0 p-3 bg-gradient-to-t from-black/80 via-black/40 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-end justify-end gap-2">
                            <button
                                wire:click="$dispatchTo('upload-form', 'editItem', { id: {{ $item->id }} })"
                                class="w-8 h-8 rounded-lg bg-white/10 backdrop-blur-sm border border-white/20 flex items-center justify-center text-white hover:bg-primary-500/50 transition-all"
                                title="Edit"
                            >
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                            </button>
                            <button
                                wire:click="confirmDelete({{ $item->id }})"
                                class="w-8 h-8 rounded-lg bg-white/10 backdrop-blur-sm border border-white/20 flex items-center justify-center text-white hover:bg-red-500/50 transition-all"
                                title="Hapus"
                            >
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                            </button>
                        </div>
                    </div>

                    {{-- Info --}}
                    <div class="p-4">
                        <h3 class="text-sm font-semibold text-white truncate">{{ $item->title }}</h3>
                        @if($item->description)
                            <p class="text-xs text-slate-400 mt-1 line-clamp-2">{{ $item->description }}</p>
                        @endif
                        <div class="flex items-center justify-between mt-3">
                            <span class="inline-block px-2 py-0.5 text-[10px] font-medium text-primary-300 bg-primary-500/10 rounded-md border border-primary-500/20">
                                {{ $item->category }}
                            </span>
                            <span class="text-[10px] text-slate-500">{{ $item->formatted_size }}</span>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-full py-20 text-center">
                    <div class="w-20 h-20 mx-auto mb-4 rounded-2xl bg-slate-800/50 border border-slate-700/50 flex items-center justify-center">
                        <svg class="w-10 h-10 text-slate-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                    </div>
                    <h3 class="text-lg font-medium text-slate-400">Belum ada item</h3>
                    <p class="text-sm text-slate-500 mt-1">Mulai upload foto atau video pertama Anda</p>
                </div>
            @endforelse
        </div>

        {{-- Pagination --}}
        <div class="mt-8">
            {{ $galleries->links() }}
        </div>
        </div>
    </main>
    </div>

    {{-- Delete Confirmation Modal --}}
    @if($showDeleteModal)
        <div class="fixed inset-0 z-50 flex items-center justify-center bg-black/60 backdrop-blur-sm animate-fade-in" wire:click.self="cancelDelete">
            <div class="glass rounded-2xl p-6 max-w-sm w-full mx-4 animate-scale-in">
                <div class="text-center">
                    <div class="w-14 h-14 mx-auto mb-4 rounded-full bg-red-500/10 flex items-center justify-center border border-red-500/20">
                        <svg class="w-7 h-7 text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
                    </div>
                    <h3 class="text-lg font-semibold text-white mb-2">Hapus Item?</h3>
                    <p class="text-sm text-slate-400 mb-6">Item yang dihapus tidak dapat dikembalikan. Lanjutkan?</p>
                    <div class="flex gap-3">
                        <button wire:click="cancelDelete" class="flex-1 py-2.5 px-4 rounded-xl border border-slate-700 text-slate-300 text-sm font-medium hover:bg-slate-800 transition-all">
                            Batal
                        </button>
                        <button wire:click="deleteItem" class="flex-1 py-2.5 px-4 rounded-xl bg-red-500/80 hover:bg-red-500 text-white text-sm font-medium transition-all">
                            <span wire:loading.remove wire:target="deleteItem">Hapus</span>
                            <span wire:loading wire:target="deleteItem" class="flex items-center justify-center gap-2">
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
