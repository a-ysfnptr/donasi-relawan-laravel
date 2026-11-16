@extends('layouts.app')
@section('title', 'Laporan & Ekspor Donasi')
@section('content')

<!-- Wrapper Latar Krem Hangat #FFFBF5 & Kartu Putih -->
<div class="space-y-8">
    
    <!-- Header Console -->
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div>
            <div class="flex items-center gap-2">
                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold bg-emerald-50 text-[#059669] border border-emerald-200">
                    <span class="w-2 h-2 rounded-full bg-[#059669]"></span>
                    Laporan Resmi
                </span>
                <span class="text-xs text-[#64748B]">Terverifikasi &amp; Siap Audit</span>
            </div>
            <h1 class="font-bold text-2xl sm:text-3xl lg:text-4xl text-[#1E293B] tracking-tight mt-1.5">
                Laporan Rekapitulasi Donasi
            </h1>
            <p class="text-sm text-[#64748B] mt-0.5">
                Analisis distribusi dana, agregasi per kampanye, bulan, kategori, serta ekspor dokumen resmi.
            </p>
        </div>
        
        <!-- Quick Ekspor Action Pills -->
        <div class="flex items-center gap-2">
            <a href="{{ route('admin.reports.csv', request()->query()) }}" 
               class="inline-flex items-center gap-2 bg-white hover:bg-stone-50 text-[#1E293B] border border-stone-200/80 text-xs sm:text-sm font-semibold px-4 py-2.5 rounded-full shadow-sm transition">
                <svg class="w-4 h-4 text-brand-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                <span>Ekspor CSV</span>
            </a>
            <a href="{{ route('admin.reports.pdf', request()->query()) }}" 
               class="inline-flex items-center gap-2 bg-brand-500 hover:bg-brand-600 text-white text-xs sm:text-sm font-semibold px-4 py-2.5 rounded-full shadow-sm hover:shadow-orange-glow transition">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"/></svg>
                <span>Ekspor PDF</span>
            </a>
        </div>
    </div>

    <!-- Navigasi Pill: Aktif Oranye #F97316 -->
    <div class="flex items-center gap-2 overflow-x-auto pb-1 text-xs sm:text-sm">
        <a href="{{ route('admin.dashboard') }}" 
           class="px-5 py-2 rounded-full font-medium transition bg-white text-stone-600 hover:text-brand-500 hover:bg-stone-50 shadow-sm border border-stone-200/80 whitespace-nowrap">
            Dashboard
        </a>
        <a href="{{ route('admin.campaigns.index') }}" 
           class="px-5 py-2 rounded-full font-medium transition bg-white text-stone-600 hover:text-brand-500 hover:bg-stone-50 shadow-sm border border-stone-200/80 whitespace-nowrap">
            Kelola Kampanye
        </a>
        <a href="{{ route('admin.donations.index') }}" 
           class="px-5 py-2 rounded-full font-medium transition bg-white text-stone-600 hover:text-brand-500 hover:bg-stone-50 shadow-sm border border-stone-200/80 whitespace-nowrap">
            Verifikasi Donasi
        </a>
        <a href="{{ route('admin.volunteers.index') }}" 
           class="px-5 py-2 rounded-full font-medium transition bg-white text-stone-600 hover:text-brand-500 hover:bg-stone-50 shadow-sm border border-stone-200/80 whitespace-nowrap">
            Kelola Relawan
        </a>
        <a href="{{ route('admin.disbursements.index') }}" 
           class="px-5 py-2 rounded-full font-medium transition bg-white text-stone-600 hover:text-brand-500 hover:bg-stone-50 shadow-sm border border-stone-200/80 whitespace-nowrap">
            Penyaluran Dana
        </a>
        <a href="{{ route('admin.reports.index') }}" 
           class="px-5 py-2 rounded-full font-semibold transition bg-brand-500 text-white shadow-sm whitespace-nowrap">
            Laporan &amp; Ekspor
        </a>
        <a href="{{ route('admin.audit-logs.index') }}" 
           class="px-5 py-2 rounded-full font-medium transition bg-white text-stone-600 hover:text-brand-500 hover:bg-stone-50 shadow-sm border border-stone-200/80 whitespace-nowrap">
            Audit Log
        </a>
    </div>

    <!-- 2 Kartu Statistik Besar -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <!-- KARTU 1: TOTAL DONASI TERVERIFIKASI SESUAI FILTER (EMERALD KHUSUS STATUS SUKSES/TERVERIFIKASI) -->
        <div class="bg-gradient-to-br from-[#059669] via-[#047857] to-[#064E3B] text-white rounded-3xl p-7 shadow-lg shadow-emerald-950/10 flex flex-col justify-between relative overflow-hidden">
            <div class="absolute -right-6 -bottom-6 w-36 h-36 rounded-full bg-white/10 blur-xl pointer-events-none"></div>
            <div class="flex items-center justify-between relative z-10">
                <span class="text-xs font-bold tracking-widest uppercase text-emerald-200">Total Donasi Terverifikasi</span>
                <span class="w-8 h-8 rounded-full bg-white/20 text-white flex items-center justify-center">
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414 0z" clip-rule="evenodd"/></svg>
                </span>
            </div>
            <div class="my-4 relative z-10">
                <div class="text-3xl sm:text-4xl font-extrabold tracking-tight">
                    Rp{{ number_format($totalVerified, 0, ',', '.') }}
                </div>
                <p class="text-xs text-emerald-100 mt-1">Sesuai filter kampanye dan periode aktif</p>
            </div>
            <div class="pt-2 border-t border-white/15 text-xs text-emerald-200 relative z-10">
                <span>Data akurat &amp; telah diaudit</span>
            </div>
        </div>

        <!-- KARTU 2: TOTAL TERSALURKAN (KARTU PUTIH ROUNDED-3XL) -->
        <div class="bg-white rounded-3xl p-7 shadow-sm border border-stone-200/80 flex flex-col justify-between">
            <div class="flex items-center justify-between">
                <span class="text-xs font-bold tracking-widest uppercase text-[#64748B]">Total Dana Tersalurkan</span>
                <div class="w-8 h-8 rounded-xl bg-orange-50 text-brand-500 flex items-center justify-center">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                </div>
            </div>
            <div class="my-3">
                <div class="text-3xl sm:text-4xl font-extrabold text-[#1E293B]">
                    Rp{{ number_format($totalDisbursed, 0, ',', '.') }}
                </div>
                <p class="text-xs text-[#64748B] mt-1">Bantuan terealisasi untuk program terkait</p>
            </div>
            <div class="pt-2 border-t border-stone-100 text-xs text-[#64748B]">
                <span>Sisa dana tersimpan aman di rekening resmi</span>
            </div>
        </div>
    </div>

    <!-- Form Filter Laporan (Kartu Putih Rounded-3xl) -->
    <div class="bg-white rounded-3xl p-6 shadow-sm border border-stone-200/80">
        <h3 class="font-bold text-sm text-[#1E293B] mb-4 flex items-center gap-2">
            <svg class="w-4 h-4 text-brand-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"/></svg>
            <span>Filter Parameter Laporan</span>
        </h3>
        
        <form method="GET" action="{{ route('admin.reports.index') }}" class="grid grid-cols-1 sm:grid-cols-12 gap-3 items-center">
            <div class="sm:col-span-5">
                <select name="campaign_id" 
                        class="w-full py-2.5 px-4 bg-[#FFFBF5] border border-stone-200 rounded-2xl text-xs sm:text-sm text-[#1E293B] focus:outline-none focus:ring-2 focus:ring-brand-500/40 focus:border-brand-500 transition cursor-pointer">
                    <option value="">Semua Kampanye</option>
                    @foreach($campaigns as $c)
                        <option value="{{ $c->id }}" @selected((string)$campaignId === (string)$c->id)>{{ $c->title }}</option>
                    @endforeach
                </select>
            </div>

            <div class="sm:col-span-4">
                <input type="month" 
                       name="month" 
                       value="{{ $month }}" 
                       class="w-full py-2.5 px-4 bg-[#FFFBF5] border border-stone-200 rounded-2xl text-xs sm:text-sm text-[#1E293B] focus:outline-none focus:ring-2 focus:ring-brand-500/40 focus:border-brand-500 transition">
            </div>

            <div class="sm:col-span-3 flex items-center gap-2">
                <button type="submit" 
                        class="w-full inline-flex items-center justify-center gap-2 bg-brand-500 hover:bg-brand-600 text-white font-semibold text-xs sm:text-sm py-2.5 px-5 rounded-2xl shadow-sm hover:shadow-orange-glow transition">
                    <span>Terapkan</span>
                </button>
                @if($campaignId || $month)
                    <a href="{{ route('admin.reports.index') }}" class="text-xs text-[#64748B] hover:text-danger underline whitespace-nowrap">
                        Reset
                    </a>
                @endif
            </div>
        </form>
    </div>

    <!-- Tabel Rekapitulasi Per Kampanye -->
    <div class="bg-white rounded-3xl p-6 sm:p-7 shadow-sm border border-stone-200/80">
        <div class="flex items-center justify-between pb-4 mb-4 border-b border-stone-100">
            <div>
                <h2 class="font-bold text-lg text-[#1E293B]">Rekapitulasi Donasi Per Kampanye</h2>
                <p class="text-xs text-[#64748B] mt-0.5">Rincian akumulasi dana dan frekuensi donatur</p>
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead>
                    <tr class="text-left text-xs font-semibold text-[#64748B] uppercase tracking-wider border-b border-stone-100 pb-3">
                        <th class="pb-3">Kampanye</th>
                        <th class="pb-3 text-center">Jumlah Donasi</th>
                        <th class="pb-3 text-right">Total Terkumpul</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-stone-100">
                    @forelse($perCampaign as $row)
                        <tr class="hover:bg-stone-50/80 transition">
                            <td class="py-3.5 pr-4">
                                <div class="flex items-center gap-3">
                                    <div class="w-8 h-8 rounded-xl bg-orange-50 text-brand-500 flex items-center justify-center shrink-0">
                                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4z" clip-rule="evenodd"/></svg>
                                    </div>
                                    <span class="font-semibold text-[#1E293B] text-sm">{{ $row->campaign->title }}</span>
                                </div>
                            </td>
                            <td class="py-3.5 px-4 text-center">
                                <span class="inline-block px-3 py-1 rounded-full text-xs font-bold bg-stone-100 text-stone-700">
                                    {{ $row->jumlah }} Donasi
                                </span>
                            </td>
                            <td class="py-3.5 pl-4 text-right font-bold text-brand-600 whitespace-nowrap">
                                Rp{{ number_format($row->total, 0, ',', '.') }}
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td class="py-8 text-center text-[#64748B] text-xs" colspan="3">
                                Tidak ada data donasi yang cocok dengan filter.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- 2 Kolom: Per Bulan & Per Kategori -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
        
        <!-- REKAPITULASI PER BULAN -->
        <div class="bg-white rounded-3xl p-6 sm:p-7 shadow-sm border border-stone-200/80">
            <div class="pb-4 mb-4 border-b border-stone-100">
                <h2 class="font-bold text-base text-[#1E293B]">Rekapitulasi Per Bulan</h2>
                <p class="text-xs text-[#64748B]">Tren penerimaan dana bulanan</p>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead>
                        <tr class="text-left text-xs font-semibold text-[#64748B] uppercase tracking-wider border-b border-stone-100 pb-3">
                            <th class="pb-3">Bulan (YYYY-MM)</th>
                            <th class="pb-3 text-center">Transaksi</th>
                            <th class="pb-3 text-right">Total</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-stone-100">
                        @forelse($perMonth as $row)
                            <tr class="hover:bg-stone-50/80 transition">
                                <td class="py-3 pr-2 font-medium text-[#1E293B]">{{ $row->bulan }}</td>
                                <td class="py-3 px-2 text-center">
                                    <span class="inline-block px-2.5 py-0.5 rounded-full text-xs font-semibold bg-stone-100 text-stone-700">
                                        {{ $row->jumlah }}
                                    </span>
                                </td>
                                <td class="py-3 pl-2 text-right font-bold text-brand-600 whitespace-nowrap">
                                    Rp{{ number_format($row->total, 0, ',', '.') }}
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td class="py-6 text-center text-[#64748B] text-xs" colspan="3">Tidak ada data.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- REKAPITULASI PER KATEGORI -->
        <div class="bg-white rounded-3xl p-6 sm:p-7 shadow-sm border border-stone-200/80">
            <div class="pb-4 mb-4 border-b border-stone-100">
                <h2 class="font-bold text-base text-[#1E293B]">Rekapitulasi Per Kategori</h2>
                <p class="text-xs text-[#64748B]">Distribusi dana menurut sektor amal</p>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead>
                        <tr class="text-left text-xs font-semibold text-[#64748B] uppercase tracking-wider border-b border-stone-100 pb-3">
                            <th class="pb-3">Kategori</th>
                            <th class="pb-3 text-center">Transaksi</th>
                            <th class="pb-3 text-right">Total</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-stone-100">
                        @forelse($perCategory as $row)
                            <tr class="hover:bg-stone-50/80 transition">
                                <td class="py-3 pr-2 font-medium text-[#1E293B] capitalize">
                                    <span class="inline-flex items-center gap-1.5">
                                        <span class="w-2 h-2 rounded-full bg-brand-500"></span>
                                        {{ $row->category }}
                                    </span>
                                </td>
                                <td class="py-3 px-2 text-center">
                                    <span class="inline-block px-2.5 py-0.5 rounded-full text-xs font-semibold bg-stone-100 text-stone-700">
                                        {{ $row->jumlah }}
                                    </span>
                                </td>
                                <td class="py-3 pl-2 text-right font-bold text-brand-600 whitespace-nowrap">
                                    Rp{{ number_format($row->total, 0, ',', '.') }}
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td class="py-6 text-center text-[#64748B] text-xs" colspan="3">Tidak ada data.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

    </div>

</div>

@endsection
