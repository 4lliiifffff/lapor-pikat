<!DOCTYPE html>
<html lang="id" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', setting('app_name', 'LaporAman') . ' - Pusat Pelaporan Perundungan ' . setting('institution_name', 'PKBM Pintar Berbakat'))</title>
    <meta name="description"
        content="Layanan pelaporan perundungan (bullying) terpercaya dan rahasia untuk {{ setting('institution_name', 'PKBM Pintar Berbakat') }}. Lapor secara anonim atau pakai data diri dengan pelacakan transparan.">

    @if(setting('app_favicon') && \Illuminate\Support\Facades\Storage::disk('public')->exists(setting('app_favicon')))
        <link rel="icon" type="image/x-icon" href="{{ asset('storage/' . setting('app_favicon')) }}">
    @endif

    <!-- Google Fonts: Plus Jakarta Sans -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,400&display=block"
        rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body
    class="bg-brandLight-50 text-brandDark font-sans antialiased min-h-screen flex flex-col selection:bg-navy selection:text-white">
    <!-- Global Page Preloader -->
    <div id="page-preloader"
        class="fixed inset-0 z-[99999] flex items-center justify-center bg-navy-900/95 backdrop-blur-md transition-all duration-400 ease-out pointer-events-auto">
        <div id="preloader-card"
            class="relative flex flex-col items-center justify-center p-8 sm:p-10 rounded-3xl bg-white/5 border border-white/15 backdrop-blur-xl shadow-2xl shadow-navy/80 transition-all duration-400 ease-out scale-100">


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

    <!-- System Announcement Banner (If Enabled by Super Admin CMS) -->
    @if(setting('announcement_enabled') == '1' && setting('announcement_text'))
        <div class="bg-[#0A315F] text-white text-xs sm:text-sm py-2.5 px-4 border-b border-navy-700 shadow-sm">
            <div class="max-w-7xl mx-auto flex items-center justify-between gap-3">
                <div class="flex items-center gap-2">
                    <span class="inline-flex items-center justify-center px-2 py-0.5 rounded text-[10px] font-extrabold uppercase bg-[#FBA239] text-[#2E2E2E]">Pengumuman</span>
                    <span class="font-medium text-slate-100">{{ setting('announcement_text') }}</span>
                </div>
            </div>
        </div>
    @endif

    <!-- Emergency Hotline Banner (Brand Red Accent) -->
    <div class="bg-[#E63038] text-white text-xs sm:text-sm py-2 px-4 shadow-sm">
        <div class="max-w-7xl mx-auto flex flex-col sm:flex-row items-center justify-between gap-2">
            <div class="flex items-center gap-2">
                <span class="inline-flex items-center justify-center w-2 h-2 rounded-full bg-white animate-ping"></span>
                <span class="font-medium text-white/95">Dalam bahaya darurat atau butuh bantuan saat ini?</span>
            </div>
            <div class="flex items-center gap-3">
                <span class="text-white/80">Hubungi Langsung:</span>
                <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', setting('contact_phone', '0812-3456-7890')) }}" target="_blank" rel="noopener noreferrer"
                    class="inline-flex items-center gap-1.5 font-bold text-amber-200 hover:text-white bg-white/10 hover:bg-white/20 px-2.5 py-0.5 rounded-lg transition-colors">
                    <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24">
                        <path
                            d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.462-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.501-.669-.51l-.57-.01c-.198 0-.52.074-.792.372s-1.04 1.016-1.04 2.479 1.065 2.876 1.213 3.074c.149.198 2.095 3.2 5.076 4.487.709.306 1.263.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z" />
                    </svg>
                    <span>Tim {{ setting('institution_name', 'PKBM Pintar Berbakat') }} ({{ setting('contact_phone', '0812-3456-7890') }})</span>
                </a>
            </div>
        </div>
    </div>

    <!-- Navigation Bar -->
    <header
        class="sticky top-0 z-40 bg-white/95 backdrop-blur-md border-b border-brandLight-200 transition-all shadow-sm">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16 sm:h-20">
                <!-- Logo & Brand (Navy Branding) -->
                <a href="{{ route('reports.create') }}" class="flex items-center gap-3 group">
                    @if(setting('app_logo') && \Illuminate\Support\Facades\Storage::disk('public')->exists(setting('app_logo')))
                        <img src="{{ asset('storage/' . setting('app_logo')) }}" alt="Logo {{ setting('app_name', 'LaporAman') }}" class="h-10 object-contain group-hover:scale-105 transition-transform">
                    @else
                        <div
                            class="w-10 h-10 sm:w-11 sm:h-11 rounded-xl bg-navy flex items-center justify-center text-white shadow-md shadow-navy/20 group-hover:scale-105 transition-transform">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                            </svg>
                        </div>
                    @endif
                    <div>
                        <div class="flex items-center gap-2">
                            <span class="font-extrabold text-lg sm:text-xl tracking-tight text-navy">{{ setting('app_name', 'LaporAman') }}</span>
                            <span
                                class="bg-navy/10 text-navy text-[10px] font-bold px-2 py-0.5 rounded-full border border-navy/20">{{ setting('institution_name', 'PKBM Pintar Berbakat') }}</span>
                        </div>
                        <p class="text-[11px] text-brandGray hidden sm:block">{{ setting('app_tagline', 'Pusat Pelaporan & Perlindungan Anti-Perundungan') }}
                        </p>
                    </div>
                </a>

                <!-- Desktop Navigation Links -->
                <nav class="hidden md:flex items-center gap-1">
                    <a href="{{ route('reports.create') }}"
                        class="px-4 py-2 rounded-xl text-sm font-semibold transition-colors {{ request()->routeIs('reports.create') ? 'text-navy bg-navy/10 font-bold border-b-2 border-navy' : 'text-brandDark hover:text-navy hover:bg-brandLight-100' }}">
                        Lapor Sekarang
                    </a>
                    <a href="{{ route('reports.track') }}"
                        class="px-4 py-2 rounded-xl text-sm font-semibold transition-colors {{ request()->routeIs('reports.track*') ? 'text-navy bg-navy/10 font-bold border-b-2 border-navy' : 'text-brandDark hover:text-navy hover:bg-brandLight-100' }}">
                        Lacak Laporan
                    </a>
                    <a href="{{ route('education.index') }}"
                        class="px-4 py-2 rounded-xl text-sm font-semibold transition-colors {{ request()->routeIs('education.*') ? 'text-navy bg-navy/10 font-bold border-b-2 border-navy' : 'text-brandDark hover:text-navy hover:bg-brandLight-100' }}">
                        Edukasi Bullying
                    </a>

                    @auth
                        <div class="w-px h-6 bg-brandLight-200 mx-2"></div>
                        <!-- Authenticated User Menu -->
                        <div class="flex items-center gap-2">
                            <a href="{{ route('admin.reports.index') }}"
                                class="px-3.5 py-1.5 rounded-xl text-xs font-bold text-navy bg-navy/10 hover:bg-navy/20 border border-navy/30 transition-colors flex items-center gap-1.5">
                                <svg class="w-3.5 h-3.5 text-navy" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                </svg>
                                <span>Panel Petugas</span>
                            </a>
                            <span class="text-xs text-brandGray font-medium px-1">{{ auth()->user()->name }}</span>
                            <form method="POST" action="{{ route('logout') }}" class="inline">
                                @csrf
                                <button type="submit"
                                    class="px-2.5 py-1.5 rounded-xl text-xs font-semibold text-brandRed hover:text-brandRed-700 hover:bg-brandRed/10 transition-colors"
                                    title="Keluar">
                                    Logout
                                </button>
                            </form>
                        </div>
                    @endauth
                </nav>

                <!-- Mobile Menu Button -->
                <div class="flex md:hidden items-center gap-2">
                    <a href="{{ route('reports.track') }}" class="p-2 rounded-lg text-brandDark hover:bg-brandLight"
                        title="Lacak Laporan">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </a>
                    <button type="button" id="mobile-menu-btn"
                        class="p-2 rounded-lg text-brandDark hover:bg-brandLight focus:outline-none"
                        aria-label="Buka Menu">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path id="menu-icon" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                    </button>
                </div>
            </div>

            <!-- Mobile Dropdown Nav -->
            <div id="mobile-menu" class="hidden md:hidden pb-4 pt-2 border-t border-brandLight-200 space-y-1">
                <a href="{{ route('reports.create') }}"
                    class="block px-3 py-2 rounded-lg text-base font-medium {{ request()->routeIs('reports.create') ? 'text-navy bg-navy/10 font-bold' : 'text-brandDark hover:bg-brandLight' }}">
                    Lapor Sekarang
                </a>
                <a href="{{ route('reports.track') }}"
                    class="block px-3 py-2 rounded-lg text-base font-medium {{ request()->routeIs('reports.track*') ? 'text-navy bg-navy/10 font-bold' : 'text-brandDark hover:bg-brandLight' }}">
                    Lacak Laporan
                </a>
                <a href="{{ route('education.index') }}"
                    class="block px-3 py-2 rounded-lg text-base font-medium {{ request()->routeIs('education.*') ? 'text-navy bg-navy/10 font-bold' : 'text-brandDark hover:bg-brandLight' }}">
                    Edukasi Bullying
                </a>
                @auth
                    <a href="{{ route('admin.reports.index') }}"
                        class="block px-3 py-2 rounded-lg text-base font-medium text-navy bg-navy/10 font-bold">
                        Panel Petugas ({{ auth()->user()->name }})
                    </a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit"
                            class="w-full text-left px-3 py-2 rounded-lg text-base font-medium text-brandRed hover:bg-brandLight">
                            Logout
                        </button>
                    </form>
                @endauth
            </div>
        </div>
    </header>

    <!-- Main Content Area -->
    <main class="flex-grow">
        <!-- Flash Messages -->
        @if(session('success'))
            <div class="max-w-4xl mx-auto px-4 mt-6">
                <div
                    class="p-4 rounded-xl bg-emerald-50 border border-emerald-300 text-emerald-900 flex items-start gap-3 shadow-sm">
                    <svg class="w-5 h-5 text-emerald-600 mt-0.5 shrink-0" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <div class="text-sm font-semibold">{{ session('success') }}</div>
                </div>
            </div>
        @endif

        @if(session('error'))
            <div class="max-w-4xl mx-auto px-4 mt-6">
                <div
                    class="p-4 rounded-xl bg-brandRed/10 border border-brandRed/30 text-brandRed-700 flex items-start gap-3 shadow-sm">
                    <svg class="w-5 h-5 text-brandRed mt-0.5 shrink-0" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <div class="text-sm font-semibold">{{ session('error') }}</div>
                </div>
            </div>
        @endif

        @yield('content')
    </main>

    <!-- Footer (Dark #2E2E2E Theme) -->
    <footer class="bg-[#2E2E2E] text-slate-300 border-t border-[#2E2E2E]/80 mt-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 lg:py-16">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8 lg:gap-12">
                <!-- Col 1: About -->
                <div class="md:col-span-2 space-y-4">
                    <div class="flex items-center gap-3">
                        @if(setting('app_logo') && \Illuminate\Support\Facades\Storage::disk('public')->exists(setting('app_logo')))
                            <img src="{{ asset('storage/' . setting('app_logo')) }}" alt="Logo {{ setting('app_name', 'LaporAman') }}" class="h-10 object-contain">
                        @else
                            <div class="w-9 h-9 rounded-lg bg-navy flex items-center justify-center text-white font-bold">
                                LA
                            </div>
                        @endif
                        <span class="text-xl font-bold text-white tracking-tight">{{ setting('app_name', 'LaporAman') }} {{ setting('institution_name', 'PKBM Pintar Berbakat') }}</span>
                    </div>
                    <p class="text-slate-300 text-sm leading-relaxed max-w-md">
                        Sistem pelaporan resmi perundungan untuk menjamin lingkungan belajar yang sehat, saling
                        menghargai, dan aman bagi seluruh warga belajar {{ setting('institution_name', 'PKBM Pintar Berbakat') }}. Semua aduan diproses
                        dengan kerahasiaan penuh.
                    </p>
                    <div
                        class="flex items-center gap-2 text-xs text-amber-200 bg-navy/50 border border-navy rounded-lg p-2.5 w-fit">
                        <svg class="w-4 h-4 shrink-0 text-amber-300" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                        </svg>
                        <span>Enkripsi privasi & kerahasiaan identitas terjamin</span>
                    </div>
                </div>

                <!-- Col 2: Navigation -->
                <div class="space-y-3">
                    <h4 class="text-sm font-semibold text-white uppercase tracking-wider">Akses Cepat</h4>
                    <ul class="space-y-2 text-sm text-slate-300">
                        <li><a href="{{ route('reports.create') }}" class="hover:text-[#FBA239] transition-colors">Buat
                                Laporan Baru</a></li>
                        <li><a href="{{ route('reports.track') }}" class="hover:text-[#FBA239] transition-colors">Lacak
                                Status Laporan</a></li>
                        <li><a href="{{ route('education.index') }}"
                                class="hover:text-[#FBA239] transition-colors">Edukasi & Pencegahan</a></li>
                        @auth
                            <li><a href="{{ route('admin.reports.index') }}"
                                    class="hover:text-[#FBA239] transition-colors">Portal Penanganan Tutor</a></li>
                        @endauth
                    </ul>
                </div>

                <!-- Col 3: Contact & Emergency -->
                <div class="space-y-3">
                    <h4 class="text-sm font-semibold text-white uppercase tracking-wider">Bantuan & Kontak</h4>
                    <p class="text-xs text-slate-300">Tim Tanggap Perundungan {{ setting('institution_name', 'PKBM Pintar Berbakat') }}</p>
                    <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', setting('contact_phone', '0812-3456-7890')) }}" target="_blank" rel="noopener noreferrer"
                        class="inline-flex items-center gap-2 text-sm font-bold text-[#FBA239] hover:text-amber-300 transition-colors">
                        <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24">
                            <path
                                d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.462-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.589-.487-.501-.669-.51l-.57-.01c-.198 0-.52.074-.792.372s-1.04 1.016-1.04 2.479 1.065 2.876 1.213 3.074c.149.198 2.095 3.2 5.076 4.487.709.306 1.263.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z" />
                        </svg>
                        <span>WhatsApp: {{ setting('contact_phone', '0812-3456-7890') }}</span>
                    </a>
                    @if(setting('contact_email'))
                        <p class="text-xs text-slate-300">Email: {{ setting('contact_email') }}</p>
                    @endif
                    @if(setting('operating_hours'))
                        <p class="text-xs text-slate-400 font-medium">Jam Ops: {{ setting('operating_hours') }}</p>
                    @endif
                </div>
            </div>

            <div class="mt-12 pt-6 border-t border-slate-700 text-center text-xs text-brandGray">
                {{ setting('footer_copyright', '© 2026 PKBM Pintar Berbakat. Hak Cipta Dilindungi.') }}
            </div>
        </div>
    </footer>

    <script>
        // Mobile menu toggle
        const mobileMenuBtn = document.getElementById('mobile-menu-btn');
        const mobileMenu = document.getElementById('mobile-menu');
        if (mobileMenuBtn && mobileMenu) {
            mobileMenuBtn.addEventListener('click', () => {
                mobileMenu.classList.toggle('hidden');
            });
        }
    </script>
    @stack('scripts')
</body>

</html>