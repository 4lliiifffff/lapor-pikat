@extends('layouts.app')

@section('title', 'Form Pengaduan Bullying - Lapor Aman PKBM Pintar Berbakat')

@section('content')
<div class="relative overflow-hidden pt-6 pb-16 lg:py-14">


    <div class="max-w-3xl mx-auto px-4 sm:px-6 relative z-10">
        
        <!-- Header Section -->
        <div class="text-center mb-8 animate-fade-in-up stagger-1">
            <h1 class="text-3xl sm:text-4xl font-extrabold text-navy tracking-tight">
                Ceritakan apa yang terjadi
            </h1>
            <p class="mt-3 text-brandGray text-sm sm:text-base leading-relaxed max-w-xl mx-auto">
                Kamu yang pilih: mau lapor tanpa nama, atau pakai data diri supaya tim bisa hubungi langsung. Setelah mengirim, kamu tetap dapat kode pelacakan untuk memantau tindak lanjutnya kapan saja.
            </p>
        </div>

        <!-- Visual Workflow Banner (5 Tahap Penanganan) -->
        <div class="mb-8 p-5 rounded-2xl bg-white border border-brandLight-200 shadow-sm animate-fade-in-up stagger-2 hover:shadow-md transition-shadow duration-300">
            <h3 class="text-xs font-bold uppercase tracking-wider text-navy mb-3 text-center sm:text-left flex items-center justify-center sm:justify-start gap-2">

            <svg class="w-4 h-4 text-navy" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                <span>Alur Penanganan Laporan Pengaduan</span>
            </h3>
            <div class="grid grid-cols-1 min-[480px]:grid-cols-2 sm:grid-cols-3 lg:grid-cols-5 gap-2.5 text-xs">
                <!-- Step 1 -->
                <div class="p-2.5 rounded-xl bg-brandOrange/10 border border-brandOrange/30 hover:-translate-y-0.5 transition-transform duration-200">
                    <span class="font-bold text-brandOrange-700 block mb-1 flex items-center gap-1">
                        <span class="w-4 h-4 rounded-full bg-brandOrange-500 text-white text-[9px] flex items-center justify-center font-black">1</span>
                        Validasi
                    </span>
                    <p class="text-brandDark leading-relaxed text-[10px]">Petugas internal validasi kelayakan. Jika tidak valid &rarr; Ditolak.</p>
                </div>
                <!-- Step 2 -->
                <div class="p-2.5 rounded-xl bg-navy/5 border border-navy/20 hover:-translate-y-0.5 transition-transform duration-200">
                    <span class="font-bold text-navy block mb-1 flex items-center gap-1">
                        <span class="w-4 h-4 rounded-full bg-navy text-white text-[9px] flex items-center justify-center font-black">2</span>
                        Investigasi
                    </span>
                    <p class="text-brandDark leading-relaxed text-[10px]">Investigasi internal. Selesai langsung ATAU buat rekomendasi.</p>
                </div>
                <!-- Step 3 -->
                <div class="p-2.5 rounded-xl bg-navy/10 border border-navy/25 hover:-translate-y-0.5 transition-transform duration-200">
                    <span class="font-bold text-navy block mb-1 flex items-center gap-1">
                        <span class="w-4 h-4 rounded-full bg-navy text-white text-[9px] flex items-center justify-center font-black">3</span>
                        Rekomendasi
                    </span>
                    <p class="text-brandDark leading-relaxed text-[10px]">Pihak internal menyerahkan rekomendasi ke Satgas.</p>
                </div>
                <!-- Step 4 -->
                <div class="p-2.5 rounded-xl bg-navy/15 border border-navy/30 hover:-translate-y-0.5 transition-transform duration-200">
                    <span class="font-bold text-navy block mb-1 flex items-center gap-1">
                        <span class="w-4 h-4 rounded-full bg-navy text-white text-[9px] flex items-center justify-center font-black">4</span>
                        Aksi Satgas
                    </span>
                    <p class="text-brandDark leading-relaxed text-[10px]">Satgas memulihkan korban & memberi sanksi ke pelaku.</p>
                </div>
                <!-- Step 5 -->
                <div class="p-2.5 rounded-xl bg-emerald-50 border border-emerald-200 hover:-translate-y-0.5 transition-transform duration-200">
                    <span class="font-bold text-emerald-800 block mb-1 flex items-center gap-1">
                        <span class="w-4 h-4 rounded-full bg-emerald-600 text-white text-[9px] flex items-center justify-center font-black">5</span>
                        Selesai
                    </span>
                    <p class="text-brandDark leading-relaxed text-[10px]">Kasus selesai ditangani secara tuntas.</p>
                </div>
            </div>
        </div>

        <!-- Form Card Container -->
        <div class="card-glass p-6 sm:p-10 shadow-xl border border-brandLight-200 animate-fade-in-up stagger-3">
            
            <form action="{{ route('reports.store') }}" method="POST" enctype="multipart/form-data" id="report-form" class="space-y-8">
                @csrf

                <!-- Section: Metode Pelaporan -->
                <div>
                    <label class="form-label text-base text-navy font-bold mb-3 flex items-center gap-2">
                        <span>Metode pelaporan</span>
                    </label>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <!-- Pilihan Anonim -->
                        <label class="relative flex flex-col p-4 rounded-xl border-2 cursor-pointer transition-all duration-200 group" id="method-anon-card">
                            <div class="flex items-start justify-between">
                                <div class="flex items-center gap-3">
                                    <div class="w-9 h-9 rounded-lg bg-navy/10 text-navy flex items-center justify-center font-bold">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                                    </div>
                                    <div>
                                        <span class="block font-bold text-brandDark text-base">Anonim</span>
                                        <span class="block text-xs text-brandGray mt-0.5">Tanpa nama, tanpa kontak — sepenuhnya rahasia.</span>
                                    </div>
                                </div>
                                <input type="radio" name="report_method" value="anonymous" class="mt-1 h-4 w-4 text-navy border-brandLight-200 focus:ring-navy" {{ old('report_method', 'anonymous') === 'anonymous' ? 'checked' : '' }} onchange="toggleReportMethod(this.value)">
                            </div>
                        </label>

                        <!-- Pilihan Pakai Data Saya -->
                        <label class="relative flex flex-col p-4 rounded-xl border-2 cursor-pointer transition-all duration-200 group" id="method-personal-card">
                            <div class="flex items-start justify-between">
                                <div class="flex items-center gap-3">
                                    <div class="w-9 h-9 rounded-lg bg-navy/10 text-navy flex items-center justify-center font-bold">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                    </div>
                                    <div>
                                        <span class="block font-bold text-brandDark text-base">Pakai Data Saya</span>
                                        <span class="block text-xs text-brandGray mt-0.5">Beri nama & WhatsApp supaya tim bisa hubungi langsung.</span>
                                    </div>
                                </div>
                                <input type="radio" name="report_method" value="personal" class="mt-1 h-4 w-4 text-navy border-brandLight-200 focus:ring-navy" {{ old('report_method') === 'personal' ? 'checked' : '' }} onchange="toggleReportMethod(this.value)">
                            </div>
                        </label>
                    </div>
                </div>

                <!-- Section: Data Diri Pelapor (Tampil jika Pakai Data Saya) -->
                <div id="personal-fields" class="space-y-4 pt-2 border-t border-brandLight-200 {{ old('report_method') === 'personal' ? '' : 'hidden' }}">
                    <div class="bg-navy/5 border border-navy/20 rounded-xl p-3.5 text-xs text-navy flex items-start gap-2.5">
                        <svg class="w-4 h-4 text-navy shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        <span>Data dirimu hanya digunakan oleh Tim Penanganan PKBM Pintar Berbakat untuk menghubungi kamu dalam pendampingan kasus dan tidak akan disebarluaskan.</span>
                    </div>

                    <!-- Input Nama -->
                    <div>
                        <label for="reporter_name" class="form-label">Nama Lengkap <span class="text-brandRed">*</span></label>
                        <input type="text" name="reporter_name" id="reporter_name" value="{{ old('reporter_name') }}" placeholder="Contoh: Ahmad Fauzi" class="form-input-control @error('reporter_name') border-brandRed @enderror">
                        @error('reporter_name')
                            <p class="text-xs text-brandRed mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Input Kelas -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label for="reporter_class" class="form-label">Kelas <span class="text-brandRed">*</span></label>
                            <select name="reporter_class" id="reporter_class" class="form-input-control @error('reporter_class') border-brandRed @enderror">
                                <option value="">— Pilih kelas —</option>
                                @foreach($classes as $class)
                                    <option value="{{ $class }}" {{ old('reporter_class') === $class ? 'selected' : '' }}>{{ $class }}</option>
                                @endforeach
                            </select>
                            @error('reporter_class')
                                <p class="text-xs text-brandRed mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Input WhatsApp -->
                        <div>
                            <label for="reporter_phone" class="form-label">No. WhatsApp yang bisa dihubungi <span class="text-brandRed">*</span></label>
                            <input type="text" name="reporter_phone" id="reporter_phone" value="{{ old('reporter_phone') }}" placeholder="08xxxxxxxxxx" class="form-input-control @error('reporter_phone') border-brandRed @enderror">
                            @error('reporter_phone')
                                <p class="text-xs text-brandRed mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="border-t border-brandLight-200 pt-6 space-y-6">
                    
                    <!-- Jenis Kejadian -->
                    <div>
                        <label for="incident_type" class="form-label text-base font-bold text-navy">
                            Jenis kejadian <span class="text-brandRed">*</span>
                        </label>
                        <select name="incident_type" id="incident_type" class="form-input-control @error('incident_type') border-brandRed @enderror" required>
                            <option value="">— Pilih salah satu —</option>
                            <option value="fisik" {{ old('incident_type') === 'fisik' ? 'selected' : '' }}>Perundungan Fisik (Memukul, mendorong, merusak barang, dll)</option>
                            <option value="verbal" {{ old('incident_type') === 'verbal' ? 'selected' : '' }}>Perundungan Verbal (Mengejek, mengancam, memanggil nama buruk, dll)</option>
                            <option value="sosial" {{ old('incident_type') === 'sosial' ? 'selected' : '' }}>Perundungan Sosial (Mengucilkan, menyebar rumor, menghasut teman, dll)</option>
                            <option value="online" {{ old('incident_type') === 'online' ? 'selected' : '' }}>Online / Cyberbullying (Meneror chat, menyebar foto/pesan memalukan di medsos)</option>
                            <option value="lainnya" {{ old('incident_type') === 'lainnya' ? 'selected' : '' }}>Bentuk Perundungan Lainnya</option>
                        </select>
                        @error('incident_type')
                            <p class="text-xs text-brandRed mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Ceritakan Kronologinya -->
                    <div>
                        <label for="chronology" class="form-label text-base font-bold text-navy">
                            Ceritakan kronologinya <span class="text-brandRed">*</span>
                        </label>
                        <textarea name="chronology" id="chronology" rows="5" class="form-input-control leading-relaxed @error('chronology') border-brandRed @enderror" placeholder="Apa yang terjadi, kapan, di mana, siapa saja yang tahu...

Tulis sejelas mungkin supaya lebih mudah ditindaklanjuti. Tidak perlu menyebut namamu sendiri jika memilih anonim." required>{{ old('chronology') }}</textarea>
                        <p class="form-hint">
                            Tulis sejelas mungkin supaya lebih mudah ditindaklanjuti. Tidak perlu menyebut namamu sendiri.
                        </p>
                        @error('chronology')
                            <p class="text-xs text-brandRed mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Info Opsional Grid -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <!-- Tanggal Kejadian -->
                        <div>
                            <label for="incident_date" class="form-label">Tanggal kejadian (opsional)</label>
                            <input type="date" name="incident_date" id="incident_date" value="{{ old('incident_date') }}" class="form-input-control @error('incident_date') border-brandRed @enderror">
                            <p class="form-hint">dd/mm/yyyy</p>
                            @error('incident_date')
                                <p class="text-xs text-brandRed mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Lokasi Kejadian -->
                        <div>
                            <label for="incident_location" class="form-label">Lokasi (opsional)</label>
                            <input type="text" name="incident_location" id="incident_location" value="{{ old('incident_location') }}" placeholder="Contoh: ruang kelas Paket B" class="form-input-control @error('incident_location') border-brandRed @enderror">
                            @error('incident_location')
                                <p class="text-xs text-brandRed mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Siapa yang terlibat -->
                    <div>
                        <label for="parties_involved" class="form-label">Siapa yang terlibat (opsional)</label>
                        <input type="text" name="parties_involved" id="parties_involved" value="{{ old('parties_involved') }}" placeholder="Boleh sebut nama/ciri-ciri, boleh juga dikosongkan" class="form-input-control @error('parties_involved') border-brandRed @enderror">
                        <p class="form-hint">Boleh sebut nama/ciri-ciri, boleh juga dikosongkan</p>
                        @error('parties_involved')
                            <p class="text-xs text-brandRed mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Bukti Pendukung -->
                    <div>
                        <label for="attachments" class="form-label">
                            Bukti pendukung (opsional, maks. 5 file, masing-masing 1MB — JPG/PNG/WEBP/PDF)
                        </label>
                        <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-brandLight-200 border-dashed rounded-xl hover:border-navy transition-colors bg-white">
                            <div class="space-y-1 text-center">
                                <svg class="mx-auto h-10 w-10 text-brandGray" stroke="currentColor" fill="none" viewBox="0 0 48 48">
                                    <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                                <div class="flex text-sm text-brandDark justify-center">
                                    <label for="attachments" class="relative cursor-pointer bg-white rounded-md font-semibold text-navy hover:underline focus-within:outline-none">
                                        <span>Unggah file bukti</span>
                                        <input id="attachments" name="attachments[]" type="file" multiple accept=".jpg,.jpeg,.png,.webp,.pdf" class="sr-only" onchange="displayFileList(this)">
                                    </label>
                                    <p class="pl-1">atau tarik ke sini</p>
                                </div>
                                <p class="text-xs text-brandGray" id="file-chosen-text">No file chosen</p>
                            </div>
                        </div>
                        <ul id="selected-files-list" class="mt-2 space-y-1 text-xs text-brandDark"></ul>
                        @error('attachments')
                            <p class="text-xs text-brandRed mt-1">{{ $message }}</p>
                        @enderror
                        @error('attachments.*')
                            <p class="text-xs text-brandRed mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                </div>

                <!-- Submit Button -->
                <div class="pt-4 border-t border-brandLight-200">
                    <button type="submit" class="btn-primary w-full py-3.5 text-base shadow-lg">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/></svg>
                        Kirim laporan
                    </button>
                    <p class="text-center text-xs text-brandGray mt-3 flex items-center justify-center gap-1.5">
                        <svg class="w-4 h-4 text-navy" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                        Laporanmu dienkripsi dan diproses secara rahasia oleh Tim PKBM Pintar Berbakat.
                    </p>
                </div>

            </form>
        </div>

        <!-- Quick Education Anchor -->
        <div class="mt-8 text-center bg-white border border-brandLight-200 rounded-2xl p-6 shadow-sm">
            <h3 class="font-bold text-navy text-sm sm:text-base">Masih ragu apakah perlakuan yang kamu terima termasuk perundungan?</h3>
            <p class="text-xs sm:text-sm text-brandGray mt-1">Pelajari jenis-jenis bullying dan langkah mengatasinya di halaman edukasi kami.</p>
            <div class="mt-4 flex flex-wrap items-center justify-center gap-3">
                <a href="{{ route('education.index') }}" class="btn-secondary text-xs sm:text-sm py-2 px-4">
                    Buka Panduan Edukasi
                </a>
                <a href="{{ route('reports.track') }}" class="text-navy hover:underline text-xs sm:text-sm font-semibold underline-offset-4 py-2 px-3">
                    Sudah punya kode? Lacak status di sini &rarr;
                </a>
            </div>
        </div>

    </div>
</div>
@endsection

@push('scripts')
<script>
    function toggleReportMethod(method) {
        const personalFields = document.getElementById('personal-fields');
        const anonCard = document.getElementById('method-anon-card');
        const personalCard = document.getElementById('method-personal-card');
        const nameInput = document.getElementById('reporter_name');
        const classInput = document.getElementById('reporter_class');
        const phoneInput = document.getElementById('reporter_phone');

        if (method === 'personal') {
            personalFields.classList.remove('hidden');
            personalCard.classList.add('border-navy', 'bg-navy/5', 'ring-2', 'ring-navy/20');
            anonCard.classList.remove('border-navy', 'bg-navy/5', 'ring-2', 'ring-navy/20');
            anonCard.classList.add('border-brandLight-200', 'bg-white');
            nameInput.setAttribute('required', 'required');
            classInput.setAttribute('required', 'required');
            phoneInput.setAttribute('required', 'required');
        } else {
            personalFields.classList.add('hidden');
            anonCard.classList.add('border-navy', 'bg-navy/5', 'ring-2', 'ring-navy/20');
            personalCard.classList.remove('border-navy', 'bg-navy/5', 'ring-2', 'ring-navy/20');
            personalCard.classList.add('border-brandLight-200', 'bg-white');
            nameInput.removeAttribute('required');
            classInput.removeAttribute('required');
            phoneInput.removeAttribute('required');
        }
    }

    function displayFileList(input) {
        const fileList = document.getElementById('selected-files-list');
        const chosenText = document.getElementById('file-chosen-text');
        fileList.innerHTML = '';
        
        if (input.files.length > 0) {
            chosenText.textContent = `${input.files.length} file dipilih`;
            Array.from(input.files).forEach(file => {
                const li = document.createElement('li');
                li.className = 'flex items-center gap-1.5 text-brandDark bg-brandLight px-2.5 py-1.5 rounded-lg border border-brandLight-200';
                li.innerHTML = `
                    <svg class="w-3.5 h-3.5 text-navy shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13"/></svg>
                    <span>${file.name} (${(file.size/1024).toFixed(1)} KB)</span>
                `;
                fileList.appendChild(li);
            });
        } else {
            chosenText.textContent = 'No file chosen';
        }
    }

    // Initialize state on page load
    document.addEventListener('DOMContentLoaded', () => {
        const checkedMethod = document.querySelector('input[name="report_method"]:checked')?.value || 'anonymous';
        toggleReportMethod(checkedMethod);
    });
</script>
@endpush
