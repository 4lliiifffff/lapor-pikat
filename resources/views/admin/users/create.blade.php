@extends('layouts.admin')

@section('title', 'Tambah Akun Baru - Admin LaporAman')

@section('content')
<div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="mb-6">
        <a href="{{ route('admin.users.index') }}" class="inline-flex items-center gap-1.5 text-xs font-bold text-brandGray hover:text-navy transition-colors mb-2">
            &larr; Kembali ke daftar akun
        </a>
        <h1 class="text-2xl font-extrabold text-navy tracking-tight">Tambah Akun Petugas Baru</h1>
        <p class="text-sm text-brandGray mt-0.5">Buat akun akses internal untuk petugas atau super admin sistem.</p>
    </div>

    <div class="card-glass p-6 sm:p-8">
        <form method="POST" action="{{ route('admin.users.store') }}" class="space-y-6">
            @csrf

            <!-- Nama Lengkap -->
            <div>
                <label for="name" class="form-label">Nama Lengkap Petugas <span class="text-brandRed">*</span></label>
                <input id="name" type="text" name="name" value="{{ old('name') }}" class="form-input-control @error('name') border-brandRed @enderror" placeholder="Contoh: Bpk. Ahmad (Tutor Utama)" required autofocus>
                @error('name')
                    <p class="text-xs text-brandRed mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Email Address -->
            <div>
                <label for="email" class="form-label">Alamat Email Akses <span class="text-brandRed">*</span></label>
                <input id="email" type="email" name="email" value="{{ old('email') }}" class="form-input-control @error('email') border-brandRed @enderror" placeholder="nama@pkbm.id" required>
                @error('email')
                    <p class="text-xs text-brandRed mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Peranan / Role Select -->
            <div>
                <label for="role" class="form-label">Peranan Akses (Role) <span class="text-brandRed">*</span></label>
                <select id="role" name="role" class="form-input-control @error('role') border-brandRed @enderror" required>
                    <option value="" disabled selected>-- Pilih Peranan Akses --</option>
                    <option value="admin" {{ old('role') === 'admin' ? 'selected' : '' }}>Admin (Pengelolaan Laporan Kasus)</option>
                    <option value="super_admin" {{ old('role') === 'super_admin' ? 'selected' : '' }}>Super Admin (Monitoring & Akses Pengelolaan Akun Full)</option>
                </select>
                @error('role')
                    <p class="text-xs text-brandRed mt-1">{{ $message }}</p>
                @enderror
                <p class="form-hint">Super Admin memiliki wewenang untuk menambah, mengubah, dan menghapus akun pengguna sistem.</p>
            </div>

            <!-- Password -->
            <div>
                <label for="password" class="form-label">Kata Sandi <span class="text-brandRed">*</span></label>
                <input id="password" type="password" name="password" class="form-input-control @error('password') border-brandRed @enderror" placeholder="Minimal 8 karakter" required>
                @error('password')
                    <p class="text-xs text-brandRed mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="pt-4 border-t border-brandLight-200 flex items-center justify-end gap-3">
                <a href="{{ route('admin.users.index') }}" class="btn-secondary">
                    Batal
                </a>
                <button type="submit" class="btn-primary">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                    Simpan Akun Baru
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
