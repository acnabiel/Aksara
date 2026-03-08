<div class="min-h-screen crew-treasure-map" x-data="{ mobileMenu: false }">
    {{-- Navigation --}}
    <header class="fixed top-0 left-0 right-0 z-40 glass border-b border-amber-900/30 transition-all duration-300" style="background: rgba(44, 24, 8, 0.85); backdrop-filter: blur(16px);">
        <nav class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16">
                <a href="/" wire:navigate class="flex items-center gap-3 group">
                    <div class="relative w-8 h-8 flex-shrink-0">
                        <img src="{{ asset('image/aksara_logo.png') }}" alt="Logo AKSARA" class="w-full h-full object-contain filter drop-shadow-[0_0_8px_rgba(255,215,0,0.4)] transition-transform duration-500 group-hover:scale-110">
                    </div>
                    <h1 class="text-xl font-bold font-serif text-amber-200 tracking-tight">AKSARA</h1>
                </a>

                <div class="hidden md:flex items-center gap-6">
                    <a href="/" wire:navigate class="text-sm text-amber-300/70 hover:text-amber-200 transition-colors">Beranda</a>
                    <a href="/#tentang-kami" class="text-sm text-amber-300/70 hover:text-amber-200 transition-colors">Tentang Kami</a>
                    <a href="/#gallery" class="text-sm text-amber-300/70 hover:text-amber-200 transition-colors">Galeri</a>
                    <a href="/crew" wire:navigate class="text-sm text-amber-200 font-semibold border-b-2 border-amber-400">Crew</a>
                </div>

                <button @click="mobileMenu = !mobileMenu" class="md:hidden text-amber-300 hover:text-amber-200">
                    <svg x-show="!mobileMenu" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 6h16M4 12h16M4 18h16"/></svg>
                    <svg x-show="mobileMenu" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="display:none"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M6 18L18 6M6 6l12 12"/></svg>
                </button>
            </div>

            <div x-show="mobileMenu" x-transition class="md:hidden pb-4 space-y-2" style="display:none">
                <a href="/" wire:navigate class="block px-4 py-2 text-sm text-amber-300/70 hover:text-amber-200 rounded-lg transition-colors">Beranda</a>
                <a href="/#tentang-kami" class="block px-4 py-2 text-sm text-amber-300/70 hover:text-amber-200 rounded-lg transition-colors">Tentang Kami</a>
                <a href="/#gallery" class="block px-4 py-2 text-sm text-amber-300/70 hover:text-amber-200 rounded-lg transition-colors">Galeri</a>
                <a href="/crew" wire:navigate class="block px-4 py-2 text-sm text-amber-200 font-semibold rounded-lg bg-amber-800/30">Crew</a>
            </div>
        </nav>
    </header>

    {{-- Hero Section - Treasure Map Theme --}}
    <section class="relative min-h-[70vh] flex items-center justify-center overflow-hidden treasure-hero">
        {{-- Parchment Background --}}
        <div class="absolute inset-0 z-0">
            <div class="absolute inset-0 treasure-bg"></div>
            <div class="absolute inset-0 bg-gradient-to-b from-amber-950/80 via-amber-950/40 to-amber-950/90"></div>
            <div class="absolute inset-0 parchment-texture"></div>
        </div>

        {{-- Floating Compass Rose --}}
        <div class="absolute top-20 right-10 sm:right-20 w-24 h-24 sm:w-32 sm:h-32 opacity-20 animate-spin-slow z-0">
            <svg viewBox="0 0 200 200" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M100 0L110 90L200 100L110 110L100 200L90 110L0 100L90 90L100 0Z" fill="currentColor" class="text-amber-400"/>
                <circle cx="100" cy="100" r="15" stroke="currentColor" stroke-width="2" class="text-amber-500"/>
                <circle cx="100" cy="100" r="40" stroke="currentColor" stroke-width="1" class="text-amber-600/50"/>
                <circle cx="100" cy="100" r="70" stroke="currentColor" stroke-width="0.5" class="text-amber-700/30" stroke-dasharray="5 5"/>
            </svg>
        </div>

        <div class="relative z-10 max-w-4xl mx-auto px-4 sm:px-6 text-center pt-24 pb-12">
            {{-- Treasure Chest Icon --}}
            <div class="mx-auto mb-6 w-20 h-20 sm:w-24 sm:h-24 rounded-full bg-gradient-to-br from-amber-600/30 to-amber-800/30 border-2 border-amber-500/40 flex items-center justify-center animate-float">
                <svg class="w-10 h-10 sm:w-12 sm:h-12 text-amber-400" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                    <path d="M20 7H4a2 2 0 00-2 2v10a2 2 0 002 2h16a2 2 0 002-2V9a2 2 0 00-2-2z" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M16 7V5a4 4 0 00-8 0v2" stroke-linecap="round" stroke-linejoin="round"/>
                    <circle cx="12" cy="14" r="2" fill="currentColor"/>
                    <path d="M12 16v2" stroke-linecap="round"/>
                </svg>
            </div>

            <h1 class="text-4xl sm:text-5xl md:text-7xl font-bold font-serif leading-tight tracking-tight">
                <span class="text-amber-100 drop-shadow-[0_2px_10px_rgba(255,215,0,0.3)]">CREW OF</span>
                <br>
                <span class="treasure-text-gradient">AKSARA</span>
            </h1>

            <p class="max-w-2xl mx-auto mt-6 text-base sm:text-lg text-amber-300/60 leading-relaxed font-serif italic">
                "Ikuti jejak perjalanan para kru yang telah membentuk cerita AKSARA SEMKABU"
            </p>

            <div class="flex items-center justify-center gap-4 mt-8">
                <div class="flex items-center gap-2 px-5 py-2.5 rounded-full border border-amber-600/40 bg-amber-900/30 backdrop-blur-sm">
                    <svg class="w-5 h-5 text-amber-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                    <span class="text-sm font-semibold text-amber-200">{{ $totalCrew }} Crew Members</span>
                </div>
            </div>

            {{-- Scroll Indicator --}}
            <div class="mt-12 animate-bounce">
                <a href="#crew-map" class="text-amber-500/50 hover:text-amber-400 transition-colors">
                    <svg class="w-6 h-6 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 14l-7 7m0 0l-7-7m7 7V3"/></svg>
                </a>
            </div>
        </div>
    </section>

    {{-- Crew Map Section --}}
    <section id="crew-map" class="relative py-16 sm:py-24 overflow-hidden treasure-map-body">
        {{-- Background parchment texture --}}
        <div class="absolute inset-0 treasure-bg"></div>
        <div class="absolute inset-0 parchment-texture"></div>

        {{-- SVG Dashed Path that flows through the page --}}
        <svg class="treasure-path-svg" viewBox="0 0 1200 6000" preserveAspectRatio="none" xmlns="http://www.w3.org/2000/svg">
            <path class="treasure-dashed-path" d="M600,0 C400,200 800,400 600,600 C400,800 200,900 400,1100 C600,1300 800,1200 600,1400 C400,1600 200,1700 500,1900 C800,2100 600,2300 400,2500 C200,2700 600,2900 800,3100 C1000,3300 400,3500 600,3700 C800,3900 200,4100 400,4300 C600,4500 800,4700 600,4900 C400,5100 600,5300 600,5500" />
        </svg>

        <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            {{-- Crew of AKSARA Group Photos - Paling Atas --}}
            <div class="relative mb-20 sm:mb-28 animate-on-scroll" x-data="{ showCrew: false, lightboxImg: null }">
                {{-- Section Header --}}
                <div class="flex items-center justify-center mb-10 sm:mb-14 relative">
                    <div class="hidden sm:block flex-1 h-px border-t-2 border-dashed border-amber-700/40"></div>
                    <div class="relative mx-4 sm:mx-8 group">
                        <div class="absolute -inset-3 bg-gradient-to-r from-amber-500 to-yellow-600 rounded-full blur-xl opacity-20 group-hover:opacity-40 transition-opacity duration-500"></div>
                        <div class="relative flex items-center gap-3 px-6 sm:px-8 py-3 sm:py-4 rounded-2xl bg-gradient-to-r from-amber-500 to-yellow-600 border border-yellow-400/50 shadow-xl shadow-yellow-500/30">
                            <div class="w-8 h-8 sm:w-10 sm:h-10 rounded-full bg-white/20 flex items-center justify-center backdrop-blur-sm">
                                <svg class="w-5 h-5 sm:w-6 sm:h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6.827 6.175A2.31 2.31 0 015.186 7.23c-.38.054-.757.112-1.134.175C2.999 7.58 2.25 8.507 2.25 9.574V18a2.25 2.25 0 002.25 2.25h15A2.25 2.25 0 0021.75 18V9.574c0-1.067-.75-1.994-1.802-2.169a47.865 47.865 0 00-1.134-.175 2.31 2.31 0 01-1.64-1.055l-.822-1.316a2.192 2.192 0 00-1.736-1.039 48.774 48.774 0 00-5.232 0 2.192 2.192 0 00-1.736 1.039l-.821 1.316z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 12.75a4.5 4.5 0 11-9 0 4.5 4.5 0 019 0zM18.75 10.5h.008v.008h-.008V10.5z" />
                                </svg>
                            </div>
                            <div>
                                <h2 class="text-lg sm:text-xl font-bold text-white font-serif tracking-wide">Crew of AKSARA</h2>
                                <p class="text-xs text-white/60">Foto Bersama Crew</p>
                            </div>
                        </div>
                        <div class="absolute -bottom-3 left-1/2 -translate-x-1/2 w-0 h-0 border-l-[10px] border-l-transparent border-r-[10px] border-r-transparent border-t-[12px]" style="border-top-color: inherit;"></div>
                    </div>
                    <div class="hidden sm:block flex-1 h-px border-t-2 border-dashed border-amber-700/40"></div>
                </div>

                {{-- Group Photos Grid --}}
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 sm:gap-8 max-w-5xl mx-auto"
                     x-ref="crewGrid"
                     x-init="
                        const obs = new IntersectionObserver((entries) => {
                            entries.forEach(entry => {
                                if (entry.isIntersecting) {
                                    showCrew = true;
                                    obs.disconnect();
                                }
                            });
                        }, { threshold: 0.15 });
                        obs.observe($refs.crewGrid);
                     ">
                    {{-- Crew Perempuan --}}
                    <div class="crew-group-photo-wrapper"
                         x-show="showCrew"
                         x-transition:enter="crew-popup-enter"
                         x-transition:enter-start="crew-popup-enter-start"
                         x-transition:enter-end="crew-popup-enter-end"
                         style="display: none;"
                         @click="lightboxImg = '{{ asset('image/crew/crew_perempuan.jpg') }}'">
                        <div class="crew-group-photo-card group cursor-pointer relative overflow-hidden rounded-2xl border-2 border-amber-600/40 hover:border-amber-400/70 transition-all duration-500 shadow-xl hover:shadow-2xl hover:shadow-amber-500/20">
                            <div class="absolute inset-0 bg-gradient-to-t from-amber-950/80 via-transparent to-transparent z-10 pointer-events-none opacity-60 group-hover:opacity-30 transition-opacity"></div>
                            <div class="overflow-hidden">
                                <img src="{{ asset('image/crew/crew_perempuan.jpg') }}"
                                     alt="Crew of AKSARA - Putri"
                                     class="w-full h-auto object-cover transition-transform duration-700 group-hover:scale-105"
                                     loading="lazy">
                            </div>
                            <div class="absolute bottom-0 inset-x-0 z-20 p-4">
                                <div class="bg-amber-950/70 backdrop-blur-md rounded-lg border border-amber-700/30 px-4 py-2.5">
                                    <h3 class="text-sm font-bold text-amber-100 font-serif">👩 Crew Putri AKSARA</h3>
                                </div>
                            </div>
                            <div class="absolute top-2 left-2 w-5 h-5 border-l-2 border-t-2 border-amber-500/40 rounded-tl-sm z-10 opacity-0 group-hover:opacity-100 transition-opacity"></div>
                            <div class="absolute top-2 right-2 w-5 h-5 border-r-2 border-t-2 border-amber-500/40 rounded-tr-sm z-10 opacity-0 group-hover:opacity-100 transition-opacity"></div>
                            <div class="absolute bottom-2 left-2 w-5 h-5 border-l-2 border-b-2 border-amber-500/40 rounded-bl-sm z-10 opacity-0 group-hover:opacity-100 transition-opacity"></div>
                            <div class="absolute bottom-2 right-2 w-5 h-5 border-r-2 border-b-2 border-amber-500/40 rounded-br-sm z-10 opacity-0 group-hover:opacity-100 transition-opacity"></div>
                        </div>
                    </div>

                    {{-- Crew Laki-laki --}}
                    <div class="crew-group-photo-wrapper"
                         x-show="showCrew"
                         x-transition:enter="crew-popup-enter crew-popup-delay"
                         x-transition:enter-start="crew-popup-enter-start"
                         x-transition:enter-end="crew-popup-enter-end"
                         style="display: none;"
                         @click="lightboxImg = '{{ asset('image/crew/crew_lakilaki.jpg') }}'">
                        <div class="crew-group-photo-card group cursor-pointer relative overflow-hidden rounded-2xl border-2 border-amber-600/40 hover:border-amber-400/70 transition-all duration-500 shadow-xl hover:shadow-2xl hover:shadow-amber-500/20">
                            <div class="absolute inset-0 bg-gradient-to-t from-amber-950/80 via-transparent to-transparent z-10 pointer-events-none opacity-60 group-hover:opacity-30 transition-opacity"></div>
                            <div class="overflow-hidden">
                                <img src="{{ asset('image/crew/crew_lakilaki.jpg') }}"
                                     alt="Crew of AKSARA - Putra"
                                     class="w-full h-auto object-cover transition-transform duration-700 group-hover:scale-105"
                                     loading="lazy">
                            </div>
                            <div class="absolute bottom-0 inset-x-0 z-20 p-4">
                                <div class="bg-amber-950/70 backdrop-blur-md rounded-lg border border-amber-700/30 px-4 py-2.5">
                                    <h3 class="text-sm font-bold text-amber-100 font-serif">👨 Crew Putra AKSARA</h3>
                                </div>
                            </div>
                            <div class="absolute top-2 left-2 w-5 h-5 border-l-2 border-t-2 border-amber-500/40 rounded-tl-sm z-10 opacity-0 group-hover:opacity-100 transition-opacity"></div>
                            <div class="absolute top-2 right-2 w-5 h-5 border-r-2 border-t-2 border-amber-500/40 rounded-tr-sm z-10 opacity-0 group-hover:opacity-100 transition-opacity"></div>
                            <div class="absolute bottom-2 left-2 w-5 h-5 border-l-2 border-b-2 border-amber-500/40 rounded-bl-sm z-10 opacity-0 group-hover:opacity-100 transition-opacity"></div>
                            <div class="absolute bottom-2 right-2 w-5 h-5 border-r-2 border-b-2 border-amber-500/40 rounded-br-sm z-10 opacity-0 group-hover:opacity-100 transition-opacity"></div>
                        </div>
                    </div>
                </div>

                {{-- Lightbox for group photos --}}
                <div x-show="lightboxImg"
                     x-transition:enter="transition ease-out duration-300"
                     x-transition:enter-start="opacity-0"
                     x-transition:enter-end="opacity-100"
                     x-transition:leave="transition ease-in duration-200"
                     x-transition:leave-start="opacity-100"
                     x-transition:leave-end="opacity-0"
                     @click.self="lightboxImg = null"
                     @keydown.escape.window="lightboxImg = null"
                     class="fixed inset-0 z-50 flex items-center justify-center p-4"
                     style="background: rgba(10, 5, 0, 0.92); backdrop-filter: blur(12px); display: none;">
                    <div class="relative max-w-4xl w-full animate-scale-in">
                        <button @click="lightboxImg = null" class="absolute -top-12 right-0 text-amber-400/60 hover:text-amber-300 transition-colors z-50">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M6 18L18 6M6 6l12 12"/></svg>
                        </button>
                        <div class="relative">
                            <div class="absolute -inset-2 bg-gradient-to-br from-amber-600/30 via-amber-800/20 to-amber-600/30 rounded-2xl blur-sm"></div>
                            <div class="relative rounded-2xl overflow-hidden border-2 border-amber-600/50 shadow-2xl shadow-amber-900/50">
                                <img :src="lightboxImg" alt="Crew of AKSARA" class="w-full h-auto">
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Dashed path connector to next section --}}
                <div class="flex flex-col items-center mt-10 sm:mt-14">
                    <div class="w-px h-8 sm:h-12 border-l-2 border-dashed border-amber-600/30"></div>
                    <div class="w-4 h-4 rounded-full border-2 border-dashed border-amber-500/50 flex items-center justify-center">
                        <div class="w-1.5 h-1.5 rounded-full bg-amber-500/60"></div>
                    </div>
                    <div class="w-px h-8 sm:h-12 border-l-2 border-dashed border-amber-600/30"></div>
                    <svg class="w-4 h-4 text-amber-500/40" fill="currentColor" viewBox="0 0 24 24"><path d="M12 16l-6-6h12z"/></svg>
                </div>
            </div>

            @php $positionIndex = 0; @endphp
            @foreach ($crewByPosition as $position => $members)

                @php
                    $isEven = $positionIndex % 2 === 0;
                    $positionIndex++;
                    // Map marker icons and colors per position type
                    $markerColors = [
                        'Ketua Angkatan' => ['from-yellow-500', 'to-amber-600', 'border-yellow-400', 'text-yellow-300', 'shadow-yellow-500/30'],
                        'Wakil Ketua Angkatan' => ['from-amber-500', 'to-orange-600', 'border-amber-400', 'text-amber-300', 'shadow-amber-500/30'],
                        'Sekretaris' => ['from-emerald-600', 'to-green-700', 'border-emerald-400', 'text-emerald-300', 'shadow-emerald-500/30'],
                        'Bendahara' => ['from-purple-600', 'to-violet-700', 'border-purple-400', 'text-purple-300', 'shadow-purple-500/30'],
                        'Ketua BT / Wakil BT' => ['from-sky-600', 'to-blue-700', 'border-sky-400', 'text-sky-300', 'shadow-sky-500/30'],
                        'FG, Editor' => ['from-rose-600', 'to-red-700', 'border-rose-400', 'text-rose-300', 'shadow-rose-500/30'],
                        'Crew CAS' => ['from-teal-600', 'to-cyan-700', 'border-teal-400', 'text-teal-300', 'shadow-teal-500/30'],
                        'Artikel' => ['from-indigo-600', 'to-blue-700', 'border-indigo-400', 'text-indigo-300', 'shadow-indigo-500/30'],
                        'Crew Angkatan' => ['from-amber-700', 'to-yellow-800', 'border-amber-500', 'text-amber-300', 'shadow-amber-500/30'],
                    ];
                    $colors = $markerColors[$position] ?? ['from-amber-600', 'to-amber-700', 'border-amber-400', 'text-amber-300', 'shadow-amber-500/30'];
                @endphp

                <div class="relative mb-20 sm:mb-28 animate-on-scroll stagger-{{ min($positionIndex, 6) }}">
                    {{-- Position marker with dashed connector --}}
                    <div class="flex items-center justify-center mb-10 sm:mb-14 relative">
                        {{-- Dashed line left --}}
                        <div class="hidden sm:block flex-1 h-px border-t-2 border-dashed border-amber-700/40"></div>

                        {{-- Map Pin / Location Marker --}}
                        <div class="relative mx-4 sm:mx-8 group">
                            {{-- Glow effect --}}
                            <div class="absolute -inset-3 bg-gradient-to-r {{ $colors[0] }} {{ $colors[1] }} rounded-full blur-xl opacity-20 group-hover:opacity-40 transition-opacity duration-500"></div>

                            <div class="relative flex items-center gap-3 px-6 sm:px-8 py-3 sm:py-4 rounded-2xl bg-gradient-to-r {{ $colors[0] }} {{ $colors[1] }} border {{ $colors[2] }}/50 shadow-xl {{ $colors[4] }}">
                                {{-- Pin icon --}}
                                <div class="w-8 h-8 sm:w-10 sm:h-10 rounded-full bg-white/20 flex items-center justify-center backdrop-blur-sm">
                                    <svg class="w-5 h-5 sm:w-6 sm:h-6 text-white" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z"/>
                                    </svg>
                                </div>
                                <div>
                                    <h2 class="text-lg sm:text-xl font-bold text-white font-serif tracking-wide">{{ $position }}</h2>
                                    <p class="text-xs text-white/60">{{ count($members) }} anggota</p>
                                </div>
                            </div>

                            {{-- Pin tail / pointer --}}
                            <div class="absolute -bottom-3 left-1/2 -translate-x-1/2 w-0 h-0 border-l-[10px] border-l-transparent border-r-[10px] border-r-transparent border-t-[12px]" style="border-top-color: inherit;"></div>
                        </div>

                        {{-- Dashed line right --}}
                        <div class="hidden sm:block flex-1 h-px border-t-2 border-dashed border-amber-700/40"></div>
                    </div>

                    {{-- Crew Cards Grid with Map connections --}}
                    <div class="relative">
                        {{-- Vertical dashed connector from marker to cards --}}
                        <div class="absolute top-0 left-1/2 -translate-x-1/2 w-px h-6 border-l-2 border-dashed border-amber-600/30 -mt-6"></div>

                        {{-- Cards Grid --}}
                        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-{{ min(count($members), 5) > 4 ? '5' : min(count($members), 4) }} gap-4 sm:gap-6 justify-items-center max-w-6xl mx-auto">
                            @foreach ($members as $index => $member)
                                <div class="crew-card-wrapper group relative" wire:key="crew-{{ $positionIndex }}-{{ $index }}">
                                    {{-- Dashed dot connector --}}
                                    <div class="absolute -top-4 left-1/2 -translate-x-1/2 flex flex-col items-center">
                                        <div class="w-3 h-3 rounded-full bg-amber-500/60 border-2 border-amber-400/80 shadow-lg shadow-amber-500/20"></div>
                                        <div class="w-px h-3 border-l border-dashed border-amber-600/40"></div>
                                    </div>

                                    {{-- Card --}}
                                    <div
                                        class="crew-treasure-card cursor-pointer relative overflow-hidden rounded-xl sm:rounded-2xl border-2 border-amber-700/40 hover:border-amber-500/70 transition-all duration-500 shadow-lg hover:shadow-2xl hover:shadow-amber-600/20 group-hover:-translate-y-2"
                                        wire:click="openCard('{{ $member['image'] }}')"
                                    >
                                        {{-- Card inner glow --}}
                                        <div class="absolute inset-0 bg-gradient-to-t from-amber-950/90 via-transparent to-amber-900/30 z-10 pointer-events-none opacity-60 group-hover:opacity-40 transition-opacity"></div>

                                        {{-- Image --}}
                                        <div class="aspect-[3/4] overflow-hidden">
                                            <img
                                                src="{{ asset('image/crew/CETAKK!!/' . $member['image']) }}"
                                                alt="{{ $member['name'] }} - {{ $position }}"
                                                class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110"
                                                loading="lazy"
                                            >
                                        </div>

                                        {{-- Name overlay --}}
                                        <div class="absolute bottom-0 inset-x-0 z-20 p-3 sm:p-4">
                                            <div class="bg-amber-950/70 backdrop-blur-md rounded-lg border border-amber-700/30 px-3 py-2 sm:px-4 sm:py-2.5">
                                                <h3 class="text-xs sm:text-sm font-bold text-amber-100 truncate font-serif">{{ $member['name'] }}</h3>
                                                <p class="text-[10px] sm:text-xs text-amber-400/70 mt-0.5 uppercase tracking-wider">{{ $position }}</p>
                                            </div>
                                        </div>

                                        {{-- Treasure map corner ornaments --}}
                                        <div class="absolute top-2 left-2 w-4 h-4 border-l-2 border-t-2 border-amber-500/40 rounded-tl-sm z-10 opacity-0 group-hover:opacity-100 transition-opacity"></div>
                                        <div class="absolute top-2 right-2 w-4 h-4 border-r-2 border-t-2 border-amber-500/40 rounded-tr-sm z-10 opacity-0 group-hover:opacity-100 transition-opacity"></div>
                                        <div class="absolute bottom-2 left-2 w-4 h-4 border-l-2 border-b-2 border-amber-500/40 rounded-bl-sm z-10 opacity-0 group-hover:opacity-100 transition-opacity"></div>
                                        <div class="absolute bottom-2 right-2 w-4 h-4 border-r-2 border-b-2 border-amber-500/40 rounded-br-sm z-10 opacity-0 group-hover:opacity-100 transition-opacity"></div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    {{-- Dashed path connector to next section --}}
                    @if (!$loop->last)
                        <div class="flex flex-col items-center mt-10 sm:mt-14">
                            <div class="w-px h-8 sm:h-12 border-l-2 border-dashed border-amber-600/30"></div>
                            <div class="w-4 h-4 rounded-full border-2 border-dashed border-amber-500/50 flex items-center justify-center">
                                <div class="w-1.5 h-1.5 rounded-full bg-amber-500/60"></div>
                            </div>
                            <div class="w-px h-8 sm:h-12 border-l-2 border-dashed border-amber-600/30"></div>
                            <svg class="w-4 h-4 text-amber-500/40" fill="currentColor" viewBox="0 0 24 24"><path d="M12 16l-6-6h12z"/></svg>
                        </div>
                    @endif
                </div>
            @endforeach

            {{-- Treasure End Marker --}}
            <div class="flex flex-col items-center mt-12 animate-on-scroll">
                <div class="w-px h-10 border-l-2 border-dashed border-amber-600/30"></div>
                <div class="relative">
                    <div class="absolute -inset-4 bg-amber-500/10 rounded-full blur-xl animate-pulse-soft"></div>
                    <div class="relative w-16 h-16 sm:w-20 sm:h-20 rounded-full bg-gradient-to-br from-amber-500/30 to-amber-700/30 border-2 border-amber-500/50 flex items-center justify-center">
                        <span class="text-2xl sm:text-3xl">⚓</span>
                    </div>
                </div>
                <p class="mt-4 text-amber-400/60 text-sm font-serif italic">"Akhir peta, awal cerita kita bersama"</p>
            </div>
        </div>
    </section>

    {{-- Footer --}}
    <footer class="border-t border-amber-800/30 py-10 px-4 sm:px-6 treasure-footer">
        <div class="max-w-7xl mx-auto flex flex-col sm:flex-row items-center justify-between gap-4">
            <div class="flex items-center gap-2">
                <img src="{{ asset('image/aksara_logo.png') }}" alt="Logo" class="w-6 h-6 object-contain opacity-80">
                <span class="text-lg font-bold font-serif treasure-text-gradient">AKSARA</span>
                <span class="text-xs text-amber-700">•</span>
                <span class="text-xs text-amber-600/60">Crew of AKSARA</span>
            </div>
            <p class="text-xs text-amber-700/60">&copy; {{ date('Y') }} AKSARA. All rights reserved.</p>
        </div>
    </footer>

    {{-- Lightbox Modal --}}
    @if($selectedCrew)
        <div
            class="fixed inset-0 z-50 flex items-center justify-center p-4"
            style="background: rgba(10, 5, 0, 0.92); backdrop-filter: blur(12px);"
            wire:click.self="closeCard"
            x-data
            @keydown.escape.window="$wire.closeCard()"
        >
            <div class="relative max-w-lg w-full animate-scale-in">
                {{-- Close Button --}}
                <button
                    wire:click="closeCard"
                    class="absolute -top-12 right-0 text-amber-400/60 hover:text-amber-300 transition-colors z-50"
                >
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M6 18L18 6M6 6l12 12"/></svg>
                </button>

                {{-- Card with ornamental border --}}
                <div class="relative">
                    <div class="absolute -inset-2 bg-gradient-to-br from-amber-600/30 via-amber-800/20 to-amber-600/30 rounded-2xl blur-sm"></div>
                    <div class="relative rounded-2xl overflow-hidden border-2 border-amber-600/50 shadow-2xl shadow-amber-900/50">
                        <img
                            src="{{ asset('image/crew/CETAKK!!/' . $selectedCrew) }}"
                            alt="Crew ID Card"
                            class="w-full h-auto"
                        >
                    </div>
                </div>
            </div>
        </div>
    @endif

    <style>
        /* === TREASURE MAP THEME === */

        .treasure-bg {
            background-color: #1a0e04;
            background-image:
                radial-gradient(ellipse at 20% 50%, rgba(180, 120, 40, 0.08) 0%, transparent 50%),
                radial-gradient(ellipse at 80% 20%, rgba(160, 100, 30, 0.06) 0%, transparent 50%),
                radial-gradient(ellipse at 50% 80%, rgba(140, 90, 25, 0.05) 0%, transparent 50%);
        }

        .parchment-texture {
            background-image:
                url("data:image/svg+xml,%3Csvg width='100' height='100' viewBox='0 0 100 100' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='noise'%3E%3CfeTurbulence baseFrequency='0.65' numOctaves='3' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100' height='100' filter='url(%23noise)' opacity='0.03'/%3E%3C/svg%3E");
            opacity: 0.5;
        }

        .treasure-hero {
            background:
                linear-gradient(180deg, #0f0804 0%, #1a0e04 40%, #231206 100%);
        }

        .treasure-map-body {
            background:
                radial-gradient(ellipse at 30% 30%, rgba(139, 90, 30, 0.06) 0%, transparent 40%),
                radial-gradient(ellipse at 70% 60%, rgba(180, 120, 40, 0.04) 0%, transparent 40%),
                radial-gradient(ellipse at 50% 90%, rgba(120, 80, 20, 0.05) 0%, transparent 40%),
                linear-gradient(180deg, #1a0e04 0%, #0f0804 50%, #1a0e04 100%);
        }

        .treasure-footer {
            background: #0f0804;
        }

        .treasure-text-gradient {
            background: linear-gradient(135deg, #ffd700 0%, #f0c040 25%, #d4a030 50%, #ffd700 75%, #ffea80 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            background-size: 200% 200%;
            animation: treasure-shimmer 4s ease infinite;
        }

        @keyframes treasure-shimmer {
            0%, 100% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
        }

        /* Spinning compass animation */
        @keyframes spin-slow {
            from { transform: rotate(0deg); }
            to { transform: rotate(360deg); }
        }
        .animate-spin-slow {
            animation: spin-slow 30s linear infinite;
        }

        /* Treasure path SVG */
        .treasure-path-svg {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            pointer-events: none;
            z-index: 0;
        }

        .treasure-dashed-path {
            fill: none;
            stroke: rgba(180, 120, 40, 0.12);
            stroke-width: 3;
            stroke-dasharray: 15 10;
            stroke-linecap: round;
            animation: dash-flow 20s linear infinite;
        }

        @keyframes dash-flow {
            to { stroke-dashoffset: -500; }
        }

        /* Crew card hover effects */
        .crew-treasure-card {
            background: linear-gradient(180deg, rgba(30, 18, 8, 0.3) 0%, rgba(20, 12, 4, 0.6) 100%);
            transition: all 0.5s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .crew-treasure-card:hover {
            box-shadow:
                0 20px 40px -15px rgba(180, 120, 30, 0.25),
                0 0 30px -10px rgba(255, 200, 50, 0.15),
                inset 0 1px 1px rgba(255, 215, 0, 0.1);
        }

        .crew-card-wrapper {
            animation: card-appear 0.6s ease-out both;
        }

        @keyframes card-appear {
            from {
                opacity: 0;
                transform: translateY(30px) scale(0.95);
            }
            to {
                opacity: 1;
                transform: translateY(0) scale(1);
            }
        }

        /* Scale in for lightbox */
        .animate-scale-in {
            animation: scale-in 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        @keyframes scale-in {
            from {
                opacity: 0;
                transform: scale(0.9);
            }
            to {
                opacity: 1;
                transform: scale(1);
            }
        }

        /* Map grid pattern overlay */
        .treasure-map-body::before {
            content: '';
            position: absolute;
            inset: 0;
            background-image:
                linear-gradient(rgba(180, 120, 40, 0.03) 1px, transparent 1px),
                linear-gradient(90deg, rgba(180, 120, 40, 0.03) 1px, transparent 1px);
            background-size: 60px 60px;
            pointer-events: none;
            z-index: 0;
        }

        /* Responsive grid adjustments */
        @media (max-width: 640px) {
            .crew-card-wrapper .crew-treasure-card {
                border-radius: 0.75rem;
            }
        }

        /* === CREW GROUP PHOTO POP-UP ANIMATION === */
        .crew-popup-enter {
            transition: all 0.7s cubic-bezier(0.34, 1.56, 0.64, 1) !important;
        }
        .crew-popup-enter.crew-popup-delay {
            transition-delay: 0.2s !important;
        }
        .crew-popup-enter-start {
            opacity: 0 !important;
            transform: scale(0.3) translateY(60px) !important;
        }
        .crew-popup-enter-end {
            opacity: 1 !important;
            transform: scale(1) translateY(0) !important;
        }

        .crew-group-photo-card {
            background: transparent;
            transition: all 0.5s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .crew-group-photo-card:hover {
            box-shadow:
                0 25px 50px -15px rgba(180, 120, 30, 0.3),
                0 0 40px -10px rgba(255, 200, 50, 0.2),
                inset 0 1px 1px rgba(255, 215, 0, 0.1);
            transform: translateY(-8px);
        }

        .crew-group-photo-wrapper {
            will-change: transform, opacity;
        }
    </style>
</div>
