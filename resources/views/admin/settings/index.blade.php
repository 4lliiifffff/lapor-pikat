@extends('layouts.admin')

@section('title', 'Pengaturan CMS & Branding Sistem - Panel Super Admin')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

    <!-- Header Page -->
    <div class="mb-8 flex flex-col md:flex-row md:items-center md:justify-between gap-4">
        <div>
            <div class="flex items-center gap-2">
                <span class="px-2.5 py-1 rounded-full text-xs font-bold bg-[#FBA239]/15 text-[#FBA239] border border-[#FBA239]/30 uppercase tracking-wider">Fitur Eksklusif Super Admin</span>
            </div>
            <h1 class="text-2xl sm:text-3xl font-extrabold text-navy tracking-tight mt-2">
                Pengaturan CMS & Branding Sistem
            </h1>
            <p class="text-brandGray text-xs sm:text-sm mt-1">
                Kelola identitas sistem, logo, favicon, informasi kontak, dan pengumuman halaman utama secara terpusat.
            </p>
        </div>

        <a href="{{ route('admin.users.index') }}" class="btn-secondary text-xs px-4 py-2.5 self-start md:self-auto">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
            <span>Kembali ke Kelola Akun</span>
        </a>
    </div>

    <!-- CMS Settings Form -->
    <form action="{{ route('admin.settings.update') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            
            <!-- Left & Center Column: Main Content (Branding & Contact) -->
            <div class="lg:col-span-2 space-y-8">
                
                <!-- Section 1: Identitas & Branding -->
                <div class="p-6 sm:p-8 rounded-2xl bg-white border border-brandLight-200 shadow-sm space-y-6">
                    <div class="flex items-center gap-3 pb-4 border-b border-brandLight-200">
                        <div class="w-10 h-10 rounded-xl bg-navy/10 flex items-center justify-center text-navy shrink-0">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                        </div>
                        <div>
                            <h2 class="text-base font-bold text-navy">1. Identitas & Branding Aplikasi</h2>
                            <p class="text-xs text-brandGray">Pengaturan nama sistem, instansi, dan tagline resmi.</p>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                        <!-- App Name -->
                        <div>
                            <label for="app_name" class="form-label">Nama Aplikasi <span class="text-brandRed">*</span></label>
                            <input type="text" id="app_name" name="app_name" value="{{ old('app_name', $settings['app_name'] ?? 'LaporAman') }}" class="form-input-control @error('app_name') border-brandRed @enderror" required placeholder="Contoh: LaporAman">
                            @error('app_name')
                                <p class="text-xs text-brandRed mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Institution Name -->
                        <div>
                            <label for="institution_name" class="form-label">Nama Sekolah / Instansi <span class="text-brandRed">*</span></label>
                            <input type="text" id="institution_name" name="institution_name" value="{{ old('institution_name', $settings['institution_name'] ?? 'PKBM Pintar Berbakat') }}" class="form-input-control @error('institution_name') border-brandRed @enderror" required placeholder="Contoh: PKBM Pintar Berbakat">
                            @error('institution_name')
                                <p class="text-xs text-brandRed mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- App Tagline -->
                        <div class="sm:col-span-2">
                            <label for="app_tagline" class="form-label">Subjudul / Tagline Aplikasi</label>
                            <input type="text" id="app_tagline" name="app_tagline" value="{{ old('app_tagline', $settings['app_tagline'] ?? 'Pusat Pelaporan & Perlindungan Anti-Perundungan') }}" class="form-input-control @error('app_tagline') border-brandRed @enderror" placeholder="Deskripsi singkat tagline aplikasi">
                            @error('app_tagline')
                                <p class="text-xs text-brandRed mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Section 2: Upload Logo & Favicon -->
                <div class="p-6 sm:p-8 rounded-2xl bg-white border border-brandLight-200 shadow-sm space-y-6">
                    <div class="flex items-center gap-3 pb-4 border-b border-brandLight-200">
                        <div class="w-10 h-10 rounded-xl bg-brandOrange/10 flex items-center justify-center text-[#FBA239] shrink-0">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                        </div>
                        <div>
                            <h2 class="text-base font-bold text-navy">2. Logo & Favicon Sistem</h2>
                            <p class="text-xs text-brandGray">Unggah file gambar logo utama dan favicon tab browser.</p>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                        <!-- Upload Logo Utama -->
                        <div class="p-4 rounded-xl bg-brandLight-50 border border-brandLight-200 space-y-3">
                            <label for="app_logo" class="form-label">Upload Logo Utama</label>

                            @if(!empty($settings['app_logo']) && \Illuminate\Support\Facades\Storage::disk('public')->exists($settings['app_logo']))
                                <div class="mb-3 p-3 rounded-lg bg-white border border-brandLight-200 flex items-center justify-between">
                                    <img src="{{ asset('storage/' . $settings['app_logo']) }}" alt="Logo Utama" class="h-10 object-contain">
                                    <label class="inline-flex items-center gap-1.5 text-xs text-brandRed font-semibold cursor-pointer">
                                        <input type="checkbox" name="remove_logo" value="1" class="rounded text-brandRed focus:ring-brandRed">
                                        <span>Hapus Logo</span>
                                    </label>
                                </div>
                            @endif

                            <input type="file" id="app_logo" name="app_logo" accept="image/png,image/jpeg,image/svg+xml,image/webp" class="block w-full text-xs text-brandDark file:mr-3 file:py-2 file:px-3 file:rounded-lg file:border-0 file:text-xs file:font-semibold file:bg-navy file:text-white hover:file:bg-[#08284e]">
                            <p class="form-hint">Format: PNG, JPG, SVG, WebP (Maks: 2MB). Jika kosong, menggunakan icon default shield.</p>
                            @error('app_logo')
                                <p class="text-xs text-brandRed mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Upload Favicon -->
                        <div class="p-4 rounded-xl bg-brandLight-50 border border-brandLight-200 space-y-3">
                            <label for="app_favicon" class="form-label">Upload Favicon (.ico / .png)</label>

                            @if(!empty($settings['app_favicon']) && \Illuminate\Support\Facades\Storage::disk('public')->exists($settings['app_favicon']))
                                <div class="mb-3 p-3 rounded-lg bg-white border border-brandLight-200 flex items-center justify-between">
                                    <img src="{{ asset('storage/' . $settings['app_favicon']) }}" alt="Favicon" class="w-8 h-8 object-contain">
                                    <label class="inline-flex items-center gap-1.5 text-xs text-brandRed font-semibold cursor-pointer">
                                        <input type="checkbox" name="remove_favicon" value="1" class="rounded text-brandRed focus:ring-brandRed">
                                        <span>Hapus Favicon</span>
                                    </label>
                                </div>
                            @endif

                            <input type="file" id="app_favicon" name="app_favicon" accept="image/x-icon,image/png,image/svg+xml" class="block w-full text-xs text-brandDark file:mr-3 file:py-2 file:px-3 file:rounded-lg file:border-0 file:text-xs file:font-semibold file:bg-navy file:text-white hover:file:bg-[#08284e]">
                            <p class="form-hint">Format: ICO, PNG, SVG (Maks: 1MB). Favicon muncul di tab browser.</p>
                            @error('app_favicon')
                                <p class="text-xs text-brandRed mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Section 3: Informasi Kontak & Layanan Darurat -->
                <div class="p-6 sm:p-8 rounded-2xl bg-white border border-brandLight-200 shadow-sm space-y-6">
                    <div class="flex items-center gap-3 pb-4 border-b border-brandLight-200">
                        <div class="w-10 h-10 rounded-xl bg-emerald-100 flex items-center justify-center text-emerald-700 shrink-0">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h32a2 2 0 012 2v10a2 2 0 01-2 2H5a2 2 0 01-2-2V5zm6 4.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0zm6 0a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0zm6 0a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0z"/></svg>
                        </div>
                        <div>
                            <h2 class="text-base font-bold text-navy">3. Informasi Kontak & Posko Pengaduan</h2>
                            <p class="text-xs text-brandGray">Kontak darurat dan jam operasional yang ditayangkan di footer & halaman edukasi.</p>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                        <!-- Phone / WhatsApp -->
                        <div>
                            <label for="contact_phone" class="form-label">No. Telepon / WhatsApp Darurat</label>
                            <input type="text" id="contact_phone" name="contact_phone" value="{{ old('contact_phone', $settings['contact_phone'] ?? '') }}" class="form-input-control" placeholder="Contoh: 0812-3456-7890">
                        </div>

                        <!-- Email -->
                        <div>
                            <label for="contact_email" class="form-label">Email Layanan Pengaduan</label>
                            <input type="email" id="contact_email" name="contact_email" value="{{ old('contact_email', $settings['contact_email'] ?? '') }}" class="form-input-control" placeholder="Contoh: lapor@pkbmpintar.sch.id">
                        </div>

                        <!-- Operating Hours -->
                        <div>
                            <label for="operating_hours" class="form-label">Jam Operasional Service Desk</label>
                            <input type="text" id="operating_hours" name="operating_hours" value="{{ old('operating_hours', $settings['operating_hours'] ?? '') }}" class="form-input-control" placeholder="Contoh: Senin - Jumat (08:00 - 16:00 WIB)">
                        </div>

                        <!-- Address -->
                        <div>
                            <label for="contact_address" class="form-label">Alamat Fisik Posko</label>
                            <input type="text" id="contact_address" name="contact_address" value="{{ old('contact_address', $settings['contact_address'] ?? '') }}" class="form-input-control" placeholder="Alamat posko pengaduan">
                        </div>
                    </div>
                </div>

            </div>

            <!-- Right Column: Sidebar (Announcement & Action Buttons) -->
            <div class="space-y-8">
                
                <!-- Section 4: Pengumuman Sistem -->
                <div class="p-6 sm:p-8 rounded-2xl bg-white border border-brandLight-200 shadow-sm space-y-6">
                    <div class="flex items-center gap-3 pb-4 border-b border-brandLight-200">
                        <div class="w-10 h-10 rounded-xl bg-brandRed/10 flex items-center justify-center text-brandRed shrink-0">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z"/></svg>
                        </div>
                        <div>
                            <h2 class="text-base font-bold text-navy">Pengumuman Halaman Depan</h2>
                            <p class="text-xs text-brandGray">Banner pengumuman penting untuk pengunjung publik.</p>
                        </div>
                    </div>

                    <!-- Announcement Toggle -->
                    <div class="flex items-center justify-between p-4 rounded-xl bg-brandLight-50 border border-brandLight-200">
                        <div>
                            <label for="announcement_enabled" class="text-xs font-bold text-navy uppercase tracking-wider cursor-pointer">Tampilkan Banner</label>
                            <p class="text-[11px] text-brandGray">Aktifkan untuk memunculkan pengumuman di bagian atas publik.</p>
                        </div>
                        <input type="checkbox" id="announcement_enabled" name="announcement_enabled" value="1" {{ old('announcement_enabled', $settings['announcement_enabled'] ?? '0') == '1' ? 'checked' : '' }} class="w-5 h-5 rounded border-brandLight-300 text-navy focus:ring-navy cursor-pointer">
                    </div>

                    <!-- Announcement Text -->
                    <div>
                        <label for="announcement_text" class="form-label">Isi Teks Pengumuman</label>
                        <textarea id="announcement_text" name="announcement_text" rows="4" class="form-input-control" placeholder="Tulis pengumuman penting di sini...">{{ old('announcement_text', $settings['announcement_text'] ?? '') }}</textarea>
                    </div>
                </div>

                <!-- Section 5: Footer Copyright -->
                <div class="p-6 sm:p-8 rounded-2xl bg-white border border-brandLight-200 shadow-sm space-y-4">
                    <h3 class="text-xs font-bold uppercase tracking-wider text-navy">Teks Hak Cipta (Footer)</h3>
                    <input type="text" id="footer_copyright" name="footer_copyright" value="{{ old('footer_copyright', $settings['footer_copyright'] ?? '© 2026 PKBM Pintar Berbakat. Hak Cipta Dilindungi.') }}" class="form-input-control" placeholder="Teks hak cipta footer">
                </div>

                <!-- Submit Action Box -->
                <div class="p-6 rounded-2xl bg-[#2E2E2E] text-white space-y-4 shadow-md">
                    <h3 class="text-sm font-bold text-[#FBA239] flex items-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4"/></svg>
                        <span>Simpan Perubahan CMS</span>
                    </h3>
                    <p class="text-xs text-slate-300 leading-relaxed">
                        Seluruh perubahan pengaturan branding, logo, favicon, dan kontak akan langsung berlaku secara real-time di seluruh sistem.
                    </p>
                    <button type="submit" class="w-full btn-primary py-3 text-sm font-extrabold shadow-lg">
                        Simpan Semua Pengaturan CMS
                    </button>
                </div>

            </div>

        </div>
    </form>

</div>
@endsection
