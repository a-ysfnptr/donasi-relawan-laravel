@extends('layouts.app')
@section('title', $campaign->title)
@section('content')

<!-- Breadcrumb Navigasi -->
<nav class="flex items-center gap-2 text-xs text-[#64748B] mb-6 overflow-x-auto">
    <a href="{{ route('home') }}" class="hover:text-brand-500 transition">Beranda</a>
    <span>/</span>
    <a href="{{ route('campaigns.index') }}" class="hover:text-brand-500 transition">Kampanye</a>
    <span>/</span>
    <span class="capitalize text-[#1E293B] font-medium">{{ $campaign->category }}</span>
    <span>/</span>
    <span class="text-stone-400 truncate max-w-xs">{{ $campaign->title }}</span>
</nav>

<div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
    
    <!-- =========================================================================
         KOLOM UTAMA (Foto Sampul, Judul, Cerita Kampanye, Donatur, Penyaluran)
         ========================================================================= -->
    <div class="lg:col-span-8 space-y-8">
        
        <!-- Foto Sampul Kampanye -->
        <div class="bg-white rounded-3xl shadow-soft border border-stone-200/80 overflow-hidden">
            <div class="relative w-full h-72 sm:h-96 bg-stone-900 overflow-hidden">
                @if($campaign->cover_image)
                    <img src="{{ asset('storage/' . $campaign->cover_image) }}" 
                         alt="{{ $campaign->title }}" 
                         class="w-full h-full object-cover">
                @else
                    <!-- Fallback Visual bila belum ada foto -->
                    <div class="w-full h-full flex flex-col justify-center items-center p-8 bg-gradient-to-br from-stone-900 via-stone-800 to-amber-950 text-white text-center">
                        <div class="w-16 h-16 rounded-2xl bg-brand-500/20 text-amber-300 flex items-center justify-center mb-3">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                            </svg>
                        </div>
                        <span class="text-xs uppercase tracking-widest text-amber-300 font-bold mb-1">{{ $campaign->category }}</span>
                        <h2 class="font-serif text-2xl font-bold max-w-lg">{{ $campaign->title }}</h2>
                    </div>
                @endif

                <!-- Badges -->
                <div class="absolute top-4 left-4 flex flex-wrap gap-2">
                    <span class="px-3.5 py-1 rounded-full text-xs font-bold tracking-wider uppercase bg-white/95 backdrop-blur-md text-brand-600 shadow-sm">
                        {{ $campaign->category }}
                    </span>
                    <span class="px-3 py-1 rounded-full text-xs font-semibold bg-stone-900/80 backdrop-blur-md text-stone-200 flex items-center gap-1.5">
                        <span class="w-2 h-2 rounded-full {{ $campaign->isOpen() ? 'bg-emerald-400' : 'bg-red-400' }}"></span>
                        {{ $campaign->isOpen() ? 'Kampanye Aktif' : 'Status: ' . ucfirst($campaign->status) }}
                    </span>
                </div>
            </div>

            <!-- Konten Cerita Kampanye -->
            <div class="p-6 sm:p-8">
                <div class="flex items-center gap-2 text-xs font-semibold text-[#64748B] uppercase tracking-wider mb-2">
                    <span>Tenggat Penggalangan:</span>
                    <span class="text-[#1E293B] font-bold">{{ $campaign->deadline?->format('d F Y') ?? 'Tidak Terbatas' }}</span>
                </div>

                <h1 class="font-serif text-2xl sm:text-3xl lg:text-4xl font-extrabold text-[#1E293B] leading-tight">
                    {{ $campaign->title }}
                </h1>

                <div class="mt-6 pt-6 border-t border-stone-100">
                    <h3 class="font-serif text-xl font-bold text-[#1E293B] mb-4">Tentang Program Ini</h3>
                    <div class="text-stone-700 leading-relaxed text-base whitespace-pre-line space-y-4">
                        {{ $campaign->description }}
                    </div>
                </div>
            </div>
        </div>

        <!-- Bagian Donatur & Penyaluran Dana -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            
            <!-- Donatur Terbaru (Terverifikasi) -->
            <div class="bg-white rounded-3xl shadow-soft border border-stone-200/80 p-6">
                <div class="flex items-center justify-between pb-4 mb-4 border-b border-stone-100">
                    <div class="flex items-center gap-2.5">
                        <div class="w-8 h-8 rounded-lg bg-orange-50 text-brand-500 flex items-center justify-center">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z" clip-rule="evenodd"/></svg>
                        </div>
                        <h2 class="font-serif font-bold text-base text-[#1E293B]">Donatur Terbaru</h2>
                    </div>
                    <span class="text-xs text-[#059669] bg-emerald-50 border border-emerald-200 px-2.5 py-0.5 rounded-full font-semibold">Terverifikasi</span>
                </div>

                <ul class="divide-y divide-stone-100 text-sm">
                    @forelse($campaign->donations as $d)
                        <li class="py-3 flex justify-between items-center">
                            <div class="flex items-center gap-2.5">
                                <div class="w-7 h-7 rounded-full bg-stone-100 text-stone-600 flex items-center justify-center text-xs font-bold uppercase">
                                    {{ substr($d->displayName(), 0, 1) }}
                                </div>
                                <span class="font-medium text-[#1E293B]">{{ $d->displayName() }}</span>
                            </div>
                            <span class="font-bold text-brand-600">Rp{{ number_format($d->amount, 0, ',', '.') }}</span>
                        </li>
                    @empty
                        <li class="py-6 text-center text-[#64748B] text-xs">
                            Belum ada donasi yang terverifikasi. Jadilah donatur pertama!
                        </li>
                    @endforelse
                </ul>
            </div>

            <!-- Penyaluran Dana -->
            <div class="bg-white rounded-3xl shadow-soft border border-stone-200/80 p-6">
                <div class="flex items-center justify-between pb-4 mb-4 border-b border-stone-100">
                    <div class="flex items-center gap-2.5">
                        <div class="w-8 h-8 rounded-lg bg-orange-50 text-brand-500 flex items-center justify-center">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                        </div>
                        <h2 class="font-serif font-bold text-base text-[#1E293B]">Penyaluran Dana</h2>
                    </div>
                    <span class="text-xs text-brand-700 bg-orange-50 border border-orange-200 px-2.5 py-0.5 rounded-full font-semibold">Transparan</span>
                </div>

                <ul class="divide-y divide-stone-100 text-sm">
                    @forelse($campaign->disbursements as $p)
                        <li class="py-3 flex justify-between items-start gap-3">
                            <div>
                                <p class="font-medium text-[#1E293B] line-clamp-1">{{ $p->recipient }}</p>
                                <span class="text-[11px] text-[#64748B]">{{ $p->disbursed_at->format('d M Y') }}</span>
                            </div>
                            <span class="font-bold text-brand-600 whitespace-nowrap">Rp{{ number_format($p->amount, 0, ',', '.') }}</span>
                        </li>
                    @empty
                        <li class="py-6 text-center text-[#64748B] text-xs">
                            Belum ada data penyaluran dana untuk kampanye ini.
                        </li>
                    @endforelse
                </ul>
            </div>

        </div>

    </div>

    <!-- =========================================================================
         SIDEBAR STICKY (Donasi Sekarang, Target, Progres, Aksi Relawan)
         ========================================================================= -->
    <div class="lg:col-span-4 sticky top-24 space-y-6">
        
        <div class="bg-white rounded-3xl shadow-soft-xl border border-stone-200/80 p-6 sm:p-7">
            
            <div class="mb-5">
                <span class="text-[11px] font-bold tracking-widest uppercase text-[#64748B] block mb-1">Total Terkumpul</span>
                <div class="flex items-baseline gap-2">
                    <span class="font-serif font-extrabold text-3xl sm:text-4xl text-brand-600">
                        Rp{{ number_format($campaign->verifiedTotal(), 0, ',', '.') }}
                    </span>
                </div>
                <div class="text-xs text-[#64748B] mt-1">
                    dari target <span class="font-semibold text-[#1E293B]">Rp{{ number_format($campaign->target_amount, 0, ',', '.') }}</span>
                </div>
            </div>

            <!-- Progress Bar Emerald #059669 (Khusus Status Sukses & Progress) -->
            <div class="w-full bg-stone-100 rounded-full h-3 overflow-hidden border border-stone-200/50 mb-2">
                <div class="bg-[#059669] h-full rounded-full transition-all duration-500" 
                     style="width: {{ $campaign->progressPercent() }}%"></div>
            </div>

            <div class="flex justify-between items-center text-xs font-semibold text-[#64748B] mb-6">
                <span>{{ $campaign->progressPercent() }}% Tercapai</span>
                <span>{{ $campaign->deadline ? $campaign->deadline->diffForHumans() : 'Berjalan' }}</span>
            </div>

            <!-- Rincian Alokasi Dana -->
            <div class="bg-[#FFFBF5] rounded-2xl p-4 border border-stone-200/80 mb-6 space-y-2 text-xs">
                <div class="flex justify-between">
                    <span class="text-[#64748B]">Tersalurkan:</span>
                    <span class="font-bold text-[#1E293B]">Rp{{ number_format($campaign->disbursedTotal(), 0, ',', '.') }}</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-[#64748B]">Sisa Dana:</span>
                    <span class="font-bold text-[#059669]">Rp{{ number_format($campaign->remainingFunds(), 0, ',', '.') }}</span>
                </div>
            </div>

            <!-- Tombol Aksi Utama -->
            <div class="space-y-3">
                @if($campaign->isOpen())
                    <!-- Tombol Donasi Sekarang Oranye (#F97316, hover #EA580C) -->
                    <a href="{{ route('donations.create', $campaign) }}" 
                       class="w-full flex items-center justify-center gap-2 bg-brand-500 hover:bg-brand-600 text-white font-bold text-base py-4 px-6 rounded-full shadow-lg shadow-brand-500/30 hover:shadow-orange-glow hover:-translate-y-0.5 active:translate-y-0 transition-all text-center">
                        <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z" clip-rule="evenodd"/></svg>
                        <span>Donasi Sekarang</span>
                    </a>

                    <!-- Tombol Daftar Relawan Hitam Kontras #111827 -->
                    <a href="{{ route('volunteers.create', $campaign) }}" 
                       class="w-full flex items-center justify-center gap-2 bg-[#111827] hover:bg-stone-800 text-white font-semibold text-sm py-3.5 px-6 rounded-full transition shadow-sm text-center">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
                        <span>Daftar Sebagai Relawan</span>
                    </a>
                @else
                    <div class="w-full text-center bg-stone-100 text-[#64748B] font-semibold text-sm py-3.5 px-4 rounded-xl border border-stone-200">
                        Kampanye sudah ditutup / selesai
                    </div>
                @endif

                <!-- Link Transparansi Dana -->
                <div class="pt-3 text-center">
                    <a href="{{ route('campaigns.transparency', $campaign) }}" 
                       class="inline-flex items-center gap-1.5 text-xs text-brand-600 hover:text-brand-700 font-bold underline transition">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                        <span>Lihat Transparansi Dana Lengkap</span>
                    </a>
                </div>
            </div>

        </div>

        <!-- Box Edukasi Donasi Aman -->
        <div class="bg-[#FFFBF5] rounded-2xl p-5 border border-stone-200/80 text-xs text-[#64748B] space-y-2.5">
            <div class="flex items-center gap-2 text-[#1E293B] font-bold">
                <svg class="w-4 h-4 text-brand-500" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M2.166 4.999A11.954 11.954 0 0010 1.944 11.954 11.954 0 0017.834 5c.11.65.166 1.32.166 2.001 0 5.225-3.34 9.67-8 11.317C5.34 16.67 2 12.225 2 7c0-.682.057-1.35.166-2.001zm11.541 3.708a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                <span>Donasi Aman &amp; Terverifikasi</span>
            </div>
            <p class="leading-relaxed">
                Platform ini menerapkan transfer manual ke rekening resmi. Verifikasi dilakukan langsung oleh admin tanpa biaya administrasi tersembunyi.
            </p>
        </div>

    </div>

</div>

@endsection
