@extends('layouts.app')
@section('title', 'Transparansi Dana — ' . $campaign->title)
@section('content')

<div class="space-y-8 my-6">
    <!-- Breadcrumb -->
    <nav class="flex items-center gap-2 text-xs text-[#64748B] overflow-x-auto">
        <a href="{{ route('home') }}" class="hover:text-brand-500 transition">Beranda</a>
        <span>/</span>
        <a href="{{ route('campaigns.index') }}" class="hover:text-brand-500 transition">Kampanye</a>
        <span>/</span>
        <a href="{{ route('campaigns.show', $campaign) }}" class="hover:text-brand-500 transition truncate max-w-xs">{{ $campaign->title }}</a>
        <span>/</span>
        <span class="text-[#1E293B] font-medium">Transparansi Dana</span>
    </nav>

    <!-- Header Transparansi -->
    <div class="bg-white rounded-3xl shadow-sm border border-stone-200/80 p-7 sm:p-8">
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
            <div>
                <div class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold bg-emerald-50 text-[#059669] border border-emerald-200 mb-2">
                    <span class="w-1.5 h-1.5 rounded-full bg-[#059669]"></span>
                    Laporan Transparansi Terbuka
                </div>
                <h1 class="font-serif text-2xl sm:text-3xl font-bold text-[#1E293B]">
                    Transparansi: {{ $campaign->title }}
                </h1>
                <p class="text-xs sm:text-sm text-[#64748B] mt-1">
                    Seluruh mutasi dana donatur diverifikasi tanpa memotong hak penerima manfaat.
                </p>
            </div>
            <a href="{{ route('campaigns.show', $campaign) }}" class="inline-flex items-center gap-1 text-xs font-bold text-brand-500 hover:underline">
                &larr; Kembali ke Kampanye
            </a>
        </div>

        <!-- 3 Kartu Ringkasan Keuangan -->
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 mt-6">
            <div class="p-5 rounded-2xl bg-[#FFFBF5] border border-stone-200/80 text-center">
                <span class="text-xs font-bold uppercase tracking-wider text-[#059669]">Terkumpul (Terverifikasi)</span>
                <p class="font-serif text-2xl font-bold text-[#1E293B] mt-1">Rp{{ number_format($campaign->verifiedTotal(), 0, ',', '.') }}</p>
            </div>
            <div class="p-5 rounded-2xl bg-[#FFFBF5] border border-stone-200/80 text-center">
                <span class="text-xs font-bold uppercase tracking-wider text-brand-600">Dana Tersalurkan</span>
                <p class="font-serif text-2xl font-bold text-[#1E293B] mt-1">Rp{{ number_format($campaign->disbursedTotal(), 0, ',', '.') }}</p>
            </div>
            <div class="p-5 rounded-2xl bg-[#FFFBF5] border border-stone-200/80 text-center">
                <span class="text-xs font-bold uppercase tracking-wider text-[#64748B]">Sisa Dana Tersedia</span>
                <p class="font-serif text-2xl font-bold text-[#059669] mt-1">Rp{{ number_format($campaign->remainingFunds(), 0, ',', '.') }}</p>
            </div>
        </div>
    </div>

    <!-- Tabel Donasi Terverifikasi -->
    <div class="bg-white rounded-3xl shadow-sm border border-stone-200/80 p-6 sm:p-7">
        <div class="flex items-center justify-between pb-4 mb-4 border-b border-stone-100">
            <div>
                <h2 class="font-bold text-lg text-[#1E293B]">Riwayat Donasi Terverifikasi</h2>
                <p class="text-xs text-[#64748B]">Daftar donatur yang telah diverifikasi valid oleh admin</p>
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead>
                    <tr class="text-left text-xs font-semibold text-[#64748B] uppercase tracking-wider border-b border-stone-100 pb-3">
                        <th class="pb-3">Tanggal</th>
                        <th class="pb-3">Nama Donatur</th>
                        <th class="pb-3">Nominal Donasi</th>
                        <th class="pb-3 text-right">Metode</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-stone-100">
                    @forelse($donations as $d)
                        <tr class="hover:bg-stone-50/80 transition">
                            <td class="py-3.5 pr-3 text-xs text-[#64748B] whitespace-nowrap">{{ $d->created_at->format('d M Y') }}</td>
                            <td class="py-3.5 px-3 font-semibold text-[#1E293B]">{{ $d->displayName() }}</td>
                            <td class="py-3.5 px-3 font-bold text-[#059669] whitespace-nowrap">Rp{{ number_format($d->amount, 0, ',', '.') }}</td>
                            <td class="py-3.5 pl-3 text-right">
                                <span class="inline-block px-2.5 py-0.5 rounded-full text-xs font-semibold bg-stone-100 text-stone-700">
                                    {{ $d->method }}
                                </span>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td class="py-8 text-center text-[#64748B] text-xs" colspan="4">Belum ada donasi terverifikasi.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-6 pt-4 border-t border-stone-100 flex justify-center">
            {{ $donations->links() }}
        </div>
    </div>

    <!-- Tabel Penyaluran Dana -->
    <div class="bg-white rounded-3xl shadow-sm border border-stone-200/80 p-6 sm:p-7">
        <div class="flex items-center justify-between pb-4 mb-4 border-b border-stone-100">
            <div>
                <h2 class="font-bold text-lg text-[#1E293B]">Riwayat Penyaluran Dana</h2>
                <p class="text-xs text-[#64748B]">Bukti realisasi bantuan dan distribusi di lapangan</p>
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead>
                    <tr class="text-left text-xs font-semibold text-[#64748B] uppercase tracking-wider border-b border-stone-100 pb-3">
                        <th class="pb-3">Tanggal Penyaluran</th>
                        <th class="pb-3">Penerima / Rincian Kegiatan</th>
                        <th class="pb-3 text-right">Jumlah Dana Disalurkan</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-stone-100">
                    @forelse($disbursements as $p)
                        <tr class="hover:bg-stone-50/80 transition">
                            <td class="py-3.5 pr-3 text-xs text-[#64748B] whitespace-nowrap">{{ $p->disbursed_at->format('d M Y') }}</td>
                            <td class="py-3.5 px-3 font-semibold text-[#1E293B]">{{ $p->recipient }}</td>
                            <td class="py-3.5 pl-3 text-right font-bold text-brand-600 whitespace-nowrap">Rp{{ number_format($p->amount, 0, ',', '.') }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td class="py-8 text-center text-[#64748B] text-xs" colspan="3">Belum ada data penyaluran dana.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection
