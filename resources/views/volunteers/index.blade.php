@extends('layouts.app')
@section('title', 'Pendaftaran Relawan Saya')
@section('content')

<!-- Wrapper Latar Krem Hangat #FFFBF5 & Kartu Putih -->
<div class="space-y-8">
    
    <!-- Header -->
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <h1 class="font-bold text-2xl sm:text-3xl lg:text-4xl text-[#1E293B] tracking-tight">
                Pendaftaran Relawan Saya
            </h1>
            <p class="text-sm text-[#64748B] mt-1">
                Kelola data keahlian, ketersediaan jadwal bertugas, dan status persetujuan dari tim admin.
            </p>
        </div>
        
        <!-- Tombol Oranye #F97316 -->
        <a href="{{ route('campaigns.index') }}" 
           class="inline-flex items-center gap-2 bg-brand-500 hover:bg-brand-600 text-white text-sm font-semibold px-5 py-2.5 rounded-full shadow-sm hover:shadow-orange-glow transition self-start sm:self-auto">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
            <span>Daftar Relawan Baru</span>
        </a>
    </div>

    <!-- Navigasi Pill: Aktif Oranye #F97316 -->
    <div class="flex items-center gap-2 overflow-x-auto pb-1 text-xs sm:text-sm">
        <a href="{{ route('dashboard') }}" 
           class="px-5 py-2 rounded-full font-medium transition bg-white text-stone-600 hover:text-brand-500 hover:bg-stone-50 shadow-sm border border-stone-200/80 whitespace-nowrap">
            Dashboard
        </a>
        <a href="{{ route('donations.index') }}" 
           class="px-5 py-2 rounded-full font-medium transition bg-white text-stone-600 hover:text-brand-500 hover:bg-stone-50 shadow-sm border border-stone-200/80 whitespace-nowrap">
            Donasi Saya
        </a>
        <a href="{{ route('volunteers.index') }}" 
           class="px-5 py-2 rounded-full font-semibold transition bg-brand-500 text-white shadow-sm whitespace-nowrap">
            Relawan Saya
        </a>
        <a href="{{ route('campaigns.index') }}" 
           class="px-5 py-2 rounded-full font-medium transition bg-white text-stone-600 hover:text-brand-500 hover:bg-stone-50 shadow-sm border border-stone-200/80 whitespace-nowrap">
            Jelajahi Kampanye
        </a>
    </div>

    <!-- Kartu Tabel Pendaftaran Relawan -->
    <div class="bg-white rounded-3xl p-6 sm:p-8 shadow-sm border border-stone-200/80">
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead>
                    <tr class="text-left text-xs font-semibold text-[#64748B] uppercase tracking-wider border-b border-stone-100 pb-3">
                        <th class="pb-3">Kampanye</th>
                        <th class="pb-3">Keahlian</th>
                        <th class="pb-3">Ketersediaan</th>
                        <th class="pb-3">Status Persetujuan</th>
                        <th class="pb-3 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-stone-100">
                    @forelse($volunteers as $v)
                        <tr class="hover:bg-stone-50/80 transition group">
                            <td class="py-4 pr-3">
                                <div class="flex items-center gap-3">
                                    <div class="w-9 h-9 rounded-xl bg-orange-50 text-brand-500 flex items-center justify-center shrink-0">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                                    </div>
                                    <span class="font-semibold text-[#1E293B] text-sm group-hover:text-brand-500 transition">
                                        {{ $v->campaign->title }}
                                    </span>
                                </div>
                            </td>
                            <td class="py-4 px-3 whitespace-nowrap">
                                <span class="inline-block px-3 py-1 rounded-full text-xs font-semibold bg-stone-100 text-stone-700">
                                    {{ $v->skill }}
                                </span>
                            </td>
                            <td class="py-4 px-3 text-[#64748B] text-xs sm:text-sm whitespace-nowrap">
                                {{ $v->availability }}
                            </td>
                            <td class="py-4 px-3 whitespace-nowrap">
                                @if($v->status === 'diterima')
                                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-semibold bg-emerald-50 text-[#059669] border border-emerald-200">
                                        <span class="w-1.5 h-1.5 rounded-full bg-[#059669]"></span>
                                        Diterima
                                    </span>
                                @elseif($v->status === 'menunggu')
                                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-semibold bg-amber-50 text-amber-700 border border-amber-200">
                                        <span class="w-1.5 h-1.5 rounded-full bg-amber-500 animate-pulse"></span>
                                        Menunggu Persetujuan
                                    </span>
                                @elseif($v->status === 'dibatalkan')
                                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-semibold bg-red-50 text-danger border border-red-200">
                                        <span class="w-1.5 h-1.5 rounded-full bg-danger"></span>
                                        Dibatalkan
                                    </span>
                                @else
                                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-semibold bg-stone-100 text-stone-600 border border-stone-200">
                                        <span class="w-1.5 h-1.5 rounded-full bg-stone-400"></span>
                                        {{ ucfirst($v->status) }}
                                    </span>
                                @endif
                            </td>
                            <td class="py-4 pl-3 text-right whitespace-nowrap">
                                @if($v->status === 'menunggu')
                                    <form method="POST" action="{{ route('volunteers.cancel', $v) }}" onsubmit="return confirm('Batalkan pendaftaran ini?')" class="inline">
                                        @csrf
                                        <button type="submit" 
                                                class="inline-flex items-center gap-1 px-3 py-1.5 rounded-full text-xs font-semibold text-danger bg-red-50 hover:bg-danger hover:text-white transition">
                                            <span>Batalkan</span>
                                        </button>
                                    </form>
                                @else
                                    <span class="text-xs text-[#64748B]">—</span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td class="py-12 text-center text-[#64748B]" colspan="5">
                                <div class="w-12 h-12 rounded-full bg-stone-100 text-stone-400 mx-auto flex items-center justify-center mb-3">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                                </div>
                                <p class="font-semibold text-base text-[#1E293B]">Belum Ada Pendaftaran Relawan</p>
                                <p class="text-xs text-[#64748B] mt-1 max-w-sm mx-auto">
                                    Anda belum mendaftar aksi relawan. Pilih program kemanusiaan dan daftarkan keahlian Anda sekarang.
                                </p>
                                <a href="{{ route('campaigns.index') }}" class="inline-block mt-4 px-5 py-2 rounded-full text-xs font-bold bg-brand-500 text-white shadow-sm">
                                    Cari Program Relawan
                                </a>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="mt-8 pt-4 border-t border-stone-100 flex justify-center">
            {{ $volunteers->links() }}
        </div>
    </div>

</div>

@endsection
