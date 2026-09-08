@extends('layouts.app')

@section('title', 'Panel Petugas PKBM Pintar Berbakat - Manajemen Laporan')

@section('content')
<div class="py-8 lg:py-12 bg-slate-50 min-h-screen">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Header & Title -->
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-8">
            <div>
                <span class="text-xs font-bold uppercase tracking-wider text-teal-700 bg-teal-50 px-2.5 py-1 rounded-md border border-teal-200">
                    Panel Penanganan Kasus
                </span>
                <h1 class="text-2xl sm:text-3xl font-extrabold text-slate-900 mt-2 tracking-tight">
                    Daftar Pengaduan Perundungan
                </h1>
                <p class="text-slate-500 text-sm mt-1">
                    Kelola dan tindaklanjuti laporan yang masuk dari warga belajar PKBM Pintar Berbakat.
                </p>
            </div>
            <div class="flex items-center gap-3">
                <a href="{{ route('reports.create') }}" target="_blank" class="btn-secondary text-xs sm:text-sm py-2 px-3.5">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                    Lihat Form Publik
                </a>
            </div>
        </div>

        <!-- Statistics Stats Cards -->
        <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-6 gap-3 mb-8">
            <!-- Total -->
            <a href="{{ route('admin.reports.index') }}" class="p-3.5 rounded-xl bg-white border border-slate-200 shadow-sm hover:border-slate-300 transition-colors">
                <span class="text-[11px] text-slate-500 font-medium block">Total Laporan</span>
                <span class="text-xl font-black text-slate-900 mt-1 block">{{ $stats['total'] }}</span>
            </a>

            <!-- Pending -->
            <a href="{{ route('admin.reports.index', ['status' => 'pending']) }}" class="p-3.5 rounded-xl bg-amber-50/60 border border-amber-200 shadow-sm hover:border-amber-300 transition-colors">
                <span class="text-[11px] text-amber-800 font-medium block">1. Validasi Internal</span>
                <span class="text-xl font-black text-amber-700 mt-1 block">{{ $stats['pending'] }}</span>
            </a>

            <!-- Reviewing -->
            <a href="{{ route('admin.reports.index', ['status' => 'reviewing']) }}" class="p-3.5 rounded-xl bg-blue-50/60 border border-blue-200 shadow-sm hover:border-blue-300 transition-colors">
                <span class="text-[11px] text-blue-800 font-medium block">2. Investigasi Internal</span>
                <span class="text-xl font-black text-blue-700 mt-1 block">{{ $stats['reviewing'] }}</span>
            </a>

            <!-- Awaiting Satgas / Recommendation -->
            <a href="{{ route('admin.reports.index', ['status' => 'awaiting_satgas']) }}" class="p-3.5 rounded-xl bg-indigo-50/60 border border-indigo-200 shadow-sm hover:border-indigo-300 transition-colors">
                <span class="text-[11px] text-indigo-800 font-medium block">3-4. Menunggu Satgas</span>
                <span class="text-xl font-black text-indigo-700 mt-1 block">{{ $stats['awaiting_satgas'] + $stats['recommendation'] }}</span>
            </a>

            <!-- Satgas Action -->
            <a href="{{ route('admin.reports.index', ['status' => 'satgas_action']) }}" class="p-3.5 rounded-xl bg-purple-50/60 border border-purple-200 shadow-sm hover:border-purple-300 transition-colors">
                <span class="text-[11px] text-purple-800 font-medium block">5. Aksi Satgas</span>
                <span class="text-xl font-black text-purple-700 mt-1 block">{{ $stats['satgas_action'] }}</span>
            </a>

            <!-- Resolved -->
            <a href="{{ route('admin.reports.index', ['status' => 'resolved']) }}" class="p-3.5 rounded-xl bg-emerald-50/60 border border-emerald-200 shadow-sm hover:border-emerald-300 transition-colors">
                <span class="text-[11px] text-emerald-800 font-medium block">Selesai</span>
                <span class="text-xl font-black text-emerald-700 mt-1 block">{{ $stats['resolved'] }}</span>
            </a>
        </div>

        <!-- Filter & Search Controls -->
        <div class="card-glass p-4 sm:p-6 mb-6 border border-slate-200">
            <form action="{{ route('admin.reports.index') }}" method="GET" class="grid grid-cols-1 sm:grid-cols-3 lg:grid-cols-4 gap-3">
                
                <!-- Search Input -->
                <div class="sm:col-span-2">
                    <input type="text" name="q" value="{{ $search }}" placeholder="Cari kode, nama pelapor, lokasi, kronologi..." class="form-input-control text-sm py-2">
                </div>

                <!-- Status Filter -->
                <div>
                    <select name="status" class="form-input-control text-sm py-2" onchange="this.form.submit()">
                        <option value="">Semua Status Penanganan</option>
                        <option value="pending" {{ $statusFilter === 'pending' ? 'selected' : '' }}>1. Menunggu Validasi Internal</option>
                        <option value="reviewing" {{ $statusFilter === 'reviewing' ? 'selected' : '' }}>2. Investigasi Internal</option>
                        <option value="recommendation" {{ $statusFilter === 'recommendation' ? 'selected' : '' }}>3. Penyusunan Rekomendasi Satgas</option>
                        <option value="awaiting_satgas" {{ $statusFilter === 'awaiting_satgas' ? 'selected' : '' }}>4. Menunggu Respon Satgas</option>
                        <option value="satgas_action" {{ $statusFilter === 'satgas_action' ? 'selected' : '' }}>5. Aksi Satgas (Pemulihan & Sanksi)</option>
                        <option value="resolved" {{ $statusFilter === 'resolved' ? 'selected' : '' }}>6. Selesai Ditangani</option>
                        <option value="rejected" {{ $statusFilter === 'rejected' ? 'selected' : '' }}>Ditolak (Tidak Valid)</option>
                    </select>
                </div>

                <!-- Method Filter -->
                <div>
                    <select name="method" class="form-input-control text-sm py-2" onchange="this.form.submit()">
                        <option value="">Semua Metode Pelaporan</option>
                        <option value="anonymous" {{ $methodFilter === 'anonymous' ? 'selected' : '' }}>Anonim</option>
                        <option value="personal" {{ $methodFilter === 'personal' ? 'selected' : '' }}>Pakai Data Diri</option>
                    </select>
                </div>
            </form>
        </div>

        <!-- Reports List Table -->
        <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left text-sm text-slate-700">
                    <thead class="bg-slate-50 border-b border-slate-200 text-xs font-bold text-slate-500 uppercase tracking-wider">
                        <tr>
                            <th class="py-3.5 px-4">Kode & Tanggal</th>
                            <th class="py-3.5 px-4">Pelapor</th>
                            <th class="py-3.5 px-4">Jenis & Lokasi</th>
                            <th class="py-3.5 px-4">Ringkasan Kronologi</th>
                            <th class="py-3.5 px-4">Status</th>
                            <th class="py-3.5 px-4 text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @forelse($reports as $report)
                            <tr class="hover:bg-slate-50/80 transition-colors">
                                <!-- Kode & Tanggal -->
                                <td class="py-4 px-4 whitespace-nowrap">
                                    <span class="font-mono font-bold text-slate-900 block">{{ $report->tracking_code }}</span>
                                    <span class="text-xs text-slate-400">{{ $report->created_at->translatedFormat('d M Y, H:i') }}</span>
                                </td>

                                <!-- Pelapor -->
                                <td class="py-4 px-4 whitespace-nowrap">
                                    @if($report->is_anonymous)
                                        <span class="inline-flex items-center gap-1 text-xs font-medium text-slate-600 bg-slate-100 px-2.5 py-1 rounded-md">
                                            <svg class="w-3 h-3 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                                            Anonim
                                        </span>
                                    @else
                                        <div>
                                            <span class="font-semibold text-slate-900 block">{{ $report->reporter_name }}</span>
                                            <span class="text-xs text-slate-500">{{ $report->reporter_class }}</span>
                                        </div>
                                    @endif
                                </td>

                                <!-- Jenis & Lokasi -->
                                <td class="py-4 px-4 whitespace-nowrap">
                                    <span class="font-medium text-slate-800 block">{{ $report->incident_type_label }}</span>
                                    <span class="text-xs text-slate-400">{{ $report->incident_location ?: 'Lokasi tidak disebut' }}</span>
                                </td>

                                <!-- Kronologi -->
                                <td class="py-4 px-4 max-w-xs truncate text-xs text-slate-600">
                                    {{ Str::limit($report->chronology, 80) }}
                                    @if($report->attachments->count() > 0)
                                        <span class="inline-flex items-center gap-1 text-[11px] text-teal-700 bg-teal-50 px-1.5 py-0.5 rounded border border-teal-200 mt-1">
                                            📎 {{ $report->attachments->count() }} berkas
                                        </span>
                                    @endif
                                </td>

                                <!-- Status -->
                                <td class="py-4 px-4 whitespace-nowrap">
                                    <span class="badge-status {{ $report->status_badge_class }}">
                                        {{ $report->status_label }}
                                    </span>
                                </td>

                                <!-- Aksi -->
                                <td class="py-4 px-4 whitespace-nowrap text-right">
                                    <a href="{{ route('admin.reports.show', $report) }}" class="inline-flex items-center gap-1 text-xs font-bold text-teal-700 hover:text-teal-900 bg-teal-50 hover:bg-teal-100 py-1.5 px-3 rounded-lg border border-teal-200 transition-colors">
                                        Periksa
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="py-12 text-center text-slate-400">
                                    <p class="text-sm">Tidak ada laporan yang sesuai dengan kriteria filter.</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            @if($reports->hasPages())
                <div class="p-4 border-t border-slate-200 bg-slate-50">
                    {{ $reports->links() }}
                </div>
            @endif
        </div>

    </div>
</div>
@endsection
