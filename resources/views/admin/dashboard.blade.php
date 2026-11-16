@extends('layouts.app')
@section('title', 'Dashboard Admin')
@section('content')

<!-- Wrapper Latar Krem Hangat #FFFBF5 & Kartu Putih -->
<div class="space-y-8">
    
    <!-- Header Console -->
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div>
            <div class="flex items-center gap-2.5">
                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold bg-orange-50 text-brand-700 border border-brand-200">
                    <span class="w-2 h-2 rounded-full bg-brand-500 animate-pulse"></span>
                    Admin Workspace
                </span>
                <span class="text-xs text-[#64748B]">Total Pengguna: <strong>{{ $totalUsers ?? '-' }}</strong></span>
            </div>
            <h1 class="font-bold text-2xl sm:text-3xl lg:text-4xl text-[#1E293B] tracking-tight mt-1.5">
                Dashboard Administrator
            </h1>
            <p class="text-sm text-[#64748B] mt-0.5">
                Pusat kendali operasional, verifikasi manual donasi, dan transparansi penyaluran dana.
            </p>
        </div>
        
        <div class="flex items-center gap-3">
            <div class="hidden sm:inline-flex items-center gap-2 px-4 py-2 bg-white rounded-full text-xs font-semibold text-[#64748B] shadow-sm border border-stone-200/80">
                <svg class="w-4 h-4 text-brand-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                <span>{{ now()->format('d M Y') }}</span>
            </div>
            <!-- Tombol Buat Kampanye Oranye #F97316 -->
            <a href="{{ route('admin.campaigns.create') }}" 
               class="inline-flex items-center gap-2 bg-brand-500 hover:bg-brand-600 text-white text-sm font-semibold px-5 py-2.5 rounded-full shadow-sm hover:shadow-orange-glow transition">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                <span>Buat Kampanye</span>
            </a>
        </div>
    </div>

    <!-- Navigasi Pill: Aktif Oranye #F97316 -->
    <div class="flex items-center gap-2 overflow-x-auto pb-1 text-xs sm:text-sm">
        <a href="{{ route('admin.dashboard') }}" 
           class="px-5 py-2 rounded-full font-semibold transition bg-brand-500 text-white shadow-sm whitespace-nowrap">
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
           class="px-5 py-2 rounded-full font-medium transition bg-white text-stone-600 hover:text-brand-500 hover:bg-stone-50 shadow-sm border border-stone-200/80 whitespace-nowrap">
            Laporan &amp; Ekspor
        </a>
        <a href="{{ route('admin.users.index') }}" 
           class="px-5 py-2 rounded-full font-medium transition bg-white text-stone-600 hover:text-brand-500 hover:bg-stone-50 shadow-sm border border-stone-200/80 whitespace-nowrap">
            Pengguna
        </a>
        <a href="{{ route('admin.audit-logs.index') }}" 
           class="px-5 py-2 rounded-full font-medium transition bg-white text-stone-600 hover:text-brand-500 hover:bg-stone-50 shadow-sm border border-stone-200/80 whitespace-nowrap">
            Audit Log
        </a>
    </div>

    <!-- 4 Kartu Statistik Besar -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
        
        <!-- KARTU 1: TOTAL DONASI TERVERIFIKASI (EMERALD KHUSUS STATUS SUKSES/TERVERIFIKASI) -->
        <div class="bg-gradient-to-br from-[#059669] via-[#047857] to-[#064E3B] text-white rounded-3xl p-6 sm:p-7 shadow-lg shadow-emerald-950/10 flex flex-col justify-between relative overflow-hidden">
            <div class="absolute -right-6 -bottom-6 w-32 h-32 rounded-full bg-white/10 blur-xl pointer-events-none"></div>
            <div class="flex items-center justify-between relative z-10">
                <span class="text-xs font-bold tracking-wider uppercase text-emerald-200">Donasi Terverifikasi</span>
                <span class="w-8 h-8 rounded-full bg-white/20 text-white flex items-center justify-center">
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></svg>
                </span>
            </div>
            <div class="my-4 relative z-10">
                <div class="text-2xl sm:text-3xl font-extrabold tracking-tight">
                    Rp{{ number_format($totalVerified, 0, ',', '.') }}
                </div>
                <p class="text-xs text-emerald-100 mt-1">Total dana masuk tervalidasi</p>
            </div>
            <div class="pt-2 border-t border-white/15 text-xs text-emerald-200 relative z-10">
                <span class="font-medium">100% Masuk Sistem</span>
            </div>
        </div>

        <!-- KARTU 2: DANA TERSALURKAN (KARTU PUTIH ROUNDED-3XL) -->
        <div class="bg-white rounded-3xl p-6 sm:p-7 shadow-sm border border-stone-200/80 flex flex-col justify-between">
            <div class="flex items-center justify-between">
                <span class="text-xs font-bold tracking-wider uppercase text-[#64748B]">Dana Tersalurkan</span>
                <div class="w-8 h-8 rounded-xl bg-orange-50 text-brand-500 flex items-center justify-center">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                </div>
            </div>
            <div class="my-3">
                <div class="text-2xl sm:text-3xl font-extrabold text-[#1E293B]">
                    Rp{{ number_format($totalDisbursed, 0, ',', '.') }}
                </div>
                <p class="text-xs text-[#64748B] mt-1">Bantuan diserahkan ke penerima</p>
            </div>
            <div class="pt-2 border-t border-stone-100 text-xs">
                <a href="{{ route('admin.disbursements.index') }}" class="text-brand-500 hover:underline font-semibold flex items-center justify-between">
                    <span>Penyaluran Dana</span>
                    <span>&rarr;</span>
                </a>
            </div>
        </div>

        <!-- KARTU 3: KAMPANYE AKTIF (KARTU PUTIH ROUNDED-3XL) -->
        <div class="bg-white rounded-3xl p-6 sm:p-7 shadow-sm border border-stone-200/80 flex flex-col justify-between">
            <div class="flex items-center justify-between">
                <span class="text-xs font-bold tracking-wider uppercase text-[#64748B]">Kampanye Aktif</span>
                <div class="w-8 h-8 rounded-xl bg-orange-50 text-brand-500 flex items-center justify-center">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/></svg>
                </div>
            </div>
            <div class="my-3">
                <div class="text-2xl sm:text-3xl font-extrabold text-[#1E293B]">
                    {{ $activeCampaigns }}
                </div>
                <p class="text-xs text-[#64748B] mt-1">Program penggalangan berjalan</p>
            </div>
            <div class="pt-2 border-t border-stone-100 text-xs">
                <a href="{{ route('admin.campaigns.index') }}" class="text-brand-500 hover:underline font-semibold flex items-center justify-between">
                    <span>Kelola Program</span>
                    <span>&rarr;</span>
                </a>
            </div>
        </div>

        <!-- KARTU 4: RELAWAN DITERIMA (KARTU PUTIH ROUNDED-3XL) -->
        <div class="bg-white rounded-3xl p-6 sm:p-7 shadow-sm border border-stone-200/80 flex flex-col justify-between">
            <div class="flex items-center justify-between">
                <span class="text-xs font-bold tracking-wider uppercase text-[#64748B]">Relawan Diterima</span>
                <div class="w-8 h-8 rounded-xl bg-emerald-50 text-[#059669] flex items-center justify-center">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
                </div>
            </div>
            <div class="my-3">
                <div class="text-2xl sm:text-3xl font-extrabold text-[#1E293B]">
                    {{ $acceptedVolunteers }}
                </div>
                <p class="text-xs text-[#64748B] mt-1">Personel siap bertugas di lapangan</p>
            </div>
            <div class="pt-2 border-t border-stone-100 text-xs">
                <a href="{{ route('admin.volunteers.index') }}" class="text-brand-500 hover:underline font-semibold flex items-center justify-between">
                    <span>Kelola Relawan</span>
                    <span>&rarr;</span>
                </a>
            </div>
        </div>

    </div>

    <!-- 2 Kolom: Antrean Menunggu Verifikasi -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
        
        <!-- KARTU DONASI MENUNGGU VERIFIKASI -->
        <div class="bg-white rounded-3xl p-6 sm:p-7 shadow-sm border border-stone-200/80">
            <div class="flex items-center justify-between pb-4 mb-4 border-b border-stone-100">
                <div class="flex items-center gap-2.5">
                    <div class="w-9 h-9 rounded-xl bg-amber-50 text-amber-600 flex items-center justify-center">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    </div>
                    <div>
                        <h2 class="font-bold text-base text-[#1E293B]">Donasi Menunggu Verifikasi</h2>
                        <p class="text-xs text-[#64748B]">Periksa bukti transfer dan cocokkan mutasi</p>
                    </div>
                </div>
                <a href="{{ route('admin.donations.index') }}" class="text-xs font-bold text-brand-500 hover:underline">
                    Lihat Semua &rarr;
                </a>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <tbody class="divide-y divide-stone-100">
                        @forelse($pendingDonations as $d)
                            <tr class="hover:bg-stone-50/80 transition group">
                                <td class="py-3.5 pr-2">
                                    <p class="font-semibold text-[#1E293B] text-sm leading-tight">{{ $d->user->name }}</p>
                                    <p class="text-xs text-[#64748B] line-clamp-1 mt-0.5">&rarr; {{ $d->campaign->title }}</p>
                                </td>
                                <td class="py-3.5 px-2 font-bold text-[#1E293B] whitespace-nowrap">
                                    Rp{{ number_format($d->amount, 0, ',', '.') }}
                                </td>
                                <td class="py-3.5 pl-2 text-right whitespace-nowrap">
                                    <a href="{{ route('admin.donations.show', $d) }}" 
                                       class="inline-flex items-center gap-1 px-3.5 py-1.5 rounded-full text-xs font-bold text-white bg-brand-500 hover:bg-brand-600 shadow-sm transition">
                                        <span>Periksa</span>
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td class="py-8 text-center text-[#64748B] text-xs" colspan="3">
                                    <svg class="w-8 h-8 text-stone-300 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                                    Tidak ada antrean donasi yang menunggu verifikasi.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- KARTU RELAWAN MENUNGGU PERSETUJUAN -->
        <div class="bg-white rounded-3xl p-6 sm:p-7 shadow-sm border border-stone-200/80">
            <div class="flex items-center justify-between pb-4 mb-4 border-b border-stone-100">
                <div class="flex items-center gap-2.5">
                    <div class="w-9 h-9 rounded-xl bg-orange-50 text-brand-500 flex items-center justify-center">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                    </div>
                    <div>
                        <h2 class="font-bold text-base text-[#1E293B]">Relawan Menunggu Persetujuan</h2>
                        <p class="text-xs text-[#64748B]">Validasi ketersediaan dan penugasan</p>
                    </div>
                </div>
                <a href="{{ route('admin.volunteers.index') }}" class="text-xs font-bold text-brand-500 hover:underline">
                    Lihat Semua &rarr;
                </a>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <tbody class="divide-y divide-stone-100">
                        @forelse($pendingVolunteers as $v)
                            <tr class="hover:bg-stone-50/80 transition">
                                <td class="py-3.5 pr-2">
                                    <p class="font-semibold text-[#1E293B] text-sm leading-tight">{{ $v->user->name }}</p>
                                    <p class="text-xs text-[#64748B] line-clamp-1 mt-0.5">&mdash; {{ $v->campaign->title }}</p>
                                </td>
                                <td class="py-3.5 px-2 text-right">
                                    <span class="inline-block px-3 py-1 rounded-full text-xs font-semibold bg-stone-100 text-stone-700">
                                        {{ $v->skill }}
                                    </span>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td class="py-8 text-center text-[#64748B] text-xs" colspan="2">
                                    <svg class="w-8 h-8 text-stone-300 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                                    Tidak ada antrean pendaftaran relawan.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

    </div>

    <!-- Kartu Riwayat Audit Log Terbaru -->
    <div class="bg-white rounded-3xl p-6 sm:p-7 shadow-sm border border-stone-200/80">
        <div class="flex items-center justify-between pb-4 mb-4 border-b border-stone-100">
            <div class="flex items-center gap-2.5">
                <div class="w-9 h-9 rounded-xl bg-stone-100 text-[#1E293B] flex items-center justify-center">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                </div>
                <div>
                    <h2 class="font-bold text-base text-[#1E293B]">Audit Log Aktivitas Terbaru</h2>
                    <p class="text-xs text-[#64748B]">Catatan aktivitas keamanan dan perubahan data (Integritas Sistem)</p>
                </div>
            </div>
            <a href="{{ route('admin.audit-logs.index') }}" class="text-xs font-bold text-brand-500 hover:underline">
                Semua Log &rarr;
            </a>
        </div>

        <ul class="divide-y divide-stone-100 text-xs sm:text-sm">
            @forelse($recentLogs as $log)
                <li class="py-3 flex flex-col sm:flex-row sm:items-center justify-between gap-2 hover:bg-stone-50/60 rounded-xl px-2 transition">
                    <div class="flex items-center gap-2.5">
                        <span class="w-2 h-2 rounded-full bg-brand-500 shrink-0"></span>
                        <span class="text-[#64748B] text-xs whitespace-nowrap">{{ $log->created_at->format('d M Y H:i') }}</span>
                        <span class="font-bold text-[#1E293B]">{{ $log->user?->name ?? 'Sistem' }}</span>
                        <span class="text-[#64748B]">: {{ $log->action }}</span>
                    </div>
                    <span class="inline-block px-2.5 py-0.5 rounded-full text-[11px] font-semibold bg-stone-100 text-[#64748B] self-start sm:self-center">
                        {{ $log->entity }} #{{ $log->entity_id }}
                    </span>
                </li>
            @empty
                <li class="py-6 text-center text-[#64748B] text-xs">Belum ada riwayat log tercatat.</li>
            @endforelse
        </ul>
    </div>

</div>

@endsection
