@extends('layouts.admin')

@section('title', 'Edit Akun - Admin LaporAman')

@section('content')
<div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="mb-6">
        <a href="{{ route('admin.users.index') }}" class="inline-flex items-center gap-1.5 text-xs font-bold text-brandGray hover:text-navy transition-colors mb-2">
            &larr; Kembali ke daftar akun
        </a>
        <h1 class="text-2xl font-extrabold text-navy tracking-tight">Edit Akun: {{ $user->name }}</h1>
        <p class="text-sm text-brandGray mt-0.5">Ubah informasi identitas atau peranan akses akun ini.</p>
    </div>

    <div class="card-glass p-6 sm:p-8">
        <form method="POST" action="{{ route('admin.users.update', $user) }}" class="space-y-6">
            @csrf
            @method('PUT')

            <!-- Nama Lengkap -->
            <div>
                <label for="name" class="form-label">Nama Lengkap Petugas <span class="text-brandRed">*</span></label>
                <input id="name" type="text" name="name" value="{{ old('name', $user->name) }}" class="form-input-control @error('name') border-brandRed @enderror" required>
                @error('name')
                    <p class="text-xs text-brandRed mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Email Address -->
            <div>
                <label for="email" class="form-label">Alamat Email Akses <span class="text-brandRed">*</span></label>
                <input id="email" type="email" name="email" value="{{ old('email', $user->email) }}" class="form-input-control @error('email') border-brandRed @enderror" required>
                @error('email')
                    <p class="text-xs text-brandRed mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Peranan / Role Select -->
            <div>
                <label for="role" class="form-label">Peranan Akses (Role) <span class="text-brandRed">*</span></label>
                <select id="role" name="role" class="form-input-control @error('role') border-brandRed @enderror" required>
                    <option value="admin" {{ old('role', $user->roles->first()?->name) === 'admin' ? 'selected' : '' }}>Admin (Pengelolaan Laporan Kasus)</option>
                    <option value="super_admin" {{ old('role', $user->roles->first()?->name) === 'super_admin' ? 'selected' : '' }}>Super Admin (Monitoring & Akses Pengelolaan Akun Full)</option>
                </select>
                @error('role')
                    <p class="text-xs text-brandRed mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Optional New Password -->
            <div class="p-4 rounded-xl bg-brandLight-50 border border-brandLight-200 space-y-4">
                <div>
                    <label for="password" class="form-label mb-0 text-navy font-bold">Ubah Kata Sandi Baru (Opsional)</label>
                    <p class="text-xs text-brandGray mb-2">Kosongkan kolom di bawah jika tidak ingin mengganti kata sandi pengguna ini.</p>
                    <input id="password" type="password" name="password" class="form-input-control @error('password') border-brandRed @enderror" placeholder="Biarkan kosong jika tidak diubah">
                    @error('password')
                        <p class="text-xs text-brandRed mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="pt-4 border-t border-brandLight-200 flex items-center justify-end gap-3">
                <a href="{{ route('admin.users.index') }}" class="btn-secondary">
                    Batal
                </a>
                <button type="submit" class="btn-primary">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                    Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
