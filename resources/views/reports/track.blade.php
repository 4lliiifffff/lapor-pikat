@extends('layouts.app')

@section('title', 'Lacak Status Laporan - Lapor Aman PKBM Pintar Berbakat')

@section('content')
<div class="py-10 lg:py-16">
    <div class="max-w-3xl mx-auto px-4 sm:px-6">
        
        <!-- Search Card -->
        <div class="card-glass p-6 sm:p-10 mb-10 shadow-lg border border-brandLight-200 animate-fade-in-up stagger-1">
            <div class="text-center max-w-xl mx-auto mb-6">
                <div class="w-12 h-12 mx-auto rounded-xl bg-navy/10 text-navy flex items-center justify-center mb-3 hover:scale-110 transition-transform duration-200">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                </div>
                <h1 class="text-2xl sm:text-3xl font-extrabold text-navy tracking-tight">
                    Lacak laporanmu
                </h1>
                <p class="mt-2 text-brandGray text-sm">
                    Masukkan kode pelacakan yang kamu simpan saat mengirim laporan.
                </p>
            </div>

            <form action="{{ route('reports.track.search') }}" method="POST" class="space-y-4">
                @csrf
                <div>
                    <label for="tracking_code" class="form-label font-bold text-navy">Kode pelacakan</label>
                    <div class="relative">
                        <input type="text" name="tracking_code" id="tracking_code" value="{{ old('tracking_code', isset($report) ? $report->tracking_code : '') }}" placeholder="ABT-XXXX-XXXX" class="form-input-control uppercase tracking-widest font-mono text-base py-3 pl-4 pr-12 @error('tracking_code') border-brandRed @enderror" required>
                        <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none text-brandGray">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z"/></svg>
                        </div>
                    </div>
                    @error('tracking_code')
                        <p class="text-xs text-brandRed mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <button type="submit" class="btn-primary w-full py-3">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                    Lihat status
                </button>
            </form>
        </div>

        <!-- Tracking Result Details (If $report exists) -->
        @if(isset($report))
            <div class="card-glass p-6 sm:p-8 shadow-xl border border-brandLight-200 space-y-8 animate-fade-in-up stagger-2">
                
                <!-- Header Status -->
                <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 pb-6 border-b border-brandLight-200">
                    <div>
                        <span class="text-xs font-semibold text-brandGray uppercase tracking-wider block">Status Laporan</span>
                        <div class="flex items-center gap-3 mt-1.5">
                            <span class="badge-status {{ $report->status_badge_class }} text-sm py-1.5 px-3.5">
                                <span class="w-2 h-2 rounded-full bg-current"></span>
                                {{ $report->status_label }}
                            </span>
                        </div>
                    </div>
                    <div class="sm:text-right">
                        <span class="text-xs font-semibold text-brandGray uppercase tracking-wider block">Kode Pelacakan</span>
                        <span class="font-mono font-bold text-navy text-lg sm:text-xl">{{ $report->tracking_code }}</span>
                    </div>
                </div>

                <!-- Multi-Step Status Stepper -->
                @if($report->status === 'rejected')
                    <div class="p-4 rounded-xl bg-brandRed/10 border border-brandRed/30 text-brandRed-700 text-xs sm:text-sm flex items-start gap-3">
                        <svg class="w-5 h-5 text-brandRed mt-0.5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        <div>
                            <span class="font-bold block text-sm">Laporan Ditolak (Tidak Valid)</span>
                            <span>Laporan ini telah diteliti oleh petugas internal dan diputuskan ditolak karena informasi tidak memenuhi syarat/validasi keabsahan.</span>
                        </div>
                    </div>
                @else
                    <div class="p-5 rounded-2xl bg-white border border-brandLight-200">
                        <span class="text-xs font-bold uppercase tracking-wider text-navy block mb-4">Progres Penanganan Kasus (5 Tahap)</span>
                        <div class="grid grid-cols-1 min-[480px]:grid-cols-2 sm:grid-cols-3 lg:grid-cols-5 gap-2.5">
                            <!-- Step 1: Validasi -->
                            @php
                                $s1Done = in_array($report->status, ['reviewing', 'recommendation', 'awaiting_satgas', 'satgas_action', 'investigating', 'resolved']);
                                $s1Active = in_array($report->status, ['pending', 'reviewing', 'recommendation', 'awaiting_satgas', 'satgas_action', 'investigating', 'resolved']);
                            @endphp
                            <div class="p-3 rounded-xl border {{ $s1Active ? 'bg-white border-brandOrange shadow-sm' : 'bg-brandLight-50 border-brandLight-200 text-brandGray' }}">
                                <div class="flex items-center gap-1.5 mb-1">
                                    <span class="w-4 h-4 rounded-full text-[9px] font-extrabold flex items-center justify-center {{ $s1Done ? 'bg-emerald-600 text-white' : ($s1Active ? 'bg-brandOrange text-white' : 'bg-brandGray/30 text-brandDark') }}">
                                        {{ $s1Done ? '✓' : '1' }}
                                    </span>
                                    <span class="font-bold text-[11px] {{ $s1Active ? 'text-brandDark' : 'text-brandGray' }}">1. Validasi</span>
                                </div>
                                <p class="text-[10px] text-brandGray leading-normal">Validasi kelayakan oleh petugas internal.</p>
                            </div>

                            <!-- Step 2: Investigasi Internal -->
                            @php
                                $s2Done = in_array($report->status, ['recommendation', 'awaiting_satgas', 'satgas_action', 'investigating', 'resolved']);
                                $s2Active = in_array($report->status, ['reviewing', 'recommendation', 'awaiting_satgas', 'satgas_action', 'investigating', 'resolved']);
                            @endphp
                            <div class="p-3 rounded-xl border {{ $s2Active ? 'bg-white border-navy/40 shadow-sm' : 'bg-brandLight-50 border-brandLight-200 text-brandGray' }}">
                                <div class="flex items-center gap-1.5 mb-1">
                                    <span class="w-4 h-4 rounded-full text-[9px] font-extrabold flex items-center justify-center {{ $s2Done ? 'bg-emerald-600 text-white' : ($s2Active ? 'bg-navy text-white' : 'bg-brandGray/30 text-brandDark') }}">
                                        {{ $s2Done ? '✓' : '2' }}
                                    </span>
                                    <span class="font-bold text-[11px] {{ $s2Active ? 'text-brandDark' : 'text-brandGray' }}">2. Investigasi</span>
                                </div>
                                <p class="text-[10px] text-brandGray leading-normal">Pemeriksaan bukti oleh pihak internal.</p>
                            </div>

                            <!-- Step 3: Rekomendasi Satgas -->
                            @php
                                $s3Done = in_array($report->status, ['awaiting_satgas', 'satgas_action', 'investigating', 'resolved']);
                                $s3Active = in_array($report->status, ['recommendation', 'awaiting_satgas', 'satgas_action', 'investigating', 'resolved']);
                            @endphp
                            <div class="p-3 rounded-xl border {{ $s3Active ? 'bg-white border-navy/50 shadow-sm' : 'bg-brandLight-50 border-brandLight-200 text-brandGray' }}">
                                <div class="flex items-center gap-1.5 mb-1">
                                    <span class="w-4 h-4 rounded-full text-[9px] font-extrabold flex items-center justify-center {{ $s3Done ? 'bg-emerald-600 text-white' : ($s3Active ? 'bg-navy text-white' : 'bg-brandGray/30 text-brandDark') }}">
                                        {{ $s3Done ? '✓' : '3' }}
                                    </span>
                                    <span class="font-bold text-[11px] {{ $s3Active ? 'text-brandDark' : 'text-brandGray' }}">3. Rekomendasi</span>
                                </div>
                                <p class="text-[10px] text-brandGray leading-normal">Penyusunan rekomendasi ke Satgas.</p>
                            </div>

                            <!-- Step 4: Respon & Aksi Satgas -->
                            @php
                                $s4Done = $report->status === 'resolved';
                                $s4Active = in_array($report->status, ['awaiting_satgas', 'satgas_action', 'investigating', 'resolved']);
                            @endphp
                            <div class="p-3 rounded-xl border {{ $s4Active ? 'bg-white border-navy/60 shadow-sm' : 'bg-brandLight-50 border-brandLight-200 text-brandGray' }}">
                                <div class="flex items-center gap-1.5 mb-1">
                                    <span class="w-4 h-4 rounded-full text-[9px] font-extrabold flex items-center justify-center {{ $s4Done ? 'bg-emerald-600 text-white' : ($s4Active ? 'bg-navy text-white animate-pulse' : 'bg-brandGray/30 text-brandDark') }}">
                                        {{ $s4Done ? '✓' : '4' }}
                                    </span>
                                    <span class="font-bold text-[11px] {{ $s4Active ? 'text-brandDark' : 'text-brandGray' }}">4. Aksi Satgas</span>
                                </div>
                                <p class="text-[10px] text-brandGray leading-normal">Pemulihan korban & sanksi bagi pelaku.</p>
                            </div>

                            <!-- Step 5: Selesai -->
                            @php
                                $s5Active = $report->status === 'resolved';
                            @endphp
                            <div class="p-3 rounded-xl border {{ $s5Active ? 'bg-white border-emerald-400 shadow-sm' : 'bg-brandLight-50 border-brandLight-200 text-brandGray' }}">
                                <div class="flex items-center gap-1.5 mb-1">
                                    <span class="w-4 h-4 rounded-full text-[9px] font-extrabold flex items-center justify-center {{ $s5Active ? 'bg-emerald-600 text-white' : 'bg-brandGray/30 text-brandDark' }}">
                                        {{ $s5Active ? '✓' : '5' }}
                                    </span>
                                    <span class="font-bold text-[11px] {{ $s5Active ? 'text-brandDark' : 'text-brandGray' }}">5. Selesai</span>
                                </div>
                                <p class="text-[10px] text-brandGray leading-normal">Kasus tuntas ditangani Satgas.</p>
                            </div>
                        </div>
                    </div>
                @endif

                <!-- Info Grid -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 text-xs sm:text-sm">
                    <div class="p-4 rounded-xl bg-white border border-brandLight-200 space-y-2">
                        <div>
                            <span class="text-brandGray block">Jenis Kejadian</span>
                            <span class="font-semibold text-brandDark">{{ $report->incident_type_label }}</span>
                        </div>
                        <div>
                            <span class="text-brandGray block">Metode Pelaporan</span>
                            <span class="font-semibold text-brandDark">{{ $report->is_anonymous ? 'Anonim (Tanpa Nama)' : 'Dengan Data Pribadi' }}</span>
                        </div>
                        <div>
                            <span class="text-brandGray block">Waktu Laporan Dibuat</span>
                            <span class="font-semibold text-brandDark">{{ $report->created_at->translatedFormat('d F Y, H:i') }} WIB</span>
                        </div>
                    </div>

                    <div class="p-4 rounded-xl bg-white border border-brandLight-200 space-y-2">
                        <div>
                            <span class="text-brandGray block">Tanggal Kejadian</span>
                            <span class="font-semibold text-brandDark">{{ $report->incident_date ? $report->incident_date->translatedFormat('d F Y') : 'Tidak dicantumkan' }}</span>
                        </div>
                        <div>
                            <span class="text-brandGray block">Lokasi Kejadian</span>
                            <span class="font-semibold text-brandDark">{{ $report->incident_location ?: 'Tidak dicantumkan' }}</span>
                        </div>
                        <div>
                            <span class="text-brandGray block">Pihak Terlibat</span>
                            <span class="font-semibold text-brandDark">{{ $report->parties_involved ?: 'Tidak dicantumkan' }}</span>
                        </div>
                    </div>
                </div>

                <!-- Kronologi Summary -->
                <div class="p-4 rounded-xl bg-white border border-brandLight-200">
                    <span class="text-xs font-semibold text-brandGray uppercase tracking-wider block mb-2">Kronologi yang Dilaporkan</span>
                    <p class="text-sm text-brandDark whitespace-pre-line leading-relaxed">{{ $report->chronology }}</p>
                </div>

                <!-- Attachments List if any -->
                @if($report->attachments->count() > 0)
                    <div class="p-4 rounded-xl bg-white border border-brandLight-200">
                        <span class="text-xs font-semibold text-brandGray uppercase tracking-wider block mb-3">Bukti Pendukung Terlampir ({{ $report->attachments->count() }})</span>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                            @foreach($report->attachments as $att)
                                <a href="{{ $att->url }}" target="_blank" class="flex items-center gap-2 p-2.5 rounded-lg bg-brandLight-50 border border-brandLight-200 hover:border-navy transition-colors text-xs text-brandDark group">
                                    <svg class="w-4 h-4 text-navy shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13"/></svg>
                                    <span class="truncate font-medium group-hover:text-navy">{{ $att->file_name }}</span>
                                    <span class="text-brandGray shrink-0 ml-auto">({{ $att->formatted_size }})</span>
                                </a>
                            @endforeach
                        </div>
                    </div>
                @endif

                <!-- Timeline Riwayat Penanganan -->
                <div>
                    <h3 class="text-base font-bold text-navy mb-4 flex items-center gap-2">
                        <svg class="w-5 h-5 text-navy" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        Riwayat Tindak Lanjut Tim PKBM Pintar Berbakat
                    </h3>

                    <div class="relative pl-6 border-l-2 border-navy/30 space-y-6">
                        @forelse($report->histories as $history)
                            <div class="relative">
                                <!-- Dot Marker -->
                                <div class="absolute -left-[31px] top-1 w-4 h-4 rounded-full bg-white border-4 border-navy"></div>
                                
                                <div class="bg-white p-4 rounded-xl border border-brandLight-200 shadow-sm">
                                    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-1 mb-1.5">
                                        <span class="font-bold text-sm text-navy">{{ $history->status_label }}</span>
                                        <span class="text-xs text-brandGray">{{ $history->created_at->translatedFormat('d M Y, H:i') }} WIB</span>
                                    </div>
                                    @if($history->note)
                                        <p class="text-xs sm:text-sm text-brandDark leading-relaxed">{{ $history->note }}</p>
                                    @endif
                                    @if($history->changed_by)
                                        <span class="text-[11px] text-brandGray mt-2 block">Diperbarui oleh: {{ $history->changed_by }}</span>
                                    @endif
                                </div>
                            </div>
                        @empty
                            <p class="text-xs text-brandGray">Belum ada riwayat tercatat.</p>
                        @endforelse
                    </div>
                </div>

                <!-- Emergency Contact CTA -->
                <div class="p-4 rounded-xl bg-navy/5 border border-navy/20 flex flex-col sm:flex-row items-center justify-between gap-4">
                    <div class="text-xs text-navy">
                        <span class="font-bold block text-sm">Butuh bantuan darurat atau pendampingan konseling?</span>
                        <span>Hubungi langsung Tim Tanggap PKBM Pintar Berbakat melalui WhatsApp.</span>
                    </div>
                    <a href="https://wa.me/6282219082518" target="_blank" rel="noopener noreferrer" class="btn-primary text-xs shrink-0 py-2 px-4">
                        Chat Tim PKBM
                    </a>
                </div>

            </div>
        @endif

    </div>
</div>
@endsection
