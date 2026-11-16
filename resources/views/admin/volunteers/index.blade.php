@extends('layouts.app')
@section('title', 'Kelola Relawan')
@section('content')

<div class="space-y-6">
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <h1 class="font-bold text-2xl sm:text-3xl text-[#1E293B]">Kelola Relawan</h1>
            <p class="text-xs sm:text-sm text-[#64748B] mt-0.5">Validasi pendaftaran relawan lapangan, jadwal, dan keterampilan.</p>
        </div>
    </div>

    <!-- Filter Status -->
    <div class="bg-white rounded-3xl p-5 shadow-sm border border-stone-200/80">
        <form method="GET" action="{{ route('admin.volunteers.index') }}" class="flex flex-col sm:flex-row items-center gap-3">
            <div class="w-full sm:w-64">
                <select name="status" 
                        class="w-full py-2.5 px-4 bg-[#FFFBF5] border border-stone-200 rounded-2xl text-xs sm:text-sm text-[#1E293B] focus:outline-none focus:ring-2 focus:ring-brand-500/40 focus:border-brand-500 transition cursor-pointer">
                    <option value="">Semua Status</option>
                    @foreach(['menunggu','diterima','ditolak','dibatalkan'] as $s)
                        <option value="{{ $s }}" @selected(request('status') === $s)>{{ ucfirst($s) }}</option>
                    @endforeach
                </select>
            </div>
            <!-- Tombol Filter Oranye #F97316 -->
            <button type="submit" 
                    class="w-full sm:w-auto inline-flex items-center justify-center gap-2 bg-brand-500 hover:bg-brand-600 text-white font-semibold text-xs sm:text-sm px-6 py-2.5 rounded-2xl shadow-sm hover:shadow-orange-glow transition">
                <span>Filter</span>
            </button>
            @if(request('status'))
                <a href="{{ route('admin.volunteers.index') }}" class="text-xs text-[#64748B] hover:text-danger underline py-1">Reset</a>
            @endif
        </form>
    </div>

    <!-- Kartu Tabel Relawan -->
    <div class="bg-white rounded-3xl p-6 sm:p-7 shadow-sm border border-stone-200/80">
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead>
                    <tr class="text-left text-xs font-semibold text-[#64748B] uppercase tracking-wider border-b border-stone-100 pb-3">
                        <th class="pb-3">Nama Relawan</th>
                        <th class="pb-3">Kampanye Tujuan</th>
                        <th class="pb-3">Keahlian</th>
                        <th class="pb-3">Ketersediaan</th>
                        <th class="pb-3">Status</th>
                        <th class="pb-3 text-right">Aksi Persetujuan</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-stone-100">
                    @forelse($volunteers as $v)
                        <tr class="hover:bg-stone-50/80 transition">
                            <td class="py-3.5 pr-3 font-semibold text-[#1E293B]">{{ $v->user->name }}</td>
                            <td class="py-3.5 px-3 text-[#1E293B] max-w-xs line-clamp-1">{{ $v->campaign->title }}</td>
                            <td class="py-3.5 px-3">
                                <span class="inline-block px-2.5 py-0.5 rounded-full text-xs font-semibold bg-stone-100 text-stone-700">
                                    {{ $v->skill }}
                                </span>
                            </td>
                            <td class="py-3.5 px-3 text-[#64748B] text-xs sm:text-sm whitespace-nowrap">{{ $v->availability }}</td>
                            <td class="py-3.5 px-3 whitespace-nowrap">
                                @if($v->status === 'diterima')
                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full text-xs font-bold bg-emerald-50 text-[#059669] border border-emerald-200">
                                        <span class="w-1.5 h-1.5 rounded-full bg-[#059669]"></span>
                                        Diterima
                                    </span>
                                @elseif($v->status === 'menunggu')
                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full text-xs font-bold bg-amber-50 text-amber-700 border border-amber-200">
                                        <span class="w-1.5 h-1.5 rounded-full bg-amber-500 animate-pulse"></span>
                                        Menunggu
                                    </span>
                                @elseif($v->status === 'dibatalkan' || $v->status === 'ditolak')
                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full text-xs font-semibold bg-red-50 text-danger border border-red-200">
                                        <span class="w-1.5 h-1.5 rounded-full bg-danger"></span>
                                        {{ ucfirst($v->status) }}
                                    </span>
                                @else
                                    <span class="inline-block px-2.5 py-0.5 rounded-full text-xs font-semibold bg-stone-100 text-stone-600 capitalize">
                                        {{ $v->status }}
                                    </span>
                                @endif
                            </td>
                            <td class="py-3.5 pl-3 text-right whitespace-nowrap">
                                @if($v->status === 'menunggu')
                                    <!-- Aksi Terima (Sukses Emerald #059669) -->
                                    <form method="POST" action="{{ route('admin.volunteers.status', $v) }}" class="inline">
                                        @csrf
                                        <input type="hidden" name="status" value="diterima">
                                        <button class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold text-[#059669] bg-emerald-50 hover:bg-[#059669] hover:text-white transition">
                                            Terima
                                        </button>
                                    </form>
                                    <!-- Aksi Tolak (Bahaya Red #DC2626) -->
                                    <form method="POST" action="{{ route('admin.volunteers.status', $v) }}" class="inline ml-2">
                                        @csrf
                                        <input type="hidden" name="status" value="ditolak">
                                        <button class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold text-danger bg-red-50 hover:bg-danger hover:text-white transition">
                                            Tolak
                                        </button>
                                    </form>
                                @else
                                    <span class="text-xs text-[#64748B]">—</span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr><td class="py-8 text-center text-[#64748B] text-xs" colspan="6">Tidak ada pendaftaran relawan.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-6 pt-4 border-t border-stone-100 flex justify-center">
            {{ $volunteers->links() }}
        </div>
    </div>
</div>

@endsection
