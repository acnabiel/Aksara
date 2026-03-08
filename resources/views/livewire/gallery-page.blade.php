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
                    <a href="#tentang-kami" class="text-sm text-slate-300 hover:text-white transition-colors">Tentang Kami</a>
                    <a href="#gallery" class="text-sm text-slate-300 hover:text-white transition-colors">Galeri</a>
                    <a href="/crew" wire:navigate class="text-sm text-slate-300 hover:text-white transition-colors">Crew</a>
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
                <a href="#tentang-kami" @click="mobileMenu = false" class="block px-4 py-2 text-sm text-slate-300 hover:text-white hover:bg-slate-800/50 rounded-lg transition-colors">Tentang Kami</a>
                <a href="#gallery" @click="mobileMenu = false" class="block px-4 py-2 text-sm text-slate-300 hover:text-white hover:bg-slate-800/50 rounded-lg transition-colors">Galeri</a>
                <a href="/crew" wire:navigate class="block px-4 py-2 text-sm text-slate-300 hover:text-white hover:bg-slate-800/50 rounded-lg transition-colors">Crew</a>
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
            {{-- Title --}}
            <h1 class="text-4xl sm:text-5xl md:text-8xl font-bold font-serif leading-tight animate-slide-up tracking-tight flex flex-col items-center">
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

    {{-- Tentang Kami Section --}}
    <section id="tentang-kami" class="relative py-24 px-4 sm:px-6 lg:px-8 overflow-hidden bg-slate-950">
        {{-- Background Decoration --}}
        <div class="absolute inset-0">
            <div class="absolute top-0 left-0 w-96 h-96 bg-primary-500/5 rounded-full blur-3xl -translate-x-1/2 -translate-y-1/2"></div>
            <div class="absolute bottom-0 right-0 w-96 h-96 bg-accent-500/5 rounded-full blur-3xl translate-x-1/2 translate-y-1/2"></div>
            <div class="absolute inset-0 grid-pattern opacity-5"></div>
        </div>

        <div class="relative z-10 max-w-7xl mx-auto">
            {{-- Section Badge --}}
            <div class="flex justify-center mb-12">
                <div class="inline-flex items-center gap-2 px-5 py-2 rounded-full bg-slate-800/40 border border-slate-700/30 text-xs text-slate-300 backdrop-blur-md">
                    <span class="w-1.5 h-1.5 rounded-full bg-primary-400 animate-pulse-soft"></span>
                    Tentang Kami
                </div>
            </div>

            <div class="flex flex-col lg:flex-row items-center gap-12 lg:gap-20">
                {{-- Left: Text Content --}}
                <div class="flex-1 animate-on-scroll">
                    <h2 class="text-4xl sm:text-5xl font-bold font-serif text-white mb-6 leading-tight">
                        Tentang <span class="gradient-text">Kami</span>
                    </h2>

                    <div class="space-y-5 text-slate-300/90 leading-relaxed">
                        <p class="text-base sm:text-lg">
                            <span class="text-white font-semibold">AKSARA SEMKABU</span> adalah angkatan yang Profesional religius dan kreatif yang berkomitmen untuk memberikan pengalaman yang berharga bagi setiap anggota angkatan.
                        </p>
                        <p class="text-sm sm:text-base text-slate-400">
                            kata demi kata yang kita tulis dibawah langit yang sama—Merakit masa depan dengan segala kenangan yang telah kita jalani bersama
                        </p>
                        <p class="text-sm sm:text-base text-slate-400">
                            AKSARA hadir bukan hanya sebagai galeri digital, tetapi juga sebagai tempat di mana setiap cerita, tawa, dan pengalaman bersama teman-teman sekolah terdokumentasi dengan indah. Kata demi kata yang kita tulis bersama di bawah langit yang sama.
                        </p>
                    </div>

                    {{-- Visi & Misi --}}
                    <div class="mt-8 grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div class="about-card glass rounded-2xl p-5 group">
                            <div class="flex items-center gap-3 mb-3">
                                <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-primary-500/20 to-primary-600/20 border border-primary-500/20 flex items-center justify-center group-hover:scale-110 transition-transform duration-300">
                                    <svg class="w-5 h-5 text-primary-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                                </div>
                                <h3 class="text-white font-semibold text-sm">Visi</h3>
                            </div>
                            <p class="text-xs text-slate-400 leading-relaxed">Membangun angkatan yang Profesional religius dan kreatif yang berkomitmen untuk memberikan pengalaman yang berharga bagi setiap anggota angkatan.</p>
                        </div>
                        <div class="about-card glass rounded-2xl p-5 group">
                            <div class="flex items-center gap-3 mb-3">
                                <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-accent-500/20 to-accent-600/20 border border-accent-500/20 flex items-center justify-center group-hover:scale-110 transition-transform duration-300">
                                    <svg class="w-5 h-5 text-accent-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                                </div>
                                <h3 class="text-white font-semibold text-sm">Misi</h3>
                            </div>
                            <p class="text-xs text-slate-400 leading-relaxed">Mengabadikan setiap kenangan indah siswa-siswi SMK Kabupaten.</p>
                        </div>
                    </div>

                    {{-- Stats --}}
                    <div class="mt-8 flex flex-wrap items-center gap-6">
                        <div class="flex items-center gap-3">
                            <div class="w-12 h-12 rounded-xl bg-primary-500/10 border border-primary-500/20 flex items-center justify-center">
                                <svg class="w-6 h-6 text-primary-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                            </div>
                            <div>
                                <p class="text-2xl font-bold text-white">{{ $totalItems }}</p>
                                <p class="text-xs text-slate-500">Total Kenangan</p>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Right: Crew Gallery Slider --}}
                <div class="flex-shrink-0 animate-on-scroll stagger-2 w-full lg:w-auto" x-data="{ swiper: null, initSlider() { setTimeout(() => { const swiperEl = this.$el.querySelector('.crew-swiper'); if (!swiperEl) return; this.swiper = new Swiper(swiperEl, { effect: 'cards', grabCursor: true, speed: 600, loop: true, navigation: { nextEl: this.$el.querySelector('.swiper-button-next'), prevEl: this.$el.querySelector('.swiper-button-prev'), }, autoplay: { delay: 3000, disableOnInteraction: false, pauseOnMouseEnter: true } }); }, 50); } }" x-init="initSlider()" wire:ignore>
                    <div class="relative group mx-auto lg:ml-auto max-w-sm">
                        {{-- Glow Effect --}}
                        <div class="absolute -inset-4 bg-gradient-to-r from-primary-500/20 via-accent-500/10 to-primary-500/20 rounded-3xl blur-2xl opacity-0 group-hover:opacity-100 transition-opacity duration-700"></div>

                        {{-- Card Frame with Swiper --}}
                        <div class="relative">
                            {{-- Decorative border --}}
                            <div class="absolute -inset-1 bg-gradient-to-br from-primary-500/30 via-slate-700/20 to-accent-500/30 rounded-2xl"></div>

                            {{-- Swiper Container --}}
                            <div class="swiper crew-swiper relative rounded-2xl overflow-hidden shadow-2xl shadow-black/50 aspect-[3/4]" style="max-width: 340px;">
                                <div class="swiper-wrapper">
                                    {{-- Crew Member 1 --}}
                                    <div class="swiper-slide cursor-grab active:cursor-grabbing">
                                        <img
                                            src="{{ asset('image/crew/m_bardan_billy.png') }}"
                                            alt="M. Bardan Billy - Ketua Angkatan - Crew of AKSARA"
                                            class="w-full h-full object-cover transition-transform duration-700 hover:scale-[1.03]"
                                            loading="lazy"
                                        >
                                    </div>
                                    
                                    {{-- Crew Member 2 --}}
                                    <div class="swiper-slide cursor-grab active:cursor-grabbing">
                                        <img
                                            src="{{ asset('image/crew/ilham_nabil_hadhani.png') }}"
                                            alt="Ilham Nabil Hadhani - Wakil Ketua Angkatan - Crew of AKSARA"
                                            class="w-full h-full object-cover transition-transform duration-700 hover:scale-[1.03]"
                                            loading="lazy"
                                        >
                                    </div>

                                    {{-- Crew Member 3 --}}
                                    <div class="swiper-slide cursor-grab active:cursor-grabbing">
                                        <img
                                            src="{{ asset('image/crew/aqilazka.png') }}"
                                            alt="Aqilazka - Bendahara - Crew of AKSARA"
                                            class="w-full h-full object-cover transition-transform duration-700 hover:scale-[1.03]"
                                            loading="lazy"
                                        >
                                    </div>

                                    {{-- Crew Member 4 --}}
                                    <div class="swiper-slide cursor-grab active:cursor-grabbing">
                                        <img
                                            src="{{ asset('image/crew/rayhan_nur_ardiansyah_2.png') }}"
                                            alt="Rayhan Nur Ardiansyah - Sekertaris BT - Crew of AKSARA"
                                            class="w-full h-full object-cover transition-transform duration-700 hover:scale-[1.03]"
                                            loading="lazy"
                                        >
                                    </div>

                                    {{-- Crew Member 5 --}}
                                    <div class="swiper-slide cursor-grab active:cursor-grabbing">
                                        <img
                                            src="{{ asset('image/crew/m_galih_amirrullah.png') }}"
                                            alt="M. Galih Amirrullah - Wakil BT - Crew of AKSARA"
                                            class="w-full h-full object-cover transition-transform duration-700 hover:scale-[1.03]"
                                            loading="lazy"
                                        >
                                    </div>
                                </div>
                                
                                {{-- Crew Navigation inside Swiper --}}
                                <div class="swiper-button-prev !w-8 !h-8 !bg-black/40 hover:!bg-primary-500 !rounded-full !text-white after:!text-xs backdrop-blur border border-white/20 transition-all opacity-0 group-hover:opacity-100"></div>
                                <div class="swiper-button-next !w-8 !h-8 !bg-black/40 hover:!bg-primary-500 !rounded-full !text-white after:!text-xs backdrop-blur border border-white/20 transition-all opacity-0 group-hover:opacity-100"></div>
                            </div>
                        </div>

                        {{-- Floating Decorations --}}
                        <div class="absolute -top-6 -right-6 w-12 h-12 rounded-full bg-primary-500/10 border border-primary-500/20 flex items-center justify-center animate-float z-10">
                            <svg class="w-5 h-5 text-primary-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"/></svg>
                        </div>
                        <div class="absolute -bottom-4 -left-4 w-8 h-8 rounded-full bg-accent-500/10 border border-accent-500/20 animate-float z-10" style="animation-delay: 1s;"></div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Bottom Divider --}}
        <div class="absolute bottom-0 left-0 right-0 h-px bg-gradient-to-r from-transparent via-slate-700/50 to-transparent"></div>
    </section>

    {{-- Gallery Section - Masonry/Mosaic Layout --}}
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

            {{-- Album Filters --}}
            <div class="flex flex-wrap items-center justify-center gap-3 mb-10 -mt-6">
                @foreach(['Foto Profile' => '<svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>', 'Foto Grub' => '<svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/></svg>', 'Foto Lapangan' => '<svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>', 'Foto dan Vidio Random' => '<svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>'] as $name => $icon)
                    <button
                        wire:click="setAlbum('{{ $name }}')"
                        class="px-3 py-1.5 text-xs rounded-xl border transition-all duration-300 flex items-center gap-1.5 {{ $album === $name ? 'bg-primary-500/20 border-primary-500/40 text-primary-300' : 'border-slate-700/50 text-slate-500 hover:border-slate-600 hover:text-slate-400' }}"
                    >
                        {!! $icon !!}
                        {{ $name === 'Foto dan Vidio Random' ? 'Random' : $name }}
                    </button>
                @endforeach
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

            {{-- Swiper Gallery Slider --}}
            <div wire:loading.remove 
                 wire:key="slider-wrapper-{{ md5($items->pluck('id')->join(',') . $items->currentPage()) }}"
            >
                <div class="relative w-full max-w-6xl mx-auto py-10" x-data="{ swiper: null, initSlider() { setTimeout(() => { const swiperEl = this.$el.querySelector('.gallery-swiper'); if (!swiperEl) return; this.swiper = new Swiper(swiperEl, { effect: 'slide', grabCursor: true, slidesPerView: 1, spaceBetween: 20, speed: 800, loop: false, pagination: { el: this.$el.querySelector('.swiper-pagination'), clickable: true, dynamicBullets: true, }, navigation: { nextEl: this.$el.querySelector('.swiper-button-next'), prevEl: this.$el.querySelector('.swiper-button-prev'), }, keyboard: { enabled: true, }, autoplay: { delay: 5000, disableOnInteraction: true, pauseOnMouseEnter: true } }); }, 50); } }" x-init="initSlider()" wire:ignore>
                <div class="swiper gallery-swiper rounded-[2rem] overflow-hidden shadow-2xl border border-slate-700/50">
                    <div class="swiper-wrapper">
                        @forelse($items as $index => $item)
                            <div
                                class="swiper-slide group cursor-pointer relative"
                                wire:click="openLightbox({{ $item->id }})"
                                wire:key="slide-{{ $item->id }}"
                            >
                                {{-- Media Container (16:9 Aspect Ratio) --}}
                                <div class="relative w-full aspect-video bg-slate-900">
                                    @if($item->isPhoto())
                                        @if($item->isGoogleDrive())
                                            <img
                                                src="{{ $item->getDisplayUrl() }}"
                                                alt="{{ $item->title }}"
                                                class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105"
                                                loading="lazy"
                                                referrerpolicy="no-referrer"
                                                onerror="this.onerror=null; this.src='data:image/svg+xml,<svg xmlns=%22http://www.w3.org/2000/svg%22 width=%221280%22 height=%22720%22><rect fill=%22%231e293b%22 width=%221280%22 height=%22720%22/><text fill=%22%2394a3b8%22 font-size=%2220%22 x=%2250%25%22 y=%2250%25%22 text-anchor=%22middle%22>Gagal memuat gambar</text></svg>';"
                                            >
                                        @else
                                            <img
                                                src="{{ asset('storage/' . $item->file_path) }}"
                                                alt="{{ $item->title }}"
                                                class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105"
                                                loading="lazy"
                                            >
                                        @endif
                                    @else
                                        @if($item->isGoogleDrive())
                                            <img
                                                src="{{ $item->getGoogleDriveThumbnailUrl() }}"
                                                alt="{{ $item->title }}"
                                                class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105"
                                                loading="lazy"
                                                referrerpolicy="no-referrer"
                                            >
                                        @else
                                            <video
                                                src="{{ asset('storage/' . $item->file_path) }}"
                                                class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105"
                                                preload="metadata"
                                                muted
                                            ></video>
                                        @endif
                                        {{-- Video Play Icon --}}
                                        <div class="absolute inset-0 flex items-center justify-center pointer-events-none z-10">
                                            <div class="w-16 h-16 sm:w-20 sm:h-20 rounded-full bg-primary-500/20 backdrop-blur-md flex items-center justify-center border border-primary-400/50 shadow-lg shadow-primary-500/30 group-hover:scale-110 transition-all duration-500">
                                                <svg class="w-8 h-8 sm:w-10 sm:h-10 text-white ml-1" fill="currentColor" viewBox="0 0 24 24"><path d="M8 5v14l11-7z"/></svg>
                                            </div>
                                        </div>
                                    @endif

                                    {{-- Bottom Dark Overlay for Text --}}
                                    <div class="absolute inset-x-0 bottom-0 h-1/2 bg-gradient-to-t from-slate-950 via-slate-900/60 to-transparent opacity-80 z-10"></div>

                                    {{-- Type Badge (top-right) --}}
                                    <div class="absolute top-4 right-4 sm:top-6 sm:right-6 z-20">
                                        <span class="inline-flex items-center gap-1.5 px-3 py-1 sm:px-4 sm:py-1.5 text-xs sm:text-sm font-bold uppercase tracking-widest rounded-full shadow-lg {{ $item->isPhoto() ? 'bg-emerald-500/90 text-white shadow-emerald-500/20' : 'bg-purple-500/90 text-white shadow-purple-500/20' }}">
                                            {{ $item->type }}
                                        </span>
                                    </div>

                                    {{-- Google Drive Badge --}}
                                    @if($item->isGoogleDrive())
                                        <div class="absolute top-4 left-4 sm:top-6 sm:left-6 z-20">
                                            <span class="inline-flex items-center gap-1.5 px-3 py-1 sm:px-4 sm:py-1.5 text-xs sm:text-sm font-bold rounded-full shadow-lg bg-blue-500/90 text-white shadow-blue-500/20">
                                                <svg class="w-4 h-4" viewBox="0 0 24 24" fill="currentColor"><path d="M4.433 22l3.091-5.356h12.943L17.376 22H4.433zm6.837-10.2L4.433 2h6.163l6.837 9.8h-6.163zm1.57.9l-3.091 5.356L3.6 7.656l3.091-5.356L12.84 12.7z"/></svg>
                                                Drive
                                            </span>
                                        </div>
                                    @endif

                                    {{-- Info at bottom --}}
                                    <div class="absolute inset-x-0 bottom-0 p-6 sm:p-10 z-20 pb-12 sm:pb-16 flex flex-col justify-end">
                                        <h3 class="text-white text-2xl sm:text-4xl font-bold truncate drop-shadow-[0_2px_4px_rgba(0,0,0,0.8)]" title="{{ $item->title }}">{{ $item->title }}</h3>
                                        @if($item->description)
                                            <p class="text-slate-300 mt-2 text-sm sm:text-base line-clamp-2 max-w-3xl drop-shadow-md">{{ $item->description }}</p>
                                        @endif
                                        <div class="flex flex-wrap items-center gap-3 mt-4">
                                            <span class="inline-flex items-center px-3 py-1 text-xs sm:text-sm font-semibold text-white bg-primary-600/80 rounded-lg border border-primary-500/50 backdrop-blur-md shadow-lg">
                                                {{ \Illuminate\Support\Str::startsWith($item->category, 'Kelas') ? $item->category : 'Kelas ' . $item->category }}
                                            </span>
                                            <span class="inline-flex items-center px-3 py-1 text-xs sm:text-sm font-semibold text-white bg-emerald-600/80 rounded-lg border border-emerald-500/50 backdrop-blur-md shadow-lg">
                                                {{ $item->album }}
                                            </span>
                                            <span class="text-xs sm:text-sm text-slate-300 ml-auto font-medium bg-black/40 px-3 py-1 rounded-lg backdrop-blur-sm">{{ $item->created_at->diffForHumans() }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="swiper-slide w-full aspect-video flex flex-col items-center justify-center bg-slate-900 border-2 border-dashed border-slate-700/50 rounded-[2rem]">
                                <div class="w-24 h-24 mx-auto mb-6 rounded-3xl bg-slate-800/50 flex items-center justify-center border border-slate-700/50">
                                    <svg class="w-12 h-12 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                </div>
                                <h3 class="text-3xl font-serif font-semibold text-white">Belum Ada Kenangan</h3>
                                <p class="text-slate-400 mt-2 text-lg">Pilih filter lain atau tambah galeri baru.</p>
                            </div>
                        @endforelse
                    </div>

                    {{-- Navigation Buttons (Now inside the container and smaller/cleaner) --}}
                    @if(count($items) > 1)
                    <div class="swiper-button-prev !text-white !w-12 !h-12 !bg-black/30 hover:!bg-primary-500 hover:!scale-110 !rounded-full !backdrop-blur-md transition-all duration-300 shadow-xl border border-white/20 after:!text-sm !left-4 sm:!left-6 z-30"></div>
                    <div class="swiper-button-next !text-white !w-12 !h-12 !bg-black/30 hover:!bg-primary-500 hover:!scale-110 !rounded-full !backdrop-blur-md transition-all duration-300 shadow-xl border border-white/20 after:!text-sm !right-4 sm:!right-6 z-30"></div>
                    @endif
                    
                    {{-- Pagination Dots (Now inside the bottom edge) --}}
                    <div class="swiper-pagination !bottom-4 sm:!bottom-6 z-30"></div>
                </div>
            </div>
            </div>

            {{-- Pagination --}}
            {{-- Custom Animated Pagination --}}
            <div class="w-full">
                {{ $items->onEachSide(1)->links('livewire.custom-pagination') }}
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
                        @if($lightboxItem->isGoogleDrive())
                            <img
                                src="{{ $lightboxItem->getDisplayUrl() }}"
                                alt="{{ $lightboxItem->title }}"
                                class="w-full max-h-[80vh] object-contain bg-black"
                                referrerpolicy="no-referrer"
                            >
                        @else
                            <img
                                src="{{ asset('storage/' . $lightboxItem->file_path) }}"
                                alt="{{ $lightboxItem->title }}"
                                class="w-full max-h-[80vh] object-contain bg-black"
                            >
                        @endif
                    @else
                        @if($lightboxItem->isGoogleDrive())
                            <iframe
                                src="{{ $lightboxItem->getDisplayUrl() }}"
                                class="w-full bg-black"
                                style="height: 70vh;"
                                allow="autoplay; encrypted-media"
                                allowfullscreen
                                frameborder="0"
                            ></iframe>
                        @else
                            <video
                                src="{{ asset('storage/' . $lightboxItem->file_path) }}"
                                class="w-full max-h-[80vh] bg-black"
                                controls
                                autoplay
                            ></video>
                        @endif
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
                        <span class="px-2.5 py-1 text-xs font-medium text-emerald-300 bg-emerald-500/10 rounded-lg border border-emerald-500/20">{{ $lightboxItem->album }}</span>
                        @if($lightboxItem->isGoogleDrive())
                            <span class="px-2.5 py-1 text-xs font-medium text-blue-300 bg-blue-500/10 rounded-lg border border-blue-500/20 flex items-center gap-1">
                                <svg class="w-3 h-3" viewBox="0 0 24 24" fill="currentColor"><path d="M4.433 22l3.091-5.356h12.943L17.376 22H4.433zm6.837-10.2L4.433 2h6.163l6.837 9.8h-6.163zm1.57.9l-3.091 5.356L3.6 7.656l3.091-5.356L12.84 12.7z"/></svg>
                                Google Drive
                            </span>
                        @endif
                        <span class="text-xs text-slate-500">{{ $lightboxItem->created_at->format('d M Y') }}</span>
                    </div>
                </div>
            </div>
        </div>
    @endif
    

    
    <style>
        .swiper-pagination-bullet {
            background: rgba(255, 255, 255, 0.4);
            opacity: 1;
            width: 8px;
            height: 8px;
            transition: all 0.3s ease;
        }
        .swiper-pagination-bullet-active {
            background: #fff;
            transform: scale(1.3);
            box-shadow: 0 0 10px rgba(255, 255, 255, 0.5);
        }
    </style>
</div>
