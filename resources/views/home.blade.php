@extends('layouts.app')
@section('title', 'Beranda - Ulurkan Tangan, Bantu Sesama')
@section('content')

<!-- =========================================================================
     HERO SECTION (Foto Besar dengan Headline Serif & Tombol Oranye - Charito Style)
     ========================================================================= -->
<section class="relative w-full bg-[#111827] text-white overflow-hidden">
    <!-- Foto Latar Besar -->
    <div class="absolute inset-0 z-0">
        <img src="https://images.unsplash.com/photo-1488521787991-ed7bbaae773c?q=80&w=1800&auto=format&fit=crop" 
             alt="Ulurkan Tangan Kebaikan" 
             class="w-full h-full object-cover object-center filter brightness-[0.75]">
        <!-- Gradasi Overlay untuk Memaksimalkan Kontras Teks -->
        <div class="absolute inset-0 bg-gradient-to-t md:bg-gradient-to-r from-[#111827] via-[#111827]/80 to-transparent"></div>
        <div class="absolute inset-0 bg-[#111827]/30"></div>
    </div>

    <!-- Konten Hero -->
    <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-20 sm:pt-28 pb-32 sm:pb-40">
        <div class="max-w-2xl lg:max-w-3xl">
            <!-- Badge Inspiratif -->
            <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-white/10 backdrop-blur-md border border-white/20 text-amber-300 text-xs sm:text-sm font-semibold mb-6">
                <span class="w-2 h-2 rounded-full bg-brand-500 animate-ping"></span>
                <span>GERAKAN SOLIDARITAS SOSIAL &amp; RELAWAN</span>
            </div>

            <!-- Headline Serif Besar -->
            <h1 class="font-serif text-3xl sm:text-5xl lg:text-6xl font-extrabold text-white leading-[1.15] tracking-tight">
                Ulurkan Tangan untuk <br class="hidden sm:inline"/>
                <span class="text-transparent bg-clip-text bg-gradient-to-r from-amber-200 via-orange-300 to-brand-500">
                    Mereka yang Membutuhkan.
                </span>
            </h1>

            <!-- Subtitle -->
            <p class="mt-6 text-base sm:text-lg text-stone-200 leading-relaxed max-w-xl">
                Bantu ringankan duka korban bencana, wujudkan impian anak-anak berprestasi, dan hadirkan layanan kesehatan gratis. Donasi Anda tercatat amanah dan terverifikasi hingga rupiah terakhir.
            </p>

            <!-- Aksi CTA -->
            <div class="mt-8 sm:mt-10 flex flex-wrap items-center gap-4">
                <!-- Tombol Donasi Sekarang Oranye -->
                <a href="#daftar-kampanye" 
                   class="inline-flex items-center gap-2.5 bg-brand-500 hover:bg-brand-600 text-white font-bold text-base sm:text-lg px-8 py-4 rounded-full shadow-lg shadow-brand-500/40 hover:shadow-orange-glow hover:-translate-y-0.5 active:translate-y-0 transition-all duration-200">
                    <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z" clip-rule="evenodd"/>
                    </svg>
                    <span>Donasi Sekarang</span>
                </a>

                <!-- Tombol Sekunder Jadi Relawan -->
                <a href="{{ route('campaigns.index') }}" 
                   class="inline-flex items-center gap-2 bg-white/10 hover:bg-white/20 text-white font-semibold text-base px-6 py-4 rounded-full border border-white/20 backdrop-blur-md transition-all">
                    <span>Lihat Kampanye</span>
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                </a>
            </div>

            <!-- Jaminan Kepercayaan -->
            <div class="mt-10 pt-6 border-t border-white/15 flex items-center gap-6 text-xs text-stone-300">
                <div class="flex items-center gap-2">
                    <svg class="w-4 h-4 text-emerald-400" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                    <span>100% Terverifikasi Admin</span>
                </div>
                <div class="flex items-center gap-2">
                    <svg class="w-4 h-4 text-emerald-400" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                    <span>Transparansi Penyaluran Publik</span>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- =========================================================================
     3 KARTU TUMPANG TINDIH DI BAWAH HERO (Inspirasi Charito)
     Kartu 1: Jadi Relawan (Putih)
     Kartu 2: Berdonasi (Hitam #111827)
     Kartu 3: Transparansi Dana (Oranye #F97316)
     ========================================================================= -->
<section class="relative z-20 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 -mt-20 sm:-mt-24 md:-mt-28">
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 lg:gap-8 items-stretch">
        
        <!-- KARTU 1: JADI RELAWAN (PUTIH) -->
        <div class="bg-white text-dark rounded-2xl shadow-soft-xl border border-stone-200/80 p-7 lg:p-8 flex flex-col justify-between hover:shadow-2xl hover:-translate-y-1 transition-all duration-300">
            <div>
                <!-- Ikon Relawan Hitam -->
                <div class="w-14 h-14 rounded-2xl bg-stone-100 text-dark flex items-center justify-center mb-6">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                    </svg>
                </div>
                <h3 class="font-serif font-bold text-2xl text-dark mb-3">Jadi Relawan</h3>
                <p class="text-stone-600 text-sm leading-relaxed mb-6">
                    Bergabung bersama tim relawan di garda depan untuk membantu logistik, distribusi sembako, dan pendampingan di lokasi bencana.
                </p>
            </div>
            <div>
                <a href="{{ route('campaigns.index') }}" 
                   class="w-full inline-flex items-center justify-center gap-2 bg-brand-500 hover:bg-brand-600 text-white font-bold text-sm py-3 px-6 rounded-full shadow-md shadow-brand-500/20 hover:shadow-orange-glow transition-all">
                    <span>Daftar Relawan</span>
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                </a>
            </div>
        </div>

        <!-- KARTU 2: BERDONASI (HITAM #111827 - MENONJOL) -->
        <div class="bg-[#111827] text-white rounded-2xl shadow-2xl p-7 lg:p-8 flex flex-col justify-between border border-stone-800 md:-translate-y-3 hover:shadow-stone-900/50 hover:-translate-y-4 transition-all duration-300">
            <div>
                <!-- Ikon Donasi Putih/Emas -->
                <div class="w-14 h-14 rounded-2xl bg-white/10 text-amber-300 flex items-center justify-center mb-6">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
                <div class="inline-block px-2.5 py-0.5 rounded-full text-[10px] font-bold tracking-widest uppercase bg-brand-500 text-white mb-2">Paling Dibutuhkan</div>
                <h3 class="font-serif font-bold text-2xl text-white mb-3">Berdonasi</h3>
                <p class="text-stone-300 text-sm leading-relaxed mb-6">
                    Salurkan donasi terbaik Anda. Nominal berapapun sangat berarti untuk memenuhi pangan, obat-obatan, dan pendidikan anak negeri.
                </p>
            </div>
            <div>
                <a href="#daftar-kampanye" 
                   class="w-full inline-flex items-center justify-center gap-2 bg-brand-500 hover:bg-brand-600 text-white font-bold text-sm py-3.5 px-6 rounded-full shadow-lg shadow-brand-500/30 hover:shadow-orange-glow transition-all">
                    <span>Donasi Sekarang</span>
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z" clip-rule="evenodd"/></svg>
                </a>
            </div>
        </div>

        <!-- KARTU 3: TRANSPARANSI DANA (ORANYE #F97316) -->
        <div class="bg-brand-500 text-white rounded-2xl shadow-soft-xl p-7 lg:p-8 flex flex-col justify-between hover:shadow-2xl hover:-translate-y-1 transition-all duration-300">
            <div>
                <!-- Ikon Transparansi Putih -->
                <div class="w-14 h-14 rounded-2xl bg-white/20 text-white flex items-center justify-center mb-6">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                    </svg>
                </div>
                <h3 class="font-serif font-bold text-2xl text-white mb-3">Transparansi Dana</h3>
                <p class="text-orange-100 text-sm leading-relaxed mb-6">
                    Setiap rupiah tercatat dengan rapi, diverifikasi oleh admin, dan laporan bukti penyalurannya dapat diakses publik kapan pun.
                </p>
            </div>
            <div>
                <a href="{{ route('campaigns.index') }}" 
                   class="w-full inline-flex items-center justify-center gap-2 bg-white hover:bg-stone-50 text-dark font-bold text-sm py-3 px-6 rounded-full shadow-md transition-all">
                    <span>Cek Transparansi</span>
                    <svg class="w-4 h-4 text-dark" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                </a>
            </div>
        </div>

    </div>
</section>

<!-- =========================================================================
     BAGIAN SAMBUTAN (Welcome Section - Inspirasi Charito & Gainlove)
     ========================================================================= -->
<section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20">
    <div class="text-center max-w-3xl mx-auto">
        <!-- Subtitle Badge -->
        <span class="inline-block px-3.5 py-1 rounded-full text-xs font-bold tracking-widest uppercase bg-orange-100 text-brand-700 mb-3">
            Selamat Datang di Donasi &amp; Relawan Komunitas
        </span>
        <!-- Headline Serif -->
        <h2 class="font-serif text-3xl sm:text-4xl lg:text-5xl font-bold text-dark leading-tight">
            Mewujudkan Perubahan Nyata Melalui Kepedulian Bersama.
        </h2>
        <p class="mt-4 text-base sm:text-lg text-stone-600 leading-relaxed">
            Kami hadir menjembatani niat baik Anda dengan mereka yang paling membutuhkan. Hanya donasi yang telah diverifikasi admin yang disalurkan, menjaga setiap rupiah tetap berkah dan tepat sasaran.
        </p>
    </div>

    <!-- 3 Kotak Statistik (Counter Ringkas & Mewah) -->
    <div class="mt-12 grid grid-cols-1 sm:grid-cols-3 gap-6">
        <div class="bg-white rounded-2xl shadow-soft border border-stone-200/70 p-6 sm:p-8 text-center hover:shadow-soft-lg transition">
            <div class="w-12 h-12 mx-auto rounded-full bg-emerald-50 text-emerald-600 flex items-center justify-center mb-3">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            </div>
            <p class="font-serif font-bold text-2xl sm:text-3xl text-dark">Rp{{ number_format($totalVerified, 0, ',', '.') }}</p>
            <p class="text-xs sm:text-sm font-semibold uppercase tracking-wider text-stone-500 mt-1">Donasi Terverifikasi</p>
        </div>

        <div class="bg-white rounded-2xl shadow-soft border border-stone-200/70 p-6 sm:p-8 text-center hover:shadow-soft-lg transition">
            <div class="w-12 h-12 mx-auto rounded-full bg-orange-50 text-brand-500 flex items-center justify-center mb-3">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
            </div>
            <p class="font-serif font-bold text-2xl sm:text-3xl text-dark">Rp{{ number_format($totalDisbursed, 0, ',', '.') }}</p>
            <p class="text-xs sm:text-sm font-semibold uppercase tracking-wider text-stone-500 mt-1">Dana Tersalurkan</p>
        </div>

        <div class="bg-white rounded-2xl shadow-soft border border-stone-200/70 p-6 sm:p-8 text-center hover:shadow-soft-lg transition">
            <div class="w-12 h-12 mx-auto rounded-full bg-amber-50 text-amber-600 flex items-center justify-center mb-3">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/></svg>
            </div>
            <p class="font-serif font-bold text-2xl sm:text-3xl text-dark">{{ $totalCampaigns }}</p>
            <p class="text-xs sm:text-sm font-semibold uppercase tracking-wider text-stone-500 mt-1">Kampanye Aktif</p>
        </div>
    </div>
</section>

<!-- =========================================================================
     DAFTAR KAMPANYE (Pencarian, Filter, dan Grid 3 Kolom Kartu)
     ========================================================================= -->
<section id="daftar-kampanye" class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pb-20">
    <div class="flex flex-col md:flex-row md:items-end justify-between gap-4 mb-8">
        <div>
            <span class="text-xs font-bold tracking-widest uppercase text-brand-600 block mb-1">Aksi Peduli Kemanusiaan</span>
            <h2 class="font-serif text-3xl font-bold text-dark">Kampanye Mendesak Pilihan</h2>
        </div>
        <p class="text-sm text-stone-600 max-w-md">
            Pilih program bantuan yang ingin Anda dukung hari ini. Penyaluran dana dipantau dan dilaporkan secara berkala.
        </p>
    </div>

    <!-- Form Pencarian & Filter Kategori (Pertahankan Semua Nama Field & Value) -->
    <div class="bg-white rounded-2xl shadow-soft border border-stone-200/80 p-4 sm:p-5 mb-8">
        <form method="GET" action="{{ route('home') }}" class="flex flex-col sm:flex-row items-center gap-3">
            <div class="relative flex-1 w-full">
                <span class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-stone-400">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                </span>
                <input type="text" 
                       name="q" 
                       value="{{ request('q') }}" 
                       placeholder="Cari kampanye (misal: banjir, beasiswa, kesehatan)..." 
                       class="w-full pl-11 pr-4 py-3 bg-[#FAF8F5] border border-stone-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-brand-500/50 focus:border-brand-500 transition">
            </div>

            <div class="w-full sm:w-64">
                <select name="category" 
                        class="w-full py-3 px-4 bg-[#FAF8F5] border border-stone-200 rounded-xl text-sm text-stone-700 focus:outline-none focus:ring-2 focus:ring-brand-500/50 focus:border-brand-500 transition cursor-pointer">
                    <option value="">Semua Kategori</option>
                    @foreach(['bencana','pendidikan','kesehatan','sosial','lingkungan','lainnya'] as $c)
                        <option value="{{ $c }}" @selected(request('category') === $c)>{{ ucfirst($c) }}</option>
                    @endforeach
                </select>
            </div>

            <button type="submit" 
                    class="w-full sm:w-auto inline-flex items-center justify-center gap-2 bg-brand-500 hover:bg-brand-600 text-white font-semibold text-sm px-6 py-3 rounded-xl shadow-sm hover:shadow-orange-glow transition">
                <span>Cari</span>
            </button>
            
            @if(request('q') || request('category'))
                <a href="{{ route('home') }}" class="text-xs text-stone-500 hover:text-red-500 underline py-2 px-1">
                    Reset
                </a>
            @endif
        </form>
    </div>

    <!-- Grid 3 Kolom Kartu Kampanye -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        @forelse($campaigns as $campaign)
            @include('partials.campaign-card', ['campaign' => $campaign])
        @empty
            <div class="col-span-full bg-white rounded-2xl border border-dashed border-stone-300 p-12 text-center">
                <div class="w-16 h-16 rounded-full bg-orange-50 text-brand-500 mx-auto flex items-center justify-center mb-4">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                </div>
                <h3 class="font-serif font-bold text-xl text-dark mb-2">Belum Ada Kampanye Ditemukan</h3>
                <p class="text-sm text-stone-500 max-w-md mx-auto mb-6">
                    Tidak ada kampanye yang cocok dengan filter atau kata kunci pencarian Anda. Coba reset pencarian untuk melihat semua program.
                </p>
                <a href="{{ route('home') }}" class="inline-flex items-center gap-2 bg-brand-500 hover:bg-brand-600 text-white text-sm font-semibold px-5 py-2.5 rounded-full shadow-sm">
                    Lihat Semua Kampanye
                </a>
            </div>
        @endforelse
    </div>

    <!-- Pagination -->
    <div class="mt-12 flex justify-center">
        {{ $campaigns->links() }}
    </div>
</section>

@endsection
