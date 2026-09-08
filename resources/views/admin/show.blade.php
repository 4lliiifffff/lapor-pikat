@extends('layouts.app')

@section('title', 'Detail Laporan ' . $report->tracking_code . ' - PKBM Pintar Berbakat')

@section('content')
<div class="py-8 lg:py-12 bg-slate-50 min-h-screen">
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Back Button & Breadcrumbs -->
        <div class="mb-6 flex items-center justify-between">
            <a href="{{ route('admin.reports.index') }}" class="inline-flex items-center gap-2 text-sm font-semibold text-slate-600 hover:text-slate-900 transition-colors">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                Kembali ke Daftar Laporan
            </a>
            
            <span class="badge-status {{ $report->status_badge_class }} text-xs py-1 px-3">
                <span class="w-2 h-2 rounded-full bg-current"></span>
                {{ $report->status_label }}
            </span>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            
            <!-- Left 2 Cols: Report Details & Timeline -->
            <div class="lg:col-span-2 space-y-6">
                
                <!-- Main Report Card -->
                <div class="card-glass p-6 sm:p-8 border border-slate-200 shadow-sm space-y-6">
                    <div class="flex items-start justify-between border-b border-slate-200 pb-4">
                        <div>
                            <span class="text-xs text-slate-500 font-bold uppercase tracking-wider block">Kode Pelacakan</span>
                            <span class="font-mono text-2xl font-extrabold text-slate-900">{{ $report->tracking_code }}</span>
                        </div>
                        <div class="text-right">
                            <span class="text-xs text-slate-500 font-bold uppercase tracking-wider block">Waktu Pengiriman</span>
                            <span class="text-xs font-semibold text-slate-700">{{ $report->created_at->translatedFormat('d F Y, H:i') }} WIB</span>
                        </div>
                    </div>

                    <!-- Pelapor Info Box -->
                    <div class="p-4 rounded-xl {{ $report->is_anonymous ? 'bg-slate-100/70 border border-slate-200' : 'bg-blue-50/70 border border-blue-200' }}">
                        <div class="flex items-center justify-between mb-2">
                            <span class="text-xs font-bold uppercase tracking-wider {{ $report->is_anonymous ? 'text-slate-600' : 'text-blue-800' }}">
                                Identitas Pelapor
                            </span>
                            @if(!$report->is_anonymous && $report->reporter_phone)
                                @php
                                    $cleanPhone = preg_replace('/[^0-9]/', '', $report->reporter_phone);
                                    if (str_starts_with($cleanPhone, '0')) {
                                        $cleanPhone = '62' . substr($cleanPhone, 1);
                                    }
                                @endphp
                                <a href="https://wa.me/{{ $cleanPhone }}?text=Halo%20{{ urlencode($report->reporter_name) }},%20kami%20dari%20Tim%20Penanganan%20PKBM%20Pintar%20Berbakat%20ingin%20menindaklanjuti%20laporan%20perundungan%20(Kode:%20{{ $report->tracking_code }})." target="_blank" rel="noopener noreferrer" class="inline-flex items-center gap-1.5 text-xs font-bold text-emerald-700 bg-emerald-100 hover:bg-emerald-200 px-3 py-1 rounded-lg transition-colors">
                                    <svg class="w-3.5 h-3.5 fill-current" viewBox="0 0 24 24"><path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.462-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.501-.669-.51l-.57-.01c-.198 0-.52.074-.792.372s-1.04 1.016-1.04 2.479 1.065 2.876 1.213 3.074c.149.198 2.095 3.2 5.076 4.487.709.306 1.263.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z"/></svg>
                                    Hubungi Pelapor via WA
                                </a>
                            @endif
                        </div>

                        @if($report->is_anonymous)
                            <p class="text-sm font-medium text-slate-700">Pelapor memilih opsi <strong>Anonim (Tanpa Nama & Kontak)</strong>.</p>
                        @else
                            <div class="grid grid-cols-1 sm:grid-cols-3 gap-2 text-xs sm:text-sm">
                                <div><span class="text-slate-500">Nama:</span> <span class="font-bold text-slate-900">{{ $report->reporter_name }}</span></div>
                                <div><span class="text-slate-500">Kelas:</span> <span class="font-bold text-slate-900">{{ $report->reporter_class }}</span></div>
                                <div><span class="text-slate-500">No. WA:</span> <span class="font-bold text-slate-900">{{ $report->reporter_phone }}</span></div>
                            </div>
                        @endif
                    </div>

                    <!-- Details Grid -->
                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 text-xs sm:text-sm">
                        <div class="p-3.5 rounded-xl bg-slate-50 border border-slate-200">
                            <span class="text-slate-500 block text-xs">Jenis Kejadian</span>
                            <span class="font-bold text-slate-900 mt-0.5 block">{{ $report->incident_type_label }}</span>
                        </div>
                        <div class="p-3.5 rounded-xl bg-slate-50 border border-slate-200">
                            <span class="text-slate-500 block text-xs">Tanggal Kejadian</span>
                            <span class="font-bold text-slate-900 mt-0.5 block">{{ $report->incident_date ? $report->incident_date->translatedFormat('d M Y') : 'Tidak dicantumkan' }}</span>
                        </div>
                        <div class="p-3.5 rounded-xl bg-slate-50 border border-slate-200">
                            <span class="text-slate-500 block text-xs">Lokasi Kejadian</span>
                            <span class="font-bold text-slate-900 mt-0.5 block">{{ $report->incident_location ?: 'Tidak dicantumkan' }}</span>
                        </div>
                    </div>

                    @if($report->parties_involved)
                        <div class="p-3.5 rounded-xl bg-slate-50 border border-slate-200 text-xs sm:text-sm">
                            <span class="text-slate-500 block text-xs">Pihak yang Diduga Terlibat</span>
                            <span class="font-semibold text-slate-900 mt-0.5 block">{{ $report->parties_involved }}</span>
                        </div>
                    @endif

                    <!-- Kronologi Lengkap -->
                    <div>
                        <span class="text-xs font-bold uppercase tracking-wider text-slate-500 block mb-2">Kronologi Kejadian</span>
                        <div class="p-4 rounded-xl bg-slate-50 border border-slate-200 text-sm text-slate-800 whitespace-pre-line leading-relaxed">
                            {{ $report->chronology }}
                        </div>
                    </div>

                    <!-- Lampiran Bukti -->
                    @if($report->attachments->count() > 0)
                        <div>
                            <span class="text-xs font-bold uppercase tracking-wider text-slate-500 block mb-2">Bukti Pendukung Terlampir</span>
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                                @foreach($report->attachments as $att)
                                    <div class="p-3 rounded-xl bg-slate-50 border border-slate-200 flex items-center justify-between gap-2">
                                        <div class="flex items-center gap-2 truncate">
                                            <svg class="w-5 h-5 text-teal-600 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13"/></svg>
                                            <div class="truncate">
                                                <p class="text-xs font-semibold text-slate-900 truncate">{{ $att->file_name }}</p>
                                                <p class="text-[10px] text-slate-400">{{ $att->formatted_size }}</p>
                                            </div>
                                        </div>
                                        <a href="{{ $att->url }}" target="_blank" class="text-xs font-bold text-teal-700 bg-white hover:bg-teal-50 px-2.5 py-1.5 rounded-lg border border-slate-200 transition-colors shrink-0">
                                            Buka Berkas
                                        </a>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif

                </div>

                <!-- Timeline Log Riwayat -->
                <div class="card-glass p-6 sm:p-8 border border-slate-200 shadow-sm">
                    <h3 class="text-base font-bold text-slate-900 mb-4 flex items-center gap-2">
                        <svg class="w-5 h-5 text-teal-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        Log Riwayat Tindak Lanjut
                    </h3>

                    <div class="relative pl-6 border-l-2 border-slate-200 space-y-4">
                        @foreach($report->histories as $history)
                            <div class="relative">
                                <div class="absolute -left-[31px] top-1.5 w-4 h-4 rounded-full bg-white border-4 border-teal-600"></div>
                                <div class="bg-slate-50 p-3.5 rounded-xl border border-slate-200 text-xs">
                                    <div class="flex items-center justify-between mb-1">
                                        <span class="font-bold text-slate-900">{{ $history->status_label }}</span>
                                        <span class="text-slate-400">{{ $history->created_at->translatedFormat('d M Y, H:i') }} WIB</span>
                                    </div>
                                    @if($history->note)
                                        <p class="text-slate-600 leading-relaxed">{{ $history->note }}</p>
                                    @endif
                                    @if($history->changed_by)
                                        <span class="text-[10px] text-slate-400 mt-1 block">Oleh: {{ $history->changed_by }}</span>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

            </div>

            <!-- Right 1 Col: Update Status Form -->
            <div class="space-y-6">
                
                <div class="card-glass p-6 border border-slate-200 shadow-sm sticky top-24">
                    <h3 class="text-base font-bold text-slate-900 mb-4 flex items-center gap-2">
                        <svg class="w-5 h-5 text-teal-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                        Perbarui Status Laporan
                    </h3>

                    <form action="{{ route('admin.reports.updateStatus', $report) }}" method="POST" class="space-y-4">
                        @csrf
                        @method('PUT')

                        <div>
                            <label for="status" class="form-label text-xs font-bold">Status Penanganan <span class="text-rose-500">*</span></label>
                            <select name="status" id="status" class="form-input-control text-sm" required>
                                <option value="pending" {{ $report->status === 'pending' ? 'selected' : '' }}>1. Validasi Laporan (Masuk)</option>
                                <option value="reviewing" {{ $report->status === 'reviewing' ? 'selected' : '' }}>2. Investigasi Internal</option>
                                <option value="recommendation" {{ $report->status === 'recommendation' ? 'selected' : '' }}>3. Penyusunan Rekomendasi ke Satgas</option>
                                <option value="awaiting_satgas" {{ $report->status === 'awaiting_satgas' ? 'selected' : '' }}>4. Menunggu Respon Pemanggilan Satgas</option>
                                <option value="satgas_action" {{ in_array($report->status, ['satgas_action', 'investigating']) ? 'selected' : '' }}>5. Pelaksanaan Satgas (Pemulihan & Sanksi)</option>
                                <option value="resolved" {{ $report->status === 'resolved' ? 'selected' : '' }}>6. Selesai Ditangani</option>
                                <option value="rejected" {{ $report->status === 'rejected' ? 'selected' : '' }}>Ditolak (Tidak Valid pada Validasi)</option>
                            </select>
                        </div>

                        <div>
                            <label for="officer_name" class="form-label text-xs font-bold">Nama Petugas / Tutor</label>
                            <input type="text" name="officer_name" id="officer_name" placeholder="Contoh: Bu Siti (Konselor PKBM)" class="form-input-control text-sm">
                        </div>

                        <div>
                            <label for="note" class="form-label text-xs font-bold">Catatan Tindak Lanjut</label>
                            <textarea name="note" id="note" rows="4" placeholder="Tuliskan catatan progres atau pesan tindak lanjut. Catatan ini akan terlihat oleh pelapor saat melacak kode laporan." class="form-input-control text-sm leading-relaxed">{{ old('note', $report->admin_notes) }}</textarea>
                            <p class="form-hint text-[11px]">Catatan ini akan tampil di timeline pelacakan pelapor.</p>
                        </div>

                        <button type="submit" class="btn-primary w-full py-2.5 text-sm">
                            Simpan Perubahan Status
                        </button>
                    </form>
                </div>

            </div>

        </div>

    </div>
</div>
@endsection
