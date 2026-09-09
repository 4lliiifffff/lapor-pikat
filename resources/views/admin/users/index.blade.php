@extends('layouts.admin')

@section('title', 'Kelola Akun & Monitoring Sistem - Admin LaporAman')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    
    <!-- Page Header & Action -->
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-8 animate-fade-in-up stagger-1">
        <div>
            <h1 class="text-2xl font-extrabold text-navy tracking-tight">Kelola Akun & Monitoring Sistem</h1>
            <p class="text-sm text-brandGray mt-1">Pemantauan akun petugas internal dan hak akses sistem LaporAman PKBM Pintar Berbakat.</p>
        </div>
        <div class="flex items-center gap-3">
            <a href="{{ route('admin.settings.index') }}" class="btn-secondary">
                <svg class="w-4 h-4 text-brandOrange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                <span>Pengaturan CMS & Branding</span>
            </a>
            <a href="{{ route('admin.users.create') }}" class="btn-primary">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                <span>Tambah Akun Baru</span>
            </a>
        </div>
    </div>

    <!-- System Monitoring Metrics -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-8 animate-fade-in-up stagger-2">
        <!-- Metric 1: Total Users -->
        <div class="card-glass p-5 flex items-center gap-4">
            <div class="w-12 h-12 rounded-xl bg-navy/10 border border-navy/20 flex items-center justify-center text-navy shrink-0">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
            </div>
            <div>
                <span class="text-xs font-bold text-brandGray uppercase tracking-wider">Total Akun Petugas</span>
                <h3 class="text-2xl font-black text-navy mt-0.5">{{ $totalUsers }}</h3>
            </div>
        </div>

        <!-- Metric 2: Super Admin Count -->
        <div class="card-glass p-5 flex items-center gap-4">
            <div class="w-12 h-12 rounded-xl bg-brandOrange/10 border border-brandOrange/30 flex items-center justify-center text-brandOrange-600 shrink-0">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
            </div>
            <div>
                <span class="text-xs font-bold text-brandGray uppercase tracking-wider">Super Admin</span>
                <h3 class="text-2xl font-black text-navy mt-0.5">{{ $superAdminsCount }}</h3>
            </div>
        </div>

        <!-- Metric 3: Admin Count -->
        <div class="card-glass p-5 flex items-center gap-4">
            <div class="w-12 h-12 rounded-xl bg-sky-50 border border-sky-200 flex items-center justify-center text-sky-600 shrink-0">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
            </div>
            <div>
                <span class="text-xs font-bold text-brandGray uppercase tracking-wider">Admin Petugas</span>
                <h3 class="text-2xl font-black text-navy mt-0.5">{{ $adminsCount }}</h3>
            </div>
        </div>

        <!-- Metric 4: Total Reports -->
        <div class="card-glass p-5 flex items-center gap-4">
            <div class="w-12 h-12 rounded-xl bg-emerald-50 border border-emerald-200 flex items-center justify-center text-emerald-600 shrink-0">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
            </div>
            <div>
                <span class="text-xs font-bold text-brandGray uppercase tracking-wider">Total Laporan</span>
                <h3 class="text-2xl font-black text-navy mt-0.5">{{ $totalReports }}</h3>
            </div>
        </div>
    </div>

    <!-- Users Table Card -->
    <div class="card-glass overflow-hidden shadow-sm">
        <div class="p-5 border-b border-brandLight-200 bg-brandLight-50/50 flex items-center justify-between">
            <h3 class="text-base font-bold text-navy">Daftar Pengguna Sistem</h3>
            <span class="text-xs text-brandGray font-medium">Menampilkan {{ $users->count() }} dari {{ $users->total() }} akun</span>
        </div>

        <!-- Mobile Card List (visible on small screens) -->
        <div class="block md:hidden divide-y divide-brandLight-200">
            @forelse($users as $user)
                <div class="p-4 space-y-3">
                    <div class="flex items-center justify-between gap-2">
                        <div class="flex items-center gap-2.5">
                            <div class="w-8 h-8 rounded-full bg-navy/10 text-navy font-black flex items-center justify-center text-xs shrink-0">
                                {{ strtoupper(substr($user->name, 0, 2)) }}
                            </div>
                            <div>
                                <span class="font-bold text-brandDark text-sm block">{{ $user->name }}</span>
                                <span class="text-xs text-brandGray">{{ $user->email }}</span>
                            </div>
                        </div>

                        @if($user->hasRole('super_admin'))
                            <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-full text-[10px] font-bold bg-[#FBA239]/10 text-brandOrange-700 border border-[#FBA239]/30 shrink-0">
                                Super Admin
                            </span>
                        @else
                            <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-full text-[10px] font-bold bg-sky-50 text-sky-700 border border-sky-200 shrink-0">
                                Admin Petugas
                            </span>
                        @endif
                    </div>

                    <div class="flex items-center justify-between pt-2 border-t border-brandLight-100 text-xs">
                        <span class="text-brandGray">Dibuat: {{ $user->created_at ? $user->created_at->translatedFormat('d M Y') : '-' }}</span>
                        
                        <div class="flex items-center gap-2">
                            <a href="{{ route('admin.users.edit', $user) }}" class="btn-secondary py-1 px-2.5 text-xs font-semibold">
                                Edit
                            </a>
                            @if(auth()->id() !== $user->id)
                                <form method="POST" action="{{ route('admin.users.destroy', $user) }}" onsubmit="return confirm('Apakah Anda yakin ingin menghapus akun {{ $user->name }}?');" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="px-2.5 py-1 rounded-lg text-xs font-semibold text-brandRed hover:bg-brandRed/10 border border-brandRed/30">
                                        Hapus
                                    </button>
                                </form>
                            @endif
                        </div>
                    </div>
                </div>
            @empty
                <div class="p-8 text-center text-brandGray text-xs">
                    Belum ada akun pengguna yang terdaftar.
                </div>
            @endforelse
        </div>

        <!-- Desktop Table View (visible on medium screens and up) -->
        <div class="hidden md:block overflow-x-auto">
            <table class="w-full text-left text-sm">
                <thead class="bg-navy/5 text-navy font-bold text-xs uppercase tracking-wider border-b border-brandLight-200">
                    <tr>
                        <th class="px-6 py-4">Nama Petugas</th>
                        <th class="px-6 py-4">Email</th>
                        <th class="px-6 py-4">Peranan / Role</th>
                        <th class="px-6 py-4">Tanggal Dibuat</th>
                        <th class="px-6 py-4 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-brandLight-200">
                    @forelse($users as $user)
                        <tr class="hover:bg-brandLight-50/80 transition-colors">
                            <td class="px-6 py-4 font-bold text-brandDark">
                                <div class="flex items-center gap-3">
                                    <div class="w-8 h-8 rounded-full bg-navy/10 text-navy font-black flex items-center justify-center text-xs">
                                        {{ strtoupper(substr($user->name, 0, 2)) }}
                                    </div>
                                    <div>
                                        <span>{{ $user->name }}</span>
                                        @if(auth()->id() === $user->id)
                                            <span class="text-[10px] font-extrabold text-emerald-600 bg-emerald-50 px-1.5 py-0.5 rounded ml-1 border border-emerald-200">(Anda)</span>
                                        @endif
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 text-brandGray font-medium">
                                {{ $user->email }}
                            </td>
                            <td class="px-6 py-4">
                                @if($user->hasRole('super_admin'))
                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-bold bg-[#FBA239]/10 text-brandOrange-700 border border-[#FBA239]/30">
                                        <svg class="w-3.5 h-3.5 text-[#FBA239]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                                        Super Admin
                                    </span>
                                @else
                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-bold bg-sky-50 text-sky-700 border border-sky-200">
                                        <svg class="w-3.5 h-3.5 text-sky-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                                        Admin Petugas
                                    </span>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-brandGray text-xs">
                                {{ $user->created_at ? $user->created_at->translatedFormat('d M Y, H:i') : '-' }}
                            </td>
                            <td class="px-6 py-4 text-right">
                                <div class="flex items-center justify-end gap-2">
                                    <a href="{{ route('admin.users.edit', $user) }}" class="p-2 rounded-lg text-brandGray hover:text-navy hover:bg-navy/5 transition-colors" title="Edit Akun">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                    </a>
                                    
                                    @if(auth()->id() !== $user->id)
                                        <form method="POST" action="{{ route('admin.users.destroy', $user) }}" onsubmit="return confirm('Apakah Anda yakin ingin menghapus akun {{ $user->name }}?');" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="p-2 rounded-lg text-brandRed hover:text-brandRed-700 hover:bg-brandRed/10 transition-colors" title="Hapus Akun">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                            </button>
                                        </form>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-8 text-center text-brandGray text-sm">
                                Belum ada akun pengguna yang terdaftar.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($users->hasPages())
            <div class="p-4 border-t border-brandLight-200 bg-brandLight-50/50">
                {{ $users->links() }}
            </div>
        @endif
    </div>
</div>
@endsection
