@extends('layouts.app')

@section('title', 'Kenali, Cegah, dan Hadapi Perundungan - Edukasi PKBM Pintar Berbakat')

@section('content')
<div class="py-10 lg:py-16 space-y-16">
    
    <!-- Hero Section -->
    <section class="max-w-4xl mx-auto px-4 sm:px-6 text-center">
        <h1 class="text-3xl sm:text-5xl font-extrabold text-navy tracking-tight leading-tight">
            Kenali, Cegah, dan Hadapi Perundungan
        </h1>
        <p class="mt-4 text-base sm:text-lg text-brandDark leading-relaxed max-w-2xl mx-auto">
            Perundungan (bullying) adalah tindakan menyakiti seseorang secara berulang, yang dilakukan sengaja oleh pihak yang merasa lebih berkuasa. Semakin banyak yang paham, semakin sulit perundungan bertahan.
        </p>
    </section>

    <!-- Jenis-jenis Perundungan -->
    <section class="max-w-6xl mx-auto px-4 sm:px-6">
        <div class="text-center mb-10">
            <h2 class="text-2xl sm:text-3xl font-extrabold text-navy">Jenis-jenis Perundungan</h2>
            <p class="text-brandGray text-sm mt-1">Pahami 4 bentuk perundungan yang sering terjadi di lingkungan sekitar</p>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            <!-- Fisik -->
            <div class="card-glass p-6 border border-brandLight-200 hover:border-navy transition-all duration-300 hover:shadow-lg group">
                <div class="w-12 h-12 rounded-xl bg-brandRed/10 text-brandRed flex items-center justify-center font-bold mb-4 group-hover:scale-110 transition-transform">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
                </div>
                <h3 class="text-lg font-bold text-navy mb-2">Fisik</h3>
                <p class="text-sm text-brandDark leading-relaxed">
                    Memukul, mendorong, menendang, merusak atau mengambil barang milik orang lain.
                </p>
            </div>

            <!-- Verbal -->
            <div class="card-glass p-6 border border-brandLight-200 hover:border-navy transition-all duration-300 hover:shadow-lg group">
                <div class="w-12 h-12 rounded-xl bg-brandOrange/10 text-brandOrange-700 flex items-center justify-center font-bold mb-4 group-hover:scale-110 transition-transform">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/></svg>
                </div>
                <h3 class="text-lg font-bold text-navy mb-2">Verbal</h3>
                <p class="text-sm text-brandDark leading-relaxed">
                    Mengejek, menghina, memberi julukan buruk, mengancam, atau merendahkan di depan umum.
                </p>
            </div>

            <!-- Sosial -->
            <div class="card-glass p-6 border border-brandLight-200 hover:border-navy transition-all duration-300 hover:shadow-lg group">
                <div class="w-12 h-12 rounded-xl bg-navy/10 text-navy flex items-center justify-center font-bold mb-4 group-hover:scale-110 transition-transform">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                </div>
                <h3 class="text-lg font-bold text-navy mb-2">Sosial</h3>
                <p class="text-sm text-brandDark leading-relaxed">
                    Sengaja mengucilkan, menyebar gosip, atau menghasut orang lain untuk menjauhi seseorang.
                </p>
            </div>

            <!-- Online (Cyberbullying) -->
            <div class="card-glass p-6 border border-brandLight-200 hover:border-navy transition-all duration-300 hover:shadow-lg group">
                <div class="w-12 h-12 rounded-xl bg-navy/10 text-navy flex items-center justify-center font-bold mb-4 group-hover:scale-110 transition-transform">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                </div>
                <h3 class="text-lg font-bold text-navy mb-2">Online (Cyberbullying)</h3>
                <p class="text-sm text-brandDark leading-relaxed">
                    Menyebar pesan/foto memalukan, meneror lewat chat, atau membuat akun palsu untuk mempermalukan seseorang.
                </p>
            </div>
        </div>
    </section>

    <!-- Tanda-tanda Mengalami Perundungan -->
    <section class="max-w-5xl mx-auto px-4 sm:px-6">
        <div class="card-glass p-8 sm:p-10 border border-brandLight-200">
            <div class="max-w-2xl mb-8">
                <span class="text-xs font-bold uppercase tracking-wider text-navy">Deteksi Dini</span>
                <h2 class="text-2xl sm:text-3xl font-extrabold text-navy mt-1">Tanda-tanda Seseorang Mengalami Perundungan</h2>
                <p class="text-brandGray text-sm mt-2">
                    Buat tutor, orang tua, atau teman — ini beberapa tanda yang patut diperhatikan pada diri sendiri maupun orang sekitar.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="flex items-start gap-3.5 p-4 rounded-xl bg-white border border-brandLight-200">
                    <div class="w-6 h-6 rounded-full bg-brandRed/10 text-brandRed flex items-center justify-center shrink-0 mt-0.5">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"/></svg>
                    </div>
                    <span class="text-sm text-brandDark font-medium">Malas atau takut berangkat sekolah tanpa alasan yang jelas</span>
                </div>

                <div class="flex items-start gap-3.5 p-4 rounded-xl bg-white border border-brandLight-200">
                    <div class="w-6 h-6 rounded-full bg-brandRed/10 text-brandRed flex items-center justify-center shrink-0 mt-0.5">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"/></svg>
                    </div>
                    <span class="text-sm text-brandDark font-medium">Barang sering "hilang" atau rusak, atau tiba-tiba minta uang lebih</span>
                </div>

                <div class="flex items-start gap-3.5 p-4 rounded-xl bg-white border border-brandLight-200">
                    <div class="w-6 h-6 rounded-full bg-brandRed/10 text-brandRed flex items-center justify-center shrink-0 mt-0.5">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"/></svg>
                    </div>
                    <span class="text-sm text-brandDark font-medium">Muncul luka yang tidak bisa dijelaskan, atau baju/barang yang rusak</span>
                </div>

                <div class="flex items-start gap-3.5 p-4 rounded-xl bg-white border border-brandLight-200">
                    <div class="w-6 h-6 rounded-full bg-brandRed/10 text-brandRed flex items-center justify-center shrink-0 mt-0.5">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"/></svg>
                    </div>
                    <span class="text-sm text-brandDark font-medium">Menyendiri, murung, atau berubah drastis secara tiba-tiba</span>
                </div>

                <div class="flex items-start gap-3.5 p-4 rounded-xl bg-white border border-brandLight-200">
                    <div class="w-6 h-6 rounded-full bg-brandRed/10 text-brandRed flex items-center justify-center shrink-0 mt-0.5">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"/></svg>
                    </div>
                    <span class="text-sm text-brandDark font-medium">Sulit tidur, sering mimpi buruk, atau kehilangan nafsu makan</span>
                </div>

                <div class="flex items-start gap-3.5 p-4 rounded-xl bg-white border border-brandLight-200">
                    <div class="w-6 h-6 rounded-full bg-brandRed/10 text-brandRed flex items-center justify-center shrink-0 mt-0.5">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"/></svg>
                    </div>
                    <span class="text-sm text-brandDark font-medium">Menghindari HP/media sosial padahal biasanya aktif</span>
                </div>
            </div>
        </div>
    </section>

    <!-- Kalau Kamu Sedang Mengalaminya -->
    <section class="max-w-5xl mx-auto px-4 sm:px-6">
        <div class="text-center mb-10">
            <span class="text-xs font-bold uppercase tracking-wider text-navy">Panduan Korban</span>
            <h2 class="text-2xl sm:text-3xl font-extrabold text-navy mt-1">Kalau Kamu Sedang Mengalaminya</h2>
            <p class="text-brandGray text-sm mt-1">Enam langkah yang bisa kamu lakukan sekarang.</p>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            <!-- 01 -->
            <div class="card-glass p-6 border border-brandLight-200 relative flex flex-col justify-between">
                <div>
                    <span class="font-mono text-3xl font-extrabold text-navy/30 block mb-2">01</span>
                    <h3 class="text-base font-bold text-navy mb-2">Kamu tidak salah</h3>
                    <p class="text-xs sm:text-sm text-brandDark leading-relaxed">
                        Perundungan bukan salahmu, apa pun alasan yang dipakai pelaku. Tidak ada yang pantas diperlakukan buruk.
                    </p>
                </div>
            </div>

            <!-- 02 -->
            <div class="card-glass p-6 border border-brandLight-200 relative flex flex-col justify-between">
                <div>
                    <span class="font-mono text-3xl font-extrabold text-navy/30 block mb-2">02</span>
                    <h3 class="text-base font-bold text-navy mb-2">Cerita ke orang yang kamu percaya</h3>
                    <p class="text-xs sm:text-sm text-brandDark leading-relaxed">
                        Tutor, orang tua, teman dekat, atau siapa pun yang bisa bantu. Diam justru membuat pelaku merasa aman melanjutkan.
                    </p>
                </div>
            </div>

            <!-- 03 -->
            <div class="card-glass p-6 border border-brandLight-200 relative flex flex-col justify-between">
                <div>
                    <span class="font-mono text-3xl font-extrabold text-navy/30 block mb-2">03</span>
                    <h3 class="text-base font-bold text-navy mb-2">Simpan buktinya</h3>
                    <p class="text-xs sm:text-sm text-brandDark leading-relaxed">
                        Screenshot chat, foto, atau catat kapan & di mana kejadian terjadi — ini akan sangat membantu saat ditindaklanjuti.
                    </p>
                </div>
            </div>

            <!-- 04 -->
            <div class="card-glass p-6 border border-brandLight-200 relative flex flex-col justify-between">
                <div>
                    <span class="font-mono text-3xl font-extrabold text-navy/30 block mb-2">04</span>
                    <h3 class="text-base font-bold text-navy mb-2">Jangan balas dengan kekerasan</h3>
                    <p class="text-xs sm:text-sm text-brandDark leading-relaxed">
                        Membalas bisa membuatmu ikut disalahkan dan situasinya makin runyam. Fokus cari bantuan, bukan balas dendam.
                    </p>
                </div>
            </div>

            <!-- 05 -->
            <div class="card-glass p-6 border border-brandLight-200 relative flex flex-col justify-between">
                <div>
                    <span class="font-mono text-3xl font-extrabold text-navy/30 block mb-2">05</span>
                    <h3 class="text-base font-bold text-navy mb-2">Jaga jarak dari pelaku kalau bisa</h3>
                    <p class="text-xs sm:text-sm text-brandDark leading-relaxed">
                        Hindari berada sendirian dengan pelaku. Dekati teman atau orang dewasa saat berada di sekitar mereka.
                    </p>
                </div>
            </div>

            <!-- 06 -->
            <div class="card-glass p-6 border-2 border-navy/40 bg-navy/5 relative flex flex-col justify-between shadow-md">
                <div>
                    <span class="font-mono text-3xl font-extrabold text-navy block mb-2">06</span>
                    <h3 class="text-base font-bold text-navy mb-2">Laporkan lewat Lapor Aman</h3>
                    <p class="text-xs sm:text-sm text-brandDark leading-relaxed">
                        Kamu bisa lapor tanpa menyebut nama lewat halaman ini — tim PKBM Pintar Berbakat akan menindaklanjuti.
                    </p>
                </div>
                <div class="mt-4 pt-3 border-t border-navy/20">
                    <a href="{{ route('reports.create') }}" class="text-xs font-bold text-navy hover:underline flex items-center gap-1">
                        Buka Form Lapor &rarr;
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Kalau Kamu Melihatnya Terjadi ke Orang Lain -->
    <section class="max-w-5xl mx-auto px-4 sm:px-6">
        <div class="card-glass p-8 sm:p-10 border border-brandLight-200">
            <div class="max-w-2xl mb-8">
                <span class="text-xs font-bold uppercase tracking-wider text-navy">Panduan Saksi (Bystander)</span>
                <h2 class="text-2xl sm:text-3xl font-extrabold text-navy mt-1">Kalau Kamu Melihatnya Terjadi ke Orang Lain</h2>
                <p class="text-brandGray text-sm mt-2">
                    Jadi saksi juga punya peran besar — begini cara membantu tanpa membahayakan diri sendiri.
                </p>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                <!-- 1 -->
                <div class="p-5 rounded-2xl bg-white border border-brandLight-200 shadow-sm">
                    <h3 class="font-bold text-base text-navy mb-2 flex items-center gap-2">
                        <span class="w-6 h-6 rounded-full bg-navy/10 text-navy text-xs flex items-center justify-center font-bold">1</span>
                        Jangan cuma diam menonton
                    </h3>
                    <p class="text-xs sm:text-sm text-brandDark leading-relaxed">
                        Diam sering dianggap dukungan oleh pelaku. Kalau berani, tegur langsung atau alihkan perhatian.
                    </p>
                </div>

                <!-- 2 -->
                <div class="p-5 rounded-2xl bg-white border border-brandLight-200 shadow-sm">
                    <h3 class="font-bold text-base text-navy mb-2 flex items-center gap-2">
                        <span class="w-6 h-6 rounded-full bg-navy/10 text-navy text-xs flex items-center justify-center font-bold">2</span>
                        Jangan ikut menyebarkan
                    </h3>
                    <p class="text-xs sm:text-sm text-brandDark leading-relaxed">
                        Turut membagikan foto/video "receh" hasil perundungan sama saja ikut menyakiti korban lagi.
                    </p>
                </div>

                <!-- 3 -->
                <div class="p-5 rounded-2xl bg-white border border-brandLight-200 shadow-sm">
                    <h3 class="font-bold text-base text-navy mb-2 flex items-center gap-2">
                        <span class="w-6 h-6 rounded-full bg-navy/10 text-navy text-xs flex items-center justify-center font-bold">3</span>
                        Temani dan dukung korban
                    </h3>
                    <p class="text-xs sm:text-sm text-brandDark leading-relaxed">
                        Ajak bicara, dengarkan, dan tunjukkan kamu ada di pihaknya. Rasa didukung sangat berarti buat korban.
                    </p>
                </div>

                <!-- 4 -->
                <div class="p-5 rounded-2xl bg-white border border-brandLight-200 shadow-sm">
                    <h3 class="font-bold text-base text-navy mb-2 flex items-center gap-2">
                        <span class="w-6 h-6 rounded-full bg-navy/10 text-navy text-xs flex items-center justify-center font-bold">4</span>
                        Laporkan ke orang dewasa
                    </h3>
                    <p class="text-xs sm:text-sm text-brandDark leading-relaxed">
                        Kamu boleh melapor meski bukan korban langsung — laporan pihak ketiga tetap bisa diproses lewat Lapor Aman.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Call to Action: Kamu Tidak Sendirian -->
    <section class="max-w-4xl mx-auto px-4 sm:px-6">
        <div class="p-8 sm:p-12 rounded-3xl bg-gradient-to-br from-[#2E2E2E] via-[#232323] to-[#0A315F] text-white text-center shadow-2xl relative overflow-hidden">
            <div class="absolute -right-10 -top-10 w-48 h-48 bg-navy/30 rounded-full blur-3xl"></div>
            <div class="absolute -left-10 -bottom-10 w-48 h-48 bg-brandRed/20 rounded-full blur-3xl"></div>

            <h2 class="text-3xl sm:text-4xl font-extrabold tracking-tight">
                Kamu Tidak Sendirian
            </h2>

            <p class="mt-3 text-slate-200 text-sm sm:text-base max-w-xl mx-auto leading-relaxed">
                Cerita adalah langkah pertama. Laporkan secara anonim atau pantau laporan yang sudah kamu kirim.
            </p>

            <div class="mt-8 flex flex-wrap items-center justify-center gap-4">
                <a href="{{ route('reports.create') }}" class="btn-primary py-3.5 px-6 text-sm">
                    Lapor Sekarang
                </a>
                <a href="{{ route('reports.track') }}" class="btn-secondary py-3.5 px-6 text-sm bg-white/10 border-white/20 text-white hover:bg-white/20">
                    Lacak Laporan Saya
                </a>
            </div>

            <div class="mt-8 pt-6 border-t border-white/15 text-xs text-slate-300">
                Dalam bahaya sekarang? Hubungi <a href="https://wa.me/6282219082518" target="_blank" rel="noopener noreferrer" class="text-[#FBA239] hover:text-amber-200 font-bold underline underline-offset-4">Tim PKBM Pintar Berbakat</a> langsung.
            </div>
        </div>
    </section>

</div>
@endsection
