@extends('layouts.app')
@section('title', 'Riwayat Donasi Saya')
@section('content')

<!-- Wrapper Latar Krem Hangat #FFFBF5 & Kartu Putih -->
<div class="space-y-8">
    
    <!-- Header -->
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <h1 class="font-bold text-2xl sm:text-3xl lg:text-4xl text-[#1E293B] tracking-tight">
                Riwayat Donasi Saya
            </h1>
            <p class="text-sm text-[#64748B] mt-1">
                Daftar lengkap seluruh transaksi donasi, bukti transfer, dan status verifikasi admin.
            </p>
        </div>
        
        <!-- Tombol Oranye #F97316 -->
        <a href="{{ route('campaigns.index') }}" 
           class="inline-flex items-center gap-2 bg-brand-500 hover:bg-brand-600 text-white text-sm font-semibold px-5 py-2.5 rounded-full shadow-sm hover:shadow-orange-glow transition self-start sm:self-auto">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
            <span>Donasi Sekarang</span>
        </a>
    </div>

    <!-- Navigasi Pill: Aktif Oranye #F97316 -->
    <div class="flex items-center gap-2 overflow-x-auto pb-1 text-xs sm:text-sm">
        <a href="{{ route('dashboard') }}" 
           class="px-5 py-2 rounded-full font-medium transition bg-white text-stone-600 hover:text-brand-500 hover:bg-stone-50 shadow-sm border border-stone-200/80 whitespace-nowrap">
            Dashboard
        </a>
        <a href="{{ route('donations.index') }}" 
           class="px-5 py-2 rounded-full font-semibold transition bg-brand-500 text-white shadow-sm whitespace-nowrap">
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
    </div>

    <!-- Kartu Tabel Riwayat Donasi -->
    <div class="bg-white rounded-3xl p-6 sm:p-8 shadow-sm border border-stone-200/80">
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead>
                    <tr class="text-left text-xs font-semibold text-[#64748B] uppercase tracking-wider border-b border-stone-100 pb-3">
                        <th class="pb-3">Tanggal</th>
                        <th class="pb-3">Kampanye</th>
                        <th class="pb-3">Nominal</th>
                        <th class="pb-3">Metode Transfer</th>
                        <th class="pb-3">Status Verifikasi</th>
                        <th class="pb-3 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-stone-100">
                    @forelse($donations as $d)
                        <tr class="hover:bg-stone-50/80 transition group">
                            <td class="py-4 pr-3 text-xs text-[#64748B] whitespace-nowrap">
                                {{ $d->created_at->format('d M Y') }}
                            </td>
                            <td class="py-4 px-3">
                                <div class="flex items-center gap-3">
                                    <div class="w-9 h-9 rounded-xl bg-orange-50 text-brand-500 flex items-center justify-center shrink-0">
                                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z" clip-rule="evenodd"/></svg>
                                    </div>
                                    <span class="font-semibold text-[#1E293B] text-sm group-hover:text-brand-500 transition">
                                        {{ $d->campaign->title }}
                                    </span>
                                </div>
                            </td>
                            <td class="py-4 px-3 font-bold text-[#1E293B] whitespace-nowrap">
                                Rp{{ number_format($d->amount, 0, ',', '.') }}
                            </td>
                            <td class="py-4 px-3 whitespace-nowrap">
                                <span class="inline-block px-2.5 py-1 rounded-full text-xs font-semibold bg-stone-100 text-stone-700">
                                    {{ $d->method }}
                                </span>
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
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td class="py-12 text-center text-[#64748B]" colspan="6">
                                <div class="w-12 h-12 rounded-full bg-stone-100 text-stone-400 mx-auto flex items-center justify-center mb-3">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                </div>
                                <p class="font-semibold text-base text-[#1E293B]">Belum Ada Riwayat Donasi</p>
                                <p class="text-xs text-[#64748B] mt-1 max-w-sm mx-auto">
                                    Anda belum memiliki transaksi donasi. Silakan jelajahi program kebaikan yang sedang berjalan.
                                </p>
                                <a href="{{ route('campaigns.index') }}" class="inline-block mt-4 px-5 py-2 rounded-full text-xs font-bold bg-brand-500 text-white shadow-sm">
                                    Lihat Kampanye
                                </a>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="mt-8 pt-4 border-t border-stone-100 flex justify-center">
            {{ $donations->links() }}
        </div>
    </div>

</div>

@endsection
