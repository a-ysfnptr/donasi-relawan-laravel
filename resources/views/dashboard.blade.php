@extends('layouts.app')
@section('title', 'Dashboard Saya')
@section('content')

<!-- Wrapper Latar Krem Hangat #FFFBF5 & Kartu Putih -->
<div class="space-y-8">
    
    <!-- Header: Welcome Greeting & Action -->
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div>
            <h1 class="font-bold text-2xl sm:text-3xl lg:text-4xl text-[#1E293B] tracking-tight">
                Welcome Back, {{ auth()->user()->name }}
            </h1>
            <p class="text-sm text-[#64748B] mt-1">
                Pantau riwayat kontribusi kebaikan dan status pendaftaran relawan Anda secara real-time.
            </p>
        </div>
        <div class="flex items-center gap-3">
            <!-- Date Pill Badge -->
            <div class="hidden sm:inline-flex items-center gap-2 px-4 py-2 bg-white rounded-full text-xs font-semibold text-[#64748B] shadow-sm border border-stone-200/80">
                <svg class="w-4 h-4 text-brand-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                <span>{{ now()->format('d M Y') }}</span>
            </div>
            <!-- Action Button Pill: Tambah Donasi (Oranye #F97316, hover #EA580C) -->
            <a href="{{ route('campaigns.index') }}" 
               class="inline-flex items-center gap-2 bg-brand-500 hover:bg-brand-600 text-white text-sm font-semibold px-5 py-2.5 rounded-full shadow-sm hover:shadow-orange-glow transition">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                <span>Berdonasi Lagi</span>
            </a>
        </div>
    </div>

    <!-- Navigasi Pill: Aktif Oranye #F97316 -->
    <div class="flex items-center gap-2 overflow-x-auto pb-1 text-sm">
        <a href="{{ route('dashboard') }}" 
           class="px-5 py-2 rounded-full font-semibold transition bg-brand-500 text-white shadow-sm whitespace-nowrap">
            Dashboard
        </a>
        <a href="{{ route('donations.index') }}" 
           class="px-5 py-2 rounded-full font-medium transition bg-white text-stone-600 hover:text-brand-500 hover:bg-stone-50 shadow-sm border border-stone-200/80 whitespace-nowrap">
            Donasi Saya
        </a>
        <a href="{{ route('volunteers.index') }}" 
           class="px-5 py-2 rounded-full font-medium transition bg-white text-stone-600 hover:text-brand-500 hover:bg-stone-50 shadow-sm border border-stone-200/80 whitespace-nowrap">
            Relawan Saya
        </a>
        <a href="{{ route('campaigns.index') }}" 
           class="px-5 py-2 rounded-full font-medium transition bg-white text-stone-600 hover:text-brand-500 hover:bg-stone-50 shadow-sm border border-stone-200/80 whitespace-nowrap">
            Jelajahi Kampanye
        </a>
        <a href="{{ route('profile.edit') }}" 
           class="px-5 py-2 rounded-full font-medium transition bg-white text-stone-600 hover:text-brand-500 hover:bg-stone-50 shadow-sm border border-stone-200/80 whitespace-nowrap">
            Edit Profil
        </a>
    </div>

    <!-- Kartu Statistik Besar -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        
        <!-- KARTU 1: TOTAL DONASI TERVERIFIKASI (EMERALD KHUSUS STATUS SUKSES/TERVERIFIKASI) -->
        <div class="bg-gradient-to-br from-[#059669] via-[#047857] to-[#064E3B] text-white rounded-3xl p-7 shadow-lg shadow-emerald-950/10 flex flex-col justify-between relative overflow-hidden min-h-[200px]">
            <div class="absolute -right-6 -bottom-6 w-36 h-36 rounded-full bg-white/10 blur-xl pointer-events-none"></div>
            <div class="flex items-center justify-between relative z-10">
                <span class="text-xs font-bold tracking-widest uppercase text-emerald-200">Total Donasi Terverifikasi</span>
                <span class="inline-flex items-center justify-center w-8 h-8 rounded-full bg-white/20 text-white">
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></svg>
                </span>
            </div>
            <div class="my-4 relative z-10">
                <div class="text-3xl sm:text-4xl font-extrabold tracking-tight">
                    Rp{{ number_format($myTotal, 0, ',', '.') }}
                </div>
                <p class="text-xs text-emerald-100 mt-1">Tercatat amanah di sistem &amp; disalurkan transparan</p>
            </div>
            <div class="flex items-center justify-between text-xs text-emerald-200 relative z-10 pt-2 border-t border-white/15">
                <span class="capitalize">{{ auth()->user()->name }}</span>
                <span class="bg-white/20 px-2.5 py-0.5 rounded-full text-[11px] font-semibold text-white">Donatur Terverifikasi</span>
            </div>
        </div>

        <!-- KARTU 2: KAMPANYE DIDUKUNG (KARTU PUTIH ROUNDED-3XL) -->
        <div class="bg-white rounded-3xl p-7 shadow-sm border border-stone-200/80 flex flex-col justify-between">
            <div class="flex items-center justify-between">
                <div>
                    <span class="text-xs font-bold tracking-wider uppercase text-[#64748B] block">Keterlibatan Sosial</span>
                    <h3 class="text-sm font-semibold text-[#1E293B] mt-0.5">Kampanye Didukung</h3>
                </div>
                <div class="w-10 h-10 rounded-2xl bg-orange-50 text-brand-500 flex items-center justify-center">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/></svg>
                </div>
            </div>
            <div class="my-3">
                <div class="text-3xl sm:text-4xl font-extrabold text-[#1E293B]">
                    {{ $myCampaigns }}
                </div>
                <p class="text-xs text-[#64748B] mt-1">Program penggalangan dana berbeda yang Anda bantu</p>
            </div>
            <div class="pt-2 border-t border-stone-100 flex items-center justify-between text-xs">
                <span class="inline-flex items-center gap-1.5 text-brand-600 font-semibold">
                    <span class="w-2 h-2 rounded-full bg-brand-500"></span>
                    Partisipasi Aktif
                </span>
                <a href="{{ route('campaigns.index') }}" class="text-stone-500 hover:text-brand-500 font-medium transition">Jelajahi &rarr;</a>
            </div>
        </div>

        <!-- KARTU 3: PENDAFTARAN RELAWAN (KARTU PUTIH ROUNDED-3XL) -->
        <div class="bg-white rounded-3xl p-7 shadow-sm border border-stone-200/80 flex flex-col justify-between">
            <div class="flex items-center justify-between">
                <div>
                    <span class="text-xs font-bold tracking-wider uppercase text-[#64748B] block">Aksi Lapangan</span>
                    <h3 class="text-sm font-semibold text-[#1E293B] mt-0.5">Pendaftaran Relawan</h3>
                </div>
                <div class="w-10 h-10 rounded-2xl bg-amber-50 text-amber-600 flex items-center justify-center">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                </div>
            </div>
            <div class="my-3">
                <div class="text-3xl sm:text-4xl font-extrabold text-[#1E293B]">
                    {{ $myVolunteers->count() }}
                </div>
                <p class="text-xs text-[#64748B] mt-1">Kegiatan relawan yang Anda daftarkan</p>
            </div>
            <div class="pt-2 border-t border-stone-100 flex items-center justify-between text-xs">
                <span class="text-[#64748B] font-medium">Kesiapan keahlian &amp; jadwal</span>
                <a href="{{ route('volunteers.index') }}" class="text-brand-500 hover:underline font-semibold">Cek Status &rarr;</a>
            </div>
        </div>

    </div>

    <!-- Bagian Konten: Tabel Donasi Terbaru & Relawan -->
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
        
        <!-- TABEL RIWAYAT DONASI TERBARU (KARTU PUTIH ROUNDED-3XL) -->
        <div class="lg:col-span-8 bg-white rounded-3xl p-6 sm:p-7 shadow-sm border border-stone-200/80">
            <div class="flex items-center justify-between mb-6 pb-4 border-b border-stone-100">
                <div>
                    <h2 class="font-bold text-lg text-[#1E293B]">Donasi Terbaru Saya</h2>
                    <p class="text-xs text-[#64748B] mt-0.5">5 transaksi penggalangan dana terakhir yang Anda ikuti</p>
                </div>
                <a href="{{ route('donations.index') }}" class="text-xs font-bold text-brand-500 hover:text-brand-600 flex items-center gap-1 transition">
                    <span>Lihat Semua</span>
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                </a>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead>
                        <tr class="text-left text-xs font-semibold text-[#64748B] uppercase tracking-wider border-b border-stone-100 pb-3">
                            <th class="pb-3 font-semibold">Kampanye</th>
                            <th class="pb-3 font-semibold">Nominal</th>
                            <th class="pb-3 font-semibold">Status</th>
                            <th class="pb-3 font-semibold text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-stone-100">
                        @forelse($myDonations as $d)
                            <tr class="hover:bg-stone-50/80 transition group">
                                <td class="py-4 pr-3">
                                    <div class="flex items-center gap-3">
                                        <div class="w-9 h-9 rounded-xl bg-orange-50 text-brand-500 flex items-center justify-center shrink-0">
                                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z" clip-rule="evenodd"/></svg>
                                        </div>
                                        <div>
                                            <p class="font-semibold text-[#1E293B] text-sm line-clamp-1 group-hover:text-brand-500 transition">
                                                {{ $d->campaign->title }}
                                            </p>
                                            <span class="text-xs text-[#64748B]">{{ $d->created_at->format('d M Y • H:i') }}</span>
                                        </div>
                                    </div>
                                </td>
                                <td class="py-4 px-3 font-bold text-[#1E293B] whitespace-nowrap">
                                    Rp{{ number_format($d->amount, 0, ',', '.') }}
                                </td>
                                <td class="py-4 px-3 whitespace-nowrap">
                                    @if($d->status === 'terverifikasi')
                                        <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-semibold bg-emerald-50 text-[#059669] border border-emerald-200">
                                            <span class="w-1.5 h-1.5 rounded-full bg-[#059669]"></span>
                                            Terverifikasi
                                        </span>
                                    @elseif($d->status === 'menunggu')
                                        <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-semibold bg-amber-50 text-amber-700 border border-amber-200">
                                            <span class="w-1.5 h-1.5 rounded-full bg-amber-500 animate-pulse"></span>
                                            Menunggu Verifikasi
                                        </span>
                                    @else
                                        <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-semibold bg-red-50 text-danger border border-red-200">
                                            <span class="w-1.5 h-1.5 rounded-full bg-danger"></span>
                                            {{ ucfirst($d->status) }}
                                        </span>
                                    @endif
                                </td>
                                <td class="py-4 pl-3 text-right whitespace-nowrap">
                                    <a href="{{ route('donations.show', $d) }}" 
                                       class="inline-flex items-center gap-1 px-3.5 py-1.5 rounded-full text-xs font-semibold text-brand-600 bg-orange-50 hover:bg-brand-500 hover:text-white transition">
                                        <span>Detail</span>
                                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td class="py-10 text-center text-[#64748B]" colspan="4">
                                    <div class="w-12 h-12 rounded-full bg-stone-100 text-stone-400 mx-auto flex items-center justify-center mb-2">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                    </div>
                                    <p class="font-medium text-sm text-[#1E293B]">Belum Ada Riwayat Donasi</p>
                                    <p class="text-xs text-[#64748B] mt-1">Mulai aksi kebaikan pertama Anda sekarang.</p>
                                    <a href="{{ route('campaigns.index') }}" class="inline-block mt-3 px-4 py-1.5 rounded-full text-xs font-semibold bg-brand-500 text-white">Lihat Kampanye</a>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- PENDAFTARAN RELAWAN SAYA (KARTU PUTIH ROUNDED-3XL) -->
        <div class="lg:col-span-4 bg-white rounded-3xl p-6 sm:p-7 shadow-sm border border-stone-200/80 space-y-6">
            <div class="flex items-center justify-between pb-4 border-b border-stone-100">
                <div>
                    <h2 class="font-bold text-lg text-[#1E293B]">Relawan Saya</h2>
                    <p class="text-xs text-[#64748B] mt-0.5">Status partisipasi lapangan</p>
                </div>
                <a href="{{ route('volunteers.index') }}" class="text-xs font-bold text-brand-500 hover:underline">
                    Semua
                </a>
            </div>

            <div class="space-y-3">
                @forelse($myVolunteers as $v)
                    <div class="p-4 rounded-2xl bg-[#FFFBF5] border border-stone-200/80 hover:bg-stone-50 transition">
                        <div class="flex items-start justify-between gap-2">
                            <h4 class="font-semibold text-sm text-[#1E293B] line-clamp-1">{{ $v->campaign->title }}</h4>
                            @if($v->status === 'diterima')
                                <span class="px-2.5 py-0.5 rounded-full text-[11px] font-bold bg-emerald-50 text-[#059669] border border-emerald-200 shrink-0">Diterima</span>
                            @elseif($v->status === 'menunggu')
                                <span class="px-2.5 py-0.5 rounded-full text-[11px] font-bold bg-amber-50 text-amber-800 border border-amber-200 shrink-0">Menunggu</span>
                            @else
                                <span class="px-2.5 py-0.5 rounded-full text-[11px] font-semibold bg-stone-100 text-stone-700 shrink-0 capitalize">{{ $v->status }}</span>
                            @endif
                        </div>
                        <div class="flex items-center gap-3 mt-2 text-xs text-[#64748B]">
                            <span class="flex items-center gap-1">
                                <svg class="w-3.5 h-3.5 text-brand-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                                {{ $v->skill }}
                            </span>
                            <span>•</span>
                            <span>{{ $v->availability }}</span>
                        </div>
                    </div>
                @empty
                    <div class="py-8 text-center text-[#64748B]">
                        <p class="text-sm font-medium text-[#1E293B]">Belum Mendaftar Relawan</p>
                        <p class="text-xs text-[#64748B] mt-1">Daftarkan keahlian Anda untuk membantu sesama.</p>
                        <a href="{{ route('campaigns.index') }}" class="inline-block mt-3 px-4 py-1.5 rounded-full text-xs font-semibold bg-brand-500 text-white">Cari Kampanye</a>
                    </div>
                @endforelse
            </div>

            <!-- Profil & Akun Shortcut -->
            <div class="pt-4 border-t border-stone-100">
                <a href="{{ route('profile.edit') }}" 
                   class="w-full flex items-center justify-between p-3 rounded-2xl bg-white hover:bg-stone-50 border border-stone-200 text-xs font-semibold text-stone-700 transition">
                    <span class="flex items-center gap-2">
                        <svg class="w-4 h-4 text-stone-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                        Edit Profil &amp; Ganti Kata Sandi
                    </span>
                    <svg class="w-4 h-4 text-stone-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                </a>
            </div>

        </div>

    </div>
</div>

@endsection
