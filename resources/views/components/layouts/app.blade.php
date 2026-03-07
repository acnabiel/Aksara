<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="AKSARA - Galeri Kenangan Sekolah. Kumpulan foto dan video kenangan indah bersama teman-teman sekolah.">
    <meta name="keywords" content="galeri sekolah, kenangan sekolah, foto sekolah, video sekolah">
    <title>{{ $title ?? 'AKSARA - Galeri Kenangan Sekolah' }}</title>

    <link rel="icon" href="{{ asset('image/aksara_logo.png') }}" type="image/png">

    {{-- Google Fonts --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&family=Playfair+Display:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles

    {{-- Swiper CSS --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
</head>
<body class="bg-slate-950 text-white antialiased font-sans min-h-screen" x-data="{ mobileMenu: false }">

    {{-- Toast Notification Container --}}
    <div id="toast-container" class="fixed top-6 right-6 z-[100] flex flex-col items-end gap-3" style="pointer-events: none;">
    </div>

    {{ $slot }}

    @livewireScripts

    {{-- Toast Notification Script --}}
    <script>
        function showToast(message, type = 'success') {
            const container = document.getElementById('toast-container');
            const toast = document.createElement('div');
            const colors = {
                success: 'from-emerald-500/90 to-emerald-600/90 border-emerald-400/50',
                error: 'from-red-500/90 to-red-600/90 border-red-400/50',
                info: 'from-blue-500/90 to-blue-600/90 border-blue-400/50',
                warning: 'from-amber-500/90 to-amber-600/90 border-amber-400/50',
            };
            const icons = {
                success: `<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>`,
                error: `<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>`,
                info: `<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>`,
                warning: `<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.34 16.5c-.77.833.192 2.5 1.732 2.5z"/></svg>`,
            };

            toast.className = `flex items-center gap-3 px-5 py-3.5 rounded-xl bg-gradient-to-r ${colors[type]} border backdrop-blur-xl text-white shadow-2xl transform translate-x-full transition-all duration-500 ease-out`;
            toast.style.pointerEvents = 'auto';
            toast.innerHTML = `
                <span class="flex-shrink-0">${icons[type]}</span>
                <span class="text-sm font-medium">${message}</span>
            `;
            container.appendChild(toast);

            requestAnimationFrame(() => {
                toast.classList.remove('translate-x-full');
                toast.classList.add('translate-x-0');
            });

            setTimeout(() => {
                toast.classList.remove('translate-x-0');
                toast.classList.add('translate-x-full', 'opacity-0');
                setTimeout(() => toast.remove(), 500);
            }, 4000);
        }

        // Listen for Livewire toast events
        document.addEventListener('livewire:init', () => {
            Livewire.on('toast', (data) => {
                showToast(data[0].message, data[0].type || 'success');
            });
        });
    </script>

    {{-- Persistent Observer for scroll animations --}}
    <script>
        document.addEventListener('livewire:init', () => {
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('animate-visible');
                    }
                });
            }, { threshold: 0.1, rootMargin: '0px 0px -50px 0px' });

            // Function to re-observe elements
            const observeNewElements = () => {
                document.querySelectorAll('.animate-on-scroll:not(.animate-visible)').forEach(el => observer.observe(el));
            };

            // Run on initial load and navigation
            observeNewElements();
            document.addEventListener('livewire:navigated', observeNewElements);

            // Use a mutation observer to watch for dynamic DOM changes (faster than timeouts)
            const domObserver = new MutationObserver(observeNewElements);
            domObserver.observe(document.body, { childList: true, subtree: true });
        });
    </script>

    {{-- Swiper JS --}}
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
</body>
</html>
