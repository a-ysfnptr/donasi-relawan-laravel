@extends('layouts.app')
@section('title', 'Verifikasi Donasi')
@section('content')

<div class="space-y-6">
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <h1 class="font-bold text-2xl sm:text-3xl text-[#1E293B]">Verifikasi Donasi</h1>
            <p class="text-xs sm:text-sm text-[#64748B] mt-0.5">Pemeriksaan bukti transfer donatur dan validasi mutasi rekening.</p>
        </div>
    </div>

    <!-- Filter Status -->
    <div class="bg-white rounded-3xl p-5 shadow-sm border border-stone-200/80">
        <form method="GET" action="{{ route('admin.donations.index') }}" class="flex flex-col sm:flex-row items-center gap-3">
            <div class="w-full sm:w-64">
                <select name="status" 
                        class="w-full py-2.5 px-4 bg-[#FFFBF5] border border-stone-200 rounded-2xl text-xs sm:text-sm text-[#1E293B] focus:outline-none focus:ring-2 focus:ring-brand-500/40 focus:border-brand-500 transition cursor-pointer">
                    <option value="">Semua Status</option>
                    @foreach(['menunggu','terverifikasi','ditolak','dibatalkan'] as $s)
                        <option value="{{ $s }}" @selected(request('status') === $s)>{{ ucfirst($s) }}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" 
                    class="w-full sm:w-auto inline-flex items-center justify-center gap-2 bg-brand-500 hover:bg-brand-600 text-white font-semibold text-xs sm:text-sm px-6 py-2.5 rounded-2xl shadow-sm hover:shadow-orange-glow transition">
                <span>Filter</span>
            </button>
            @if(request('status'))
                <a href="{{ route('admin.donations.index') }}" class="text-xs text-[#64748B] hover:text-danger underline py-1">Reset</a>
            @endif
        </form>
    </div>

    <!-- Tabel Verifikasi Donasi -->
    <div class="bg-white rounded-3xl p-6 sm:p-7 shadow-sm border border-stone-200/80">
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead>
                    <tr class="text-left text-xs font-semibold text-[#64748B] uppercase tracking-wider border-b border-stone-100 pb-3">
                        <th class="pb-3">Tanggal</th>
                        <th class="pb-3">Donatur</th>
                        <th class="pb-3">Kampanye</th>
                        <th class="pb-3">Nominal</th>
                        <th class="pb-3">Metode</th>
                        <th class="pb-3">Status</th>
                        <th class="pb-3 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-stone-100">
                    @forelse($donations as $d)
                        <tr class="hover:bg-stone-50/80 transition">
                            <td class="py-3.5 pr-3 text-xs text-[#64748B] whitespace-nowrap">{{ $d->created_at->format('d M Y') }}</td>
                            <td class="py-3.5 px-3 font-semibold text-[#1E293B]">{{ $d->user->name }}</td>
                            <td class="py-3.5 px-3 text-[#1E293B] max-w-xs line-clamp-1">{{ $d->campaign->title }}</td>
                            <td class="py-3.5 px-3 font-bold text-[#1E293B] whitespace-nowrap">Rp{{ number_format($d->amount, 0, ',', '.') }}</td>
                            <td class="py-3.5 px-3 whitespace-nowrap">
                                <span class="inline-block px-2.5 py-0.5 rounded-full text-xs font-semibold bg-stone-100 text-stone-700">
                                    {{ $d->method }}
                                </span>
                            </td>
                            <td class="py-3.5 px-3 whitespace-nowrap">
                                @if($d->status === 'terverifikasi')
                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full text-xs font-bold bg-emerald-50 text-[#059669] border border-emerald-200">
                                        <span class="w-1.5 h-1.5 rounded-full bg-[#059669]"></span>
                                        Terverifikasi
                                    </span>
                                @elseif($d->status === 'menunggu')
                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full text-xs font-bold bg-amber-50 text-amber-700 border border-amber-200">
                                        <span class="w-1.5 h-1.5 rounded-full bg-amber-500 animate-pulse"></span>
                                        Menunggu
                                    </span>
                                @else
                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full text-xs font-semibold bg-red-50 text-danger border border-red-200">
                                        <span class="w-1.5 h-1.5 rounded-full bg-danger"></span>
                                        {{ ucfirst($d->status) }}
                                    </span>
                                @endif
                            </td>
                            <td class="py-3.5 pl-3 text-right whitespace-nowrap">
                                <a href="{{ route('admin.donations.show', $d) }}" 
                                   class="inline-flex items-center gap-1 px-3 py-1.5 rounded-full text-xs font-bold text-brand-600 bg-orange-50 hover:bg-brand-500 hover:text-white transition">
                                    <span>Periksa</span>
                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr><td class="py-8 text-center text-[#64748B] text-xs" colspan="7">Tidak ada data donasi yang cocok.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-6 pt-4 border-t border-stone-100 flex justify-center">
            {{ $donations->links() }}
        </div>
    </div>
</div>

@endsection
