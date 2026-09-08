<!DOCTYPE html>
<html lang="id">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ $title ?? 'Masuk Panel Petugas - Lapor Aman PKBM Pintar Berbakat' }}</title>

        <!-- Google Fonts: Plus Jakarta Sans -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=block" rel="stylesheet">

        <!-- Scripts & Styles -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans text-brandDark antialiased bg-brandLight-50 min-h-screen flex flex-col justify-center py-12 sm:px-6 lg:px-8 relative overflow-hidden selection:bg-navy selection:text-white">
        <!-- Global Page Preloader -->
        <div id="page-preloader" class="fixed inset-0 z-[99999] flex items-center justify-center bg-[#0A315F]/95 backdrop-blur-md transition-all duration-400 ease-out pointer-events-auto">
            <div id="preloader-card" class="relative flex flex-col items-center justify-center p-8 sm:p-10 rounded-3xl bg-white/5 border border-white/15 backdrop-blur-xl shadow-2xl shadow-navy/80 transition-all duration-400 ease-out scale-100">


                <div class="loader">
                    <div class="circle">
                        <div class="dot"></div>
                        <div class="outline"></div>
                    </div>
                    <div class="circle">
                        <div class="dot"></div>
                        <div class="outline"></div>
                    </div>
                    <div class="circle">
                        <div class="dot"></div>
                        <div class="outline"></div>
                    </div>
                    <div class="circle">
                        <div class="dot"></div>
                        <div class="outline"></div>
                    </div>
                </div>
            </div>
        </div>

        <script>
            (function () {
                const preloader = document.getElementById('page-preloader');
                const card = document.getElementById('preloader-card');
                if (!preloader) return;

                function hidePreloader() {
                    if (card) {
                        card.classList.remove('scale-100');
                        card.classList.add('scale-95', 'opacity-0');
                    }
                    preloader.classList.add('opacity-0', 'pointer-events-none');
                    setTimeout(function () {
                        preloader.style.display = 'none';
                    }, 400);
                }

                function showPreloader() {
                    preloader.style.display = 'flex';
                    void preloader.offsetWidth;
                    if (card) {
                        card.classList.remove('scale-95', 'opacity-0');
                        card.classList.add('scale-100');
                    }
                    preloader.classList.remove('opacity-0', 'pointer-events-none');
                }

                function handlePageLoaded() {
                    if (document.fonts && document.fonts.ready) {
                        document.fonts.ready.then(hidePreloader);
                    } else {
                        hidePreloader();
                    }
                }

                if (document.readyState === 'complete') {
                    handlePageLoaded();
                } else {
                    window.addEventListener('load', handlePageLoaded);
                    setTimeout(handlePageLoaded, 1200);
                }

                document.addEventListener('click', function (e) {
                    const link = e.target.closest('a');
                    if (link && link.href && !link.target && !link.hasAttribute('download') && link.origin === window.location.origin && !link.href.includes('#')) {
                        showPreloader();
                    }
                });

                document.addEventListener('submit', function () {
                    showPreloader();
                });
            })();
        </script>


        <div class="sm:mx-auto sm:w-full sm:max-w-md text-center">
            <a href="{{ route('reports.create') }}" class="inline-flex items-center gap-3 group mb-4">
                <div class="w-12 h-12 rounded-2xl bg-navy flex items-center justify-center text-white shadow-lg shadow-navy/25 group-hover:scale-105 transition-transform">
                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                    </svg>
                </div>
            </a>
            <h2 class="text-2xl font-extrabold text-navy tracking-tight">
                Lapor<span class="text-[#E63038]">Aman</span>
            </h2>
            <p class="text-xs text-brandGray mt-1 font-semibold uppercase tracking-wider">
                Portal Masuk Petugas & Tutor PKBM Pintar Berbakat
            </p>
        </div>

        <div class="mt-6 sm:mx-auto sm:w-full sm:max-w-md px-4">
            <div class="card-glass py-8 px-6 sm:px-10 shadow-xl border border-brandLight-200">
                {{ $slot }}
            </div>
            
            <p class="text-center text-xs text-brandGray mt-6">
                &copy; {{ date('Y') }} PKBM Pintar Berbakat. Sistem Pengaduan Aman & Terenkripsi.
            </p>
        </div>
    </body>
</html>
