@extends('layouts.admin')

@section('title', 'Panel Petugas PKBM Pintar Berbakat - Manajemen Laporan')

@section('content')
<div class="py-8 lg:py-12 bg-brandLight-50 min-h-screen">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Header & Title -->
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-8">
            <div>
                <h1 class="text-2xl sm:text-3xl font-extrabold text-navy tracking-tight">
                    Daftar Pengaduan Perundungan
                </h1>
                <p class="text-brandGray text-sm mt-1">
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
            <a href="{{ route('admin.reports.index') }}" class="p-3.5 rounded-xl bg-white border border-brandLight-200 shadow-sm hover:border-navy/40 transition-colors">
                <span class="text-[11px] text-brandGray font-medium block">Total Laporan</span>
                <span class="text-xl font-black text-navy mt-1 block">{{ $stats['total'] }}</span>
            </a>

            <!-- Pending (Validasi) -->
            <a href="{{ route('admin.reports.index', ['status' => 'pending']) }}" class="p-3.5 rounded-xl bg-brandOrange/10 border border-brandOrange/30 shadow-sm hover:border-brandOrange transition-colors">
                <span class="text-[11px] text-brandOrange-700 font-bold block">1. Validasi Internal</span>
                <span class="text-xl font-black text-brandOrange-700 mt-1 block">{{ $stats['pending'] }}</span>
            </a>

            <!-- Reviewing (Investigasi) -->
            <a href="{{ route('admin.reports.index', ['status' => 'reviewing']) }}" class="p-3.5 rounded-xl bg-navy/5 border border-navy/20 shadow-sm hover:border-navy/40 transition-colors">
                <span class="text-[11px] text-navy font-bold block">2. Investigasi Internal</span>
                <span class="text-xl font-black text-navy mt-1 block">{{ $stats['reviewing'] }}</span>
            </a>

            <!-- Awaiting Satgas / Recommendation -->
            <a href="{{ route('admin.reports.index', ['status' => 'awaiting_satgas']) }}" class="p-3.5 rounded-xl bg-navy/10 border border-navy/25 shadow-sm hover:border-navy/40 transition-colors">
                <span class="text-[11px] text-navy font-bold block">3-4. Menunggu Satgas</span>
                <span class="text-xl font-black text-navy mt-1 block">{{ $stats['awaiting_satgas'] + $stats['recommendation'] }}</span>
            </a>

            <!-- Satgas Action -->
            <a href="{{ route('admin.reports.index', ['status' => 'satgas_action']) }}" class="p-3.5 rounded-xl bg-navy/15 border border-navy/30 shadow-sm hover:border-navy/50 transition-colors">
                <span class="text-[11px] text-navy font-bold block">5. Aksi Satgas</span>
                <span class="text-xl font-black text-navy mt-1 block">{{ $stats['satgas_action'] }}</span>
            </a>

            <!-- Resolved -->
            <a href="{{ route('admin.reports.index', ['status' => 'resolved']) }}" class="p-3.5 rounded-xl bg-emerald-50 border border-emerald-200 shadow-sm hover:border-emerald-400 transition-colors">
                <span class="text-[11px] text-emerald-800 font-bold block">Selesai</span>
                <span class="text-xl font-black text-emerald-700 mt-1 block">{{ $stats['resolved'] }}</span>
            </a>
        </div>

        <!-- Filter & Search Controls -->
        <div class="card-glass p-4 sm:p-6 mb-6 border border-brandLight-200">
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
        <div class="bg-white rounded-2xl border border-brandLight-200 shadow-sm overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left text-sm text-brandDark">
                    <thead class="bg-navy/5 border-b border-brandLight-200 text-xs font-bold text-navy uppercase tracking-wider">
                        <tr>
                            <th class="py-3.5 px-4">Kode & Tanggal</th>
                            <th class="py-3.5 px-4">Pelapor</th>
                            <th class="py-3.5 px-4">Jenis & Lokasi</th>
                            <th class="py-3.5 px-4">Ringkasan Kronologi</th>
                            <th class="py-3.5 px-4">Status</th>
                            <th class="py-3.5 px-4 text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-brandLight-100">
                        @forelse($reports as $report)
                            <tr class="hover:bg-brandLight-50 transition-colors">
                                <!-- Kode & Tanggal -->
                                <td class="py-4 px-4 whitespace-nowrap">
                                    <span class="font-mono font-bold text-navy block">{{ $report->tracking_code }}</span>
                                    <span class="text-xs text-brandGray">{{ $report->created_at->translatedFormat('d M Y, H:i') }}</span>
                                </td>

                                <!-- Pelapor -->
                                <td class="py-4 px-4 whitespace-nowrap">
                                    @if($report->is_anonymous)
                                        <span class="inline-flex items-center gap-1 text-xs font-medium text-brandDark bg-brandLight px-2.5 py-1 rounded-md border border-brandLight-200">
                                            <svg class="w-3 h-3 text-brandGray" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                                            Anonim
                                        </span>
                                    @else
                                        <div>
                                            <span class="font-semibold text-brandDark block">{{ $report->reporter_name }}</span>
                                            <span class="text-xs text-brandGray">{{ $report->reporter_class }}</span>
                                        </div>
                                    @endif
                                </td>

                                <!-- Jenis & Lokasi -->
                                <td class="py-4 px-4 whitespace-nowrap">
                                    <span class="font-semibold text-brandDark block">{{ $report->incident_type_label }}</span>
                                    <span class="text-xs text-brandGray">{{ $report->incident_location ?: 'Lokasi tidak disebut' }}</span>
                                </td>

                                <!-- Kronologi -->
                                <td class="py-4 px-4 max-w-xs truncate text-xs text-brandDark">
                                    {{ Str::limit($report->chronology, 80) }}
                                    @if($report->attachments->count() > 0)
                                        <span class="inline-flex items-center gap-1 text-[11px] text-navy bg-navy/10 px-1.5 py-0.5 rounded border border-navy/20 mt-1 font-semibold">
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
                                    <a href="{{ route('admin.reports.show', $report) }}" class="inline-flex items-center gap-1 text-xs font-bold text-navy hover:text-white bg-navy/10 hover:bg-navy py-1.5 px-3 rounded-lg border border-navy/20 transition-colors">
                                        Periksa
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="py-12 text-center text-brandGray">
                                    <p class="text-sm">Tidak ada laporan yang sesuai dengan kriteria filter.</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            @if($reports->hasPages())
                <div class="p-4 border-t border-brandLight-200 bg-brandLight-50">
                    {{ $reports->links() }}
                </div>
            @endif
        </div>

    </div>
</div>
@endsection
