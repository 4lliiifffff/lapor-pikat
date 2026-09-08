<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <div class="mb-6">
        <h3 class="text-lg font-bold text-slate-900">Masuk ke Akun</h3>
        <p class="text-xs text-slate-500 mt-0.5">Masukkan email & kata sandi petugas untuk mengelola laporan.</p>
    </div>

    <!-- Info Demo Box -->
    <div class="mb-6 p-3 rounded-xl bg-teal-50 border border-teal-200 text-xs text-teal-800 space-y-1">
        <p class="font-bold flex items-center gap-1 text-teal-900">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            Akun Petugas Tersedia:
        </p>
        <p class="text-[11px]"><span class="font-semibold">Admin:</span> admin@pkbm.id &bull; pass: password</p>
        <p class="text-[11px]"><span class="font-semibold">Tutor:</span> tutor@pkbm.id &bull; pass: password</p>
    </div>

    <form method="POST" action="{{ route('login') }}" class="space-y-4">
        @csrf

        <!-- Email Address -->
        <div>
            <label for="email" class="form-label text-xs font-bold text-slate-700">Alamat Email Petugas</label>
            <input id="email" class="form-input-control text-sm @error('email') border-rose-400 @enderror" type="email" name="email" value="{{ old('email', 'admin@pkbm.id') }}" required autofocus autocomplete="username" placeholder="nama@pkbm.id" />
            @error('email')
                <p class="text-xs text-rose-600 mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Password -->
        <div>
            <div class="flex items-center justify-between mb-1">
                <label for="password" class="form-label text-xs font-bold text-slate-700 mb-0">Kata Sandi</label>
                @if (Route::has('password.request'))
                    <a class="text-xs text-teal-600 hover:text-teal-700 font-medium" href="{{ route('password.request') }}">
                        Lupa sandi?
                    </a>
                @endif
            </div>

            <input id="password" class="form-input-control text-sm @error('password') border-rose-400 @enderror"
                            type="password"
                            name="password"
                            required autocomplete="current-password"
                            placeholder="••••••••" />
            @error('password')
                <p class="text-xs text-rose-600 mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Remember Me -->
        <div class="flex items-center justify-between pt-1">
            <label for="remember_me" class="inline-flex items-center cursor-pointer">
                <input id="remember_me" type="checkbox" class="rounded border-slate-300 text-teal-600 shadow-sm focus:ring-teal-500 w-4 h-4" name="remember">
                <span class="ms-2 text-xs text-slate-600">Ingat sesi saya</span>
            </label>
        </div>

        <div class="pt-2">
            <button type="submit" class="btn-primary w-full py-2.5 text-sm shadow-md">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"/></svg>
                Masuk ke Panel
            </button>
        </div>

        <div class="pt-4 border-t border-slate-100 text-center">
            <a href="{{ route('reports.create') }}" class="text-xs text-slate-500 hover:text-slate-800 transition-colors flex items-center justify-center gap-1">
                &larr; Kembali ke halaman pengaduan publik
            </a>
        </div>
    </form>
</x-guest-layout>
