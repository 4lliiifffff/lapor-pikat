<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Panel Petugas - ' . setting('app_name', 'LaporAman') . ' ' . setting('institution_name', 'PKBM Pintar Berbakat'))</title>
    
    @if(setting('app_favicon') && \Illuminate\Support\Facades\Storage::disk('public')->exists(setting('app_favicon')))
        <link rel="icon" type="image/x-icon" href="{{ asset('storage/' . setting('app_favicon')) }}">
    @endif

    <!-- Google Fonts: Plus Jakarta Sans -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,400&display=block" rel="stylesheet">
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-brandLight-50 text-brandDark font-sans antialiased min-h-screen flex flex-col selection:bg-navy selection:text-white">
    <!-- Global Page Preloader -->
    <div id="page-preloader" class="fixed inset-0 z-[99999] flex items-center justify-center bg-[#0A315F]/95 backdrop-blur-md transition-all duration-400 ease-out pointer-events-auto">
        <div id="preloader-card" class="relative flex flex-col items-center justify-center p-8 sm:p-10 rounded-3xl bg-white/5 border border-white/15 backdrop-blur-xl shadow-2xl shadow-navy/80 transition-all duration-400 ease-out scale-100">

            <div class="loader">
                <div class="circle"><div class="dot"></div><div class="outline"></div></div>
                <div class="circle"><div class="dot"></div><div class="outline"></div></div>
                <div class="circle"><div class="dot"></div><div class="outline"></div></div>
                <div class="circle"><div class="dot"></div><div class="outline"></div></div>
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

    <!-- Admin Navigation Bar -->
    <header class="sticky top-0 z-40 bg-[#0A315F] text-white border-b border-navy-700 shadow-md">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16 sm:h-20">
                <!-- Brand Logo & Title -->
                <div class="flex items-center gap-6">
                    <a href="{{ route('admin.reports.index') }}" class="flex items-center gap-3 group">
                        @if(setting('app_logo') && \Illuminate\Support\Facades\Storage::disk('public')->exists(setting('app_logo')))
                            <img src="{{ asset('storage/' . setting('app_logo')) }}" alt="Logo {{ setting('app_name', 'LaporAman') }}" class="h-10 object-contain group-hover:scale-105 transition-transform">
                        @else
                            <div class="w-10 h-10 rounded-xl bg-white/10 border border-white/20 flex items-center justify-center text-white shadow-inner group-hover:scale-105 transition-transform">
                                <svg class="w-6 h-6 text-[#FBA239]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                                </svg>
                            </div>
                        @endif
                        <div>
                            <div class="flex items-center gap-2">
                                <span class="font-extrabold text-lg sm:text-xl tracking-tight text-white">{{ setting('app_name', 'LaporAman') }}</span>
                                <span class="bg-[#E63038] text-white text-[10px] font-extrabold px-2 py-0.5 rounded-full uppercase tracking-wider">Internal Portal</span>
                            </div>
                            <p class="text-[11px] text-[#EDEDED]/70 hidden sm:block">Panel {{ setting('institution_name', 'PKBM Pintar Berbakat') }}</p>
                        </div>
                    </a>

                    <!-- Admin Navigation Links -->
                    <nav class="hidden md:flex items-center gap-2 border-l border-white/15 pl-6 ml-2">
                        <a href="{{ route('admin.reports.index') }}" class="px-4 py-2 rounded-xl text-sm font-semibold transition-colors flex items-center gap-2 {{ request()->routeIs('admin.reports.*') ? 'bg-white/15 text-white font-bold border border-white/20' : 'text-[#EDEDED]/80 hover:text-white hover:bg-white/10' }}">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
                            <span>Daftar Laporan</span>
                        </a>

                        @role('super_admin')
                            <a href="{{ route('admin.users.index') }}" class="px-4 py-2 rounded-xl text-sm font-semibold transition-colors flex items-center gap-2 {{ request()->routeIs('admin.users.*') ? 'bg-white/15 text-white font-bold border border-white/20' : 'text-[#EDEDED]/80 hover:text-white hover:bg-white/10' }}">
                                <svg class="w-4 h-4 text-[#FBA239]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
                                <span>Kelola Akun & Monitoring</span>
                            </a>
                            <a href="{{ route('admin.settings.index') }}" class="px-4 py-2 rounded-xl text-sm font-semibold transition-colors flex items-center gap-2 {{ request()->routeIs('admin.settings.*') ? 'bg-white/15 text-white font-bold border border-white/20' : 'text-[#EDEDED]/80 hover:text-white hover:bg-white/10' }}">
                                <svg class="w-4 h-4 text-[#FBA239]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                                <span>Pengaturan CMS & Branding</span>
                            </a>
                        @endrole
                    </nav>
                </div>

                <!-- Admin User Info & Logout -->
                <div class="flex items-center gap-3">
                    <div class="hidden sm:flex flex-col items-end">
                        <span class="text-xs font-bold text-white">{{ auth()->user()->name }}</span>
                        @if(auth()->user()->hasRole('super_admin'))
                            <span class="text-[10px] font-extrabold text-[#FBA239] bg-[#FBA239]/10 border border-[#FBA239]/30 px-2 py-0.5 rounded-md uppercase tracking-wider">Super Admin</span>
                        @else
                            <span class="text-[10px] font-bold text-slate-300 bg-white/10 px-2 py-0.5 rounded-md uppercase tracking-wider">Petugas Admin</span>
                        @endif
                    </div>

                    <form method="POST" action="{{ route('logout') }}" class="inline">
                        @csrf
                        <button type="submit" class="px-3 py-1.5 rounded-xl text-xs font-bold text-white bg-[#E63038] hover:bg-[#E63038]/80 transition-colors shadow-sm flex items-center gap-1.5" title="Logout dari Panel Admin">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                            <span>Keluar</span>
                        </button>
                    </form>
                </div>
            </div>

            <!-- Mobile Subnav Bar -->
            <div class="flex md:hidden items-center gap-2 py-2 border-t border-white/10 overflow-x-auto text-xs font-medium">
                <a href="{{ route('admin.reports.index') }}" class="px-3 py-1.5 rounded-lg whitespace-nowrap {{ request()->routeIs('admin.reports.*') ? 'bg-white/20 text-white font-bold' : 'text-[#EDEDED]/70' }}">
                    Daftar Laporan
                </a>
                @role('super_admin')
                    <a href="{{ route('admin.users.index') }}" class="px-3 py-1.5 rounded-lg whitespace-nowrap {{ request()->routeIs('admin.users.*') ? 'bg-white/20 text-white font-bold' : 'text-[#EDEDED]/70' }}">
                        Kelola Akun & Monitoring
                    </a>
                    <a href="{{ route('admin.settings.index') }}" class="px-3 py-1.5 rounded-lg whitespace-nowrap {{ request()->routeIs('admin.settings.*') ? 'bg-white/20 text-white font-bold' : 'text-[#EDEDED]/70' }}">
                        Pengaturan CMS & Branding
                    </a>
                @endrole
            </div>
        </div>
    </header>

    <!-- Admin Main Content Area -->
    <main class="flex-grow py-8">
        <!-- Flash Messages -->
        @if(session('success'))
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mb-6">
                <div class="p-4 rounded-xl bg-emerald-50 border border-emerald-300 text-emerald-900 flex items-start gap-3 shadow-sm">
                    <svg class="w-5 h-5 text-emerald-600 mt-0.5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    <div class="text-sm font-semibold">{{ session('success') }}</div>
                </div>
            </div>
        @endif

        @if(session('error'))
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mb-6">
                <div class="p-4 rounded-xl bg-brandRed/10 border border-brandRed/30 text-brandRed-700 flex items-start gap-3 shadow-sm">
                    <svg class="w-5 h-5 text-brandRed mt-0.5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    <div class="text-sm font-semibold">{{ session('error') }}</div>
                </div>
            </div>
        @endif

        @yield('content')
    </main>

    <!-- Admin Footer -->
    <footer class="bg-[#2E2E2E] text-slate-400 border-t border-slate-800 py-6">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex flex-col sm:flex-row items-center justify-between gap-4 text-xs">
            <div class="flex items-center gap-2">
                <span class="font-bold text-white">{{ setting('app_name', 'LaporAman') }} Admin</span>
                <span>&bull;</span>
                <span>Portal Resmi Pengelolaan Kasus {{ setting('institution_name', 'PKBM Pintar Berbakat') }}</span>
            </div>
            <div>
                {{ setting('footer_copyright', '© 2026 PKBM Pintar Berbakat. Hak Cipta Dilindungi.') }}
            </div>
        </div>
    </footer>

    @stack('scripts')
</body>
</html>
