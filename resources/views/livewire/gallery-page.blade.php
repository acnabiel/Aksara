<div class="min-h-screen">
    {{-- Navigation --}}
    <header class="fixed top-0 left-0 right-0 z-40 glass border-b border-slate-800/50 transition-all duration-300">
        <nav class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16">
                <a href="/" wire:navigate class="flex items-center gap-3 group">
                    <div class="relative w-8 h-8 flex-shrink-0">
                        <img src="{{ asset('image/aksara_logo.png') }}" alt="Logo AKSARA" class="w-full h-full object-contain filter drop-shadow-[0_0_8px_rgba(255,255,255,0.3)] transition-transform duration-500 group-hover:scale-110">
                        <div class="absolute inset-0 bg-primary-400 blur-xl opacity-20 group-hover:opacity-40 transition-opacity"></div>
                    </div>
                    <h1 class="text-xl font-bold font-serif gradient-text tracking-tight">AKSARA</h1>
                </a>

                {{-- Desktop Nav --}}
                <div class="hidden md:flex items-center gap-6">
                    <a href="/" wire:navigate class="text-sm text-slate-300 hover:text-white transition-colors">Beranda</a>
                    <a href="#gallery" class="text-sm text-slate-300 hover:text-white transition-colors">Galeri</a>
                    @auth
                        <a href="{{ route('admin.dashboard') }}" wire:navigate class="text-sm px-4 py-2 bg-gradient-to-r from-primary-600/80 to-primary-500/80 border border-primary-500/30 rounded-xl text-white hover:from-primary-500 hover:to-primary-400 transition-all">
                            <span class="flex items-center gap-1.5">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zm10 0a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zm10 0a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"/></svg>
                                Dashboard
                            </span>
                        </a>
                    @else
                        <a href="{{ route('login') }}" wire:navigate class="text-sm px-4 py-2 bg-slate-800/80 border border-slate-700/50 rounded-xl text-slate-300 hover:text-white hover:border-slate-600 transition-all">
                            Login Admin
                        </a>
                    @endauth
                </div>

                {{-- Mobile Menu Toggle --}}
                <button @click="mobileMenu = !mobileMenu" class="md:hidden text-slate-300 hover:text-white">
                    <svg x-show="!mobileMenu" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 6h16M4 12h16M4 18h16"/></svg>
                    <svg x-show="mobileMenu" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="display:none"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M6 18L18 6M6 6l12 12"/></svg>
                </button>
            </div>

            {{-- Mobile Menu --}}
            <div x-show="mobileMenu" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 -translate-y-2" x-transition:enter-end="opacity-100 translate-y-0" x-transition:leave="transition ease-in duration-100" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" class="md:hidden pb-4 space-y-2" style="display:none">
                <a href="/" wire:navigate class="block px-4 py-2 text-sm text-slate-300 hover:text-white hover:bg-slate-800/50 rounded-lg transition-colors">Beranda</a>
                <a href="#gallery" @click="mobileMenu = false" class="block px-4 py-2 text-sm text-slate-300 hover:text-white hover:bg-slate-800/50 rounded-lg transition-colors">Galeri</a>
                @auth
                    <a href="{{ route('admin.dashboard') }}" wire:navigate class="block px-4 py-2 text-sm text-primary-300 hover:text-white hover:bg-primary-500/10 rounded-lg transition-colors">Dashboard</a>
                @else
                    <a href="{{ route('login') }}" wire:navigate class="block px-4 py-2 text-sm text-slate-300 hover:text-white hover:bg-slate-800/50 rounded-lg transition-colors">Login Admin</a>
                @endauth
            </div>
        </nav>
    </header>

    {{-- Hero Section --}}
    <section class="relative min-h-screen flex items-center justify-center overflow-hidden bg-slate-950">
        {{-- Video Background --}}
        <div class="absolute inset-0 z-0">
            <video 
                autoplay 
                muted 
                loop 
                playsinline 
                class="w-full h-full object-cover brightness-[0.4] scale-105"
            >
                <source src="{{ asset('image/get.mp4') }}" type="video/mp4">
            </video>
            
            {{-- Film Overlays --}}
            <div class="absolute inset-0 bg-gradient-to-b from-slate-950 via-transparent to-slate-950 opacity-90"></div>
            <div class="absolute inset-0 bg-gradient-to-r from-slate-950/50 via-transparent to-slate-950/50"></div>
            
            {{-- Cinematic Grain --}}
            <div class="absolute inset-0 film-grain opacity-[0.15] mix-blend-overlay pointer-events-none"></div>
            
            {{-- Grid Pattern Overlay --}}
            <div class="absolute inset-0 grid-pattern opacity-10"></div>
        </div>

        <div class="relative z-10 max-w-4xl mx-auto px-4 sm:px-6 text-center pt-20">
            {{-- Badge --}}
            <!-- <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-slate-800/40 border border-slate-700/30 text-xs text-slate-300 mb-8 animate-slide-down backdrop-blur-md">
                <span class="w-1.5 h-1.5 rounded-full bg-emerald-400 animate-pulse-soft"></span>
                Galeri Kenangan Sekolah
            </div> -->

            {{-- Title --}}
            <h1 class="text-4xl sm:text-5xl md:text-8xl font-bold font-serif leading-tight animate-slide-up tracking-tight flex flex-col items-center">
                <!-- <img src="{{ asset('image/aksara_logo.png') }}" alt="Logo" class="w-12 h-12 md:w-24 md:h-24 object-contain filter drop-shadow-[0_0_15px_rgba(255,255,255,0.4)] animate-pulse-soft"> -->
                <div class="flex items-center gap-4 md:gap-8 mb-2">
                    <span class="text-white drop-shadow-2xl">AKSARA</span>
                </div>
                <span class="gradient-text drop-shadow-2xl">SEMKABU</span>
            </h1>

            {{-- Subtitle --}}
            <p class="max-w-2xl mx-auto mt-8 text-base sm:text-lg text-slate-300/80 leading-relaxed animate-slide-up drop-shadow-lg" style="animation-delay: 0.15s;">
               kata demi kata yang kita tulis dibawah langit yang sama—Merakit masa depan dengan segala kenangan yang telah kita jalani bersama
            </p>

            {{-- CTA --}}
            <div class="flex flex-col sm:flex-row items-center justify-center gap-6 mt-12 animate-slide-up" style="animation-delay: 0.3s;">
                <a href="#gallery" class="inline-flex items-center gap-2 px-8 py-4 bg-white text-slate-950 font-bold rounded-2xl transition-all duration-300 transform hover:scale-[1.05] hover:shadow-2xl hover:shadow-white/10 text-sm">
                    Jelajahi Galeri
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"/></svg>
                </a>
                <div class="flex items-center gap-3 text-sm text-slate-400 backdrop-blur-sm px-4 py-2 rounded-xl bg-white/5 border border-white/10">
                    <span class="flex items-center gap-1.5">
                        <svg class="w-4 h-4 text-primary-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                        {{ $totalItems }} Kenangan
                    </span>
                </div>
            </div>
        </div>

        {{-- Scroll Indicator --}}
        <div class="absolute bottom-12 left-1/2 -translate-x-1/2 animate-bounce z-10">
            <a href="#gallery" class="text-white/40 hover:text-white transition-colors">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 14l-7 7m0 0l-7-7m7 7V3"/></svg>
            </a>
        </div>
    </section>

    {{-- Gallery Section --}}
    <section id="gallery" class="relative py-20 px-4 sm:px-6 lg:px-8 mesh-gradient">
        <div class="max-w-7xl mx-auto">
            {{-- Section Header --}}
            <div class="text-center mb-12">
                <h2 class="text-3xl sm:text-4xl font-bold font-serif text-white">
                    Galeri <span class="gradient-text">Kenangan</span>
                </h2>
                <p class="text-slate-400 mt-3 max-w-lg mx-auto text-sm sm:text-base">Telusuri koleksi foto dan video kenangan bersama teman-teman sekolah</p>
            </div>

            {{-- Filters --}}
            <div class="flex flex-wrap items-center justify-center gap-3 mb-10">
                {{-- Type Filters --}}
                <button
                    wire:click="setFilter('')"
                    class="px-4 py-2 text-sm rounded-xl border transition-all duration-300 {{ !$filter ? 'bg-primary-500/20 border-primary-500/40 text-primary-300' : 'border-slate-700/50 text-slate-400 hover:border-slate-600 hover:text-slate-300' }}"
                >
                    Semua
                </button>
                <button
                    wire:click="setFilter('photo')"
                    class="px-4 py-2 text-sm rounded-xl border transition-all duration-300 flex items-center gap-1.5 {{ $filter === 'photo' ? 'bg-emerald-500/20 border-emerald-500/40 text-emerald-300' : 'border-slate-700/50 text-slate-400 hover:border-slate-600 hover:text-slate-300' }}"
                >
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                    Foto
                </button>
                <button
                    wire:click="setFilter('video')"
                    class="px-4 py-2 text-sm rounded-xl border transition-all duration-300 flex items-center gap-1.5 {{ $filter === 'video' ? 'bg-purple-500/20 border-purple-500/40 text-purple-300' : 'border-slate-700/50 text-slate-400 hover:border-slate-600 hover:text-slate-300' }}"
                >
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"/></svg>
                    Video
                </button>

                {{-- Class Filters --}}
                @if($categories->count() > 0)
                    <div class="w-px h-6 bg-slate-700/50 hidden sm:block mx-1"></div>
                    @foreach($categories as $cat)
                        <button
                            wire:click="setCategory('{{ $cat }}')"
                            class="px-3 py-1.5 text-xs rounded-lg border transition-all duration-300 {{ $category === $cat ? 'bg-primary-500/20 border-primary-500/40 text-primary-300' : 'border-slate-700/50 text-slate-500 hover:border-slate-600 hover:text-slate-400' }}"
                        >
                            {{ $cat }}
                        </button>
                    @endforeach
                @endif
            </div>

            {{-- Loading --}}
            <div wire:loading.delay class="flex items-center justify-center py-16">
                <div class="flex items-center gap-3 text-slate-400">
                    <svg class="animate-spin h-6 w-6" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                    </svg>
                    <span class="text-sm">Memuat galeri...</span>
                </div>
            </div>

            {{-- Gallery Grid --}}
            <div wire:loading.remove class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-5">
                @forelse($items as $index => $item)
                    <div
                        class="gallery-item glass rounded-2xl overflow-hidden group cursor-pointer animate-on-scroll"
                        style="transition-delay: {{ ($index % 8) * 0.08 }}s;"
                        wire:click="openLightbox({{ $item->id }})"
                        wire:key="public-gallery-{{ $item->id }}"
                    >
                        {{-- Media --}}
                        <div class="relative aspect-[4/3] overflow-hidden bg-slate-800">
                            @if($item->isPhoto())
                                <img
                                    src="{{ asset('storage/' . $item->file_path) }}"
                                    alt="{{ $item->title }}"
                                    class="w-full h-full object-cover"
                                    loading="lazy"
                                >
                            @else
                                <video
                                    src="{{ asset('storage/' . $item->file_path) }}"
                                    class="w-full h-full object-cover"
                                    preload="metadata"
                                    muted
                                ></video>
                                <div class="video-play-overlay">
                                    <div class="w-14 h-14 rounded-full bg-white/15 backdrop-blur-md flex items-center justify-center border border-white/20 group-hover:scale-110 transition-transform duration-300">
                                        <svg class="w-6 h-6 text-white ml-1" fill="currentColor" viewBox="0 0 24 24"><path d="M8 5v14l11-7z"/></svg>
                                    </div>
                                </div>
                            @endif

                            {{-- Gradient Overlay --}}
                            <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>

                            {{-- Type Badge --}}
                            <div class="absolute top-3 right-3 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                <span class="inline-flex items-center gap-1 px-2 py-1 text-[10px] font-semibold uppercase tracking-wider rounded-lg backdrop-blur-md {{ $item->isPhoto() ? 'bg-emerald-500/20 text-emerald-300 border border-emerald-500/30' : 'bg-purple-500/20 text-purple-300 border border-purple-500/30' }}">
                                    {{ $item->type }}
                                </span>
                            </div>

                            {{-- Hover Info --}}
                            <div class="absolute inset-x-0 bottom-0 p-4 opacity-0 group-hover:opacity-100 transition-all duration-300 transform translate-y-2 group-hover:translate-y-0">
                                <p class="text-white text-sm font-semibold truncate">{{ $item->title }}</p>
                                @if($item->description)
                                    <p class="text-white/70 text-xs mt-1 line-clamp-2">{{ $item->description }}</p>
                                @endif
                            </div>
                        </div>

                        {{-- Info Card --}}
                        <div class="p-4">
                            <h3 class="text-sm font-semibold text-white truncate">{{ $item->title }}</h3>
                            <div class="flex items-center justify-between mt-2">
                                <span class="inline-block px-2 py-0.5 text-[10px] font-medium text-primary-300 bg-primary-500/10 rounded-md border border-primary-500/20">
                                    {{ \Illuminate\Support\Str::startsWith($item->category, 'Kelas') ? $item->category : 'Kelas ' . $item->category }}
                                </span>
                                <span class="text-[10px] text-slate-500">{{ $item->created_at->diffForHumans() }}</span>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full py-24 text-center">
                        <div class="w-24 h-24 mx-auto mb-6 rounded-2xl bg-slate-800/30 border border-slate-700/30 flex items-center justify-center">
                            <svg class="w-12 h-12 text-slate-700" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                        </div>
                        <h3 class="text-xl font-medium text-slate-400">Belum Ada Kenangan</h3>
                        <p class="text-sm text-slate-500 mt-2">Galeri masih kosong. Kenangan indah akan segera hadir!</p>
                    </div>
                @endforelse
            </div>

            {{-- Pagination --}}
            <div class="mt-12">
                {{ $items->links() }}
            </div>
        </div>
    </section>

    {{-- Footer --}}
    <footer class="border-t border-slate-800/50 py-10 px-4 sm:px-6 bg-slate-950">
        <div class="max-w-7xl mx-auto flex flex-col sm:flex-row items-center justify-between gap-4">
            <div class="flex items-center gap-2">
                <img src="{{ asset('image/aksara_logo.png') }}" alt="Logo" class="w-6 h-6 object-contain opacity-80">
                <span class="text-lg font-bold font-serif gradient-text">AKSARA</span>
                <span class="text-xs text-slate-600">•</span>
                <span class="text-xs text-slate-500">Galeri Kenangan Sekolah</span>
            </div>
            <p class="text-xs text-slate-600">&copy; {{ date('Y') }} AKSARA. All rights reserved.</p>
        </div>
    </footer>

    {{-- Lightbox Modal --}}
    @if($lightboxItem)
        <div
            class="lightbox-overlay"
            wire:click.self="closeLightbox"
            x-data
            @keydown.escape.window="$wire.closeLightbox()"
        >
            <div class="relative max-w-5xl w-full mx-4 animate-scale-in">
                {{-- Close Button --}}
                <button
                    wire:click="closeLightbox"
                    class="absolute -top-12 right-0 text-white/60 hover:text-white transition-colors"
                >
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M6 18L18 6M6 6l12 12"/></svg>
                </button>

                {{-- Content --}}
                <div class="rounded-2xl overflow-hidden shadow-2xl">
                    @if($lightboxItem->isPhoto())
                        <img
                            src="{{ asset('storage/' . $lightboxItem->file_path) }}"
                            alt="{{ $lightboxItem->title }}"
                            class="w-full max-h-[80vh] object-contain bg-black"
                        >
                    @else
                        <video
                            src="{{ asset('storage/' . $lightboxItem->file_path) }}"
                            class="w-full max-h-[80vh] bg-black"
                            controls
                            autoplay
                        ></video>
                    @endif
                </div>

                {{-- Info --}}
                <div class="mt-4 text-center">
                    <h3 class="text-lg font-semibold text-white">{{ $lightboxItem->title }}</h3>
                    @if($lightboxItem->description)
                        <p class="text-sm text-slate-400 mt-1">{{ $lightboxItem->description }}</p>
                    @endif
                    <div class="flex items-center justify-center gap-3 mt-3">
                        <span class="px-2.5 py-1 text-xs font-medium text-primary-300 bg-primary-500/10 rounded-lg border border-primary-500/20">{{ \Illuminate\Support\Str::startsWith($lightboxItem->category, 'Kelas') ? $lightboxItem->category : 'Kelas ' . $lightboxItem->category }}</span>
                        <span class="text-xs text-slate-500">{{ $lightboxItem->created_at->format('d M Y') }}</span>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
