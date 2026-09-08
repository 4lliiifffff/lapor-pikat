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
        <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

        <!-- Scripts & Styles -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans text-slate-800 antialiased bg-slate-50 min-h-screen flex flex-col justify-center py-12 sm:px-6 lg:px-8 relative overflow-hidden selection:bg-teal-500 selection:text-white">
        <!-- Background decorative blur -->
        <div class="absolute -top-40 -left-40 w-96 h-96 bg-teal-200/30 rounded-full blur-3xl pointer-events-none"></div>
        <div class="absolute -bottom-40 -right-40 w-96 h-96 bg-blue-200/20 rounded-full blur-3xl pointer-events-none"></div>

        <div class="sm:mx-auto sm:w-full sm:max-w-md text-center">
            <a href="{{ route('reports.create') }}" class="inline-flex items-center gap-3 group mb-4">
                <div class="w-12 h-12 rounded-2xl bg-gradient-to-br from-teal-500 to-teal-700 flex items-center justify-center text-white shadow-lg shadow-teal-500/25 group-hover:scale-105 transition-transform">
                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                    </svg>
                </div>
            </a>
            <h2 class="text-2xl font-extrabold text-slate-900 tracking-tight">
                Lapor<span class="text-teal-600">Aman</span>
            </h2>
            <p class="text-xs text-slate-500 mt-1 font-semibold uppercase tracking-wider">
                Portal Masuk Petugas & Tutor PKBM Pintar Berbakat
            </p>
        </div>

        <div class="mt-6 sm:mx-auto sm:w-full sm:max-w-md px-4">
            <div class="card-glass py-8 px-6 sm:px-10 shadow-xl border border-slate-200/80">
                {{ $slot }}
            </div>
            
            <p class="text-center text-xs text-slate-400 mt-6">
                &copy; {{ date('Y') }} PKBM Pintar Berbakat. Sistem Pengaduan Aman & Terenkripsi.
            </p>
        </div>
    </body>
</html>
