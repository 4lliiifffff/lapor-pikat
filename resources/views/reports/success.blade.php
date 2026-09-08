@extends('layouts.app')

@section('title', 'Laporan Berhasil Terkirim - Lapor Aman PKBM Pintar Berbakat')

@section('content')
<div class="py-12 lg:py-20">
    <div class="max-w-2xl mx-auto px-4 sm:px-6">
        
        <div class="card-glass p-8 sm:p-12 text-center shadow-xl border border-slate-200">
            
            <!-- Success Icon -->
            <div class="w-16 h-16 sm:w-20 sm:h-20 mx-auto rounded-2xl bg-emerald-100 text-emerald-600 flex items-center justify-center mb-6 shadow-sm ring-8 ring-emerald-50">
                <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7" />
                </svg>
            </div>

            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-emerald-50 border border-emerald-200 text-emerald-800 text-xs font-bold uppercase tracking-wider mb-3">
                Laporan Berhasil Dikirim
            </span>

            <h1 class="text-2xl sm:text-3xl font-extrabold text-slate-900 tracking-tight">
                Terima kasih sudah berani bersuara
            </h1>

            <p class="mt-3 text-slate-600 text-sm sm:text-base leading-relaxed">
                Laporanmu telah masuk ke sistem dengan status <span class="font-semibold text-amber-700">{{ $report->status_label }}</span>. Petugas internal akan terlebih dahulu melakukan validasi keabsahan laporan ini (jika tidak valid maka laporan ditolak, jika valid akan dilanjutkan ke tahap investigasi internal & penanganan Satgas).
            </p>

            <!-- Tracking Code Box -->
            <div class="mt-8 p-6 rounded-2xl bg-gradient-to-br from-slate-900 to-slate-800 text-white shadow-lg relative overflow-hidden">
                <div class="absolute -right-8 -bottom-8 w-32 h-32 bg-teal-500/10 rounded-full blur-2xl"></div>
                
                <p class="text-xs uppercase tracking-widest text-teal-400 font-bold mb-2">Kode Pelacakan Laporan Kamu</p>
                
                <div class="flex items-center justify-center gap-3 my-3">
                    <span id="tracking-code-val" class="font-mono text-2xl sm:text-3xl font-extrabold tracking-widest text-teal-300 select-all">
                        {{ $report->tracking_code }}
                    </span>
                    <button type="button" onclick="copyTrackingCode()" class="p-2 rounded-lg bg-slate-700 hover:bg-slate-600 text-slate-200 transition-colors title='Salin Kode'">
                        <svg class="w-5 h-5" id="copy-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"/></svg>
                    </button>
                </div>
                
                <p class="text-xs text-slate-400" id="copy-feedback">
                    Simpan atau catat kode ini untuk mengecek tindak lanjut laporan kapan saja.
                </p>
            </div>

            <!-- Detail Info Summary -->
            <div class="mt-6 p-4 rounded-xl bg-slate-50 border border-slate-200 text-left text-xs sm:text-sm text-slate-700 space-y-2">
                <div class="flex justify-between py-1 border-b border-slate-200/60">
                    <span class="text-slate-500">Metode Pelaporan:</span>
                    <span class="font-semibold">{{ $report->is_anonymous ? 'Anonim (Rahasia)' : 'Dengan Data Pribadi (' . $report->reporter_name . ')' }}</span>
                </div>
                <div class="flex justify-between py-1 border-b border-slate-200/60">
                    <span class="text-slate-500">Jenis Kejadian:</span>
                    <span class="font-semibold">{{ $report->incident_type_label }}</span>
                </div>
                <div class="flex justify-between py-1">
                    <span class="text-slate-500">Waktu Terkirim:</span>
                    <span class="font-semibold">{{ $report->created_at->translatedFormat('d F Y, H:i') }} WIB</span>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="mt-8 flex flex-col sm:flex-row items-center justify-center gap-3">
                <a href="{{ route('reports.track.detail', ['code' => $report->tracking_code]) }}" class="btn-primary w-full sm:w-auto">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/></svg>
                    Lacak Status Laporan
                </a>
                <a href="{{ route('reports.create') }}" class="btn-secondary w-full sm:w-auto">
                    Kembali ke Beranda
                </a>
            </div>

        </div>

    </div>
</div>
@endsection

@push('scripts')
<script>
    function copyTrackingCode() {
        const code = document.getElementById('tracking-code-val').innerText.trim();
        navigator.clipboard.writeText(code).then(() => {
            const feedback = document.getElementById('copy-feedback');
            feedback.innerHTML = '<span class="text-emerald-400 font-semibold">✓ Kode pelacakan berhasil disalin ke clipboard!</span>';
            setTimeout(() => {
                feedback.innerText = 'Simpan atau catat kode ini untuk mengecek tindak lanjut laporan kapan saja.';
            }, 3500);
        });
    }
</script>
@endpush
