@extends('layouts.app')
@section('title', 'Kelola Kampanye')
@section('content')

<div class="space-y-6">
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <h1 class="font-bold text-2xl sm:text-3xl text-[#1E293B]">Kelola Kampanye</h1>
            <p class="text-xs sm:text-sm text-[#64748B] mt-0.5">Kelola program penggalangan dana, target donasi, dan tenggat waktu.</p>
        </div>
        <!-- Tombol Tambah Kampanye Oranye #F97316 -->
        <a href="{{ route('admin.campaigns.create') }}" 
           class="inline-flex items-center gap-2 bg-brand-500 hover:bg-brand-600 text-white text-xs sm:text-sm font-semibold px-5 py-2.5 rounded-full shadow-sm hover:shadow-orange-glow transition self-start sm:self-auto">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
            <span>+ Kampanye Baru</span>
        </a>
    </div>

    <!-- Kartu Tabel Kampanye -->
    <div class="bg-white rounded-3xl p-6 sm:p-7 shadow-sm border border-stone-200/80">
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead>
                    <tr class="text-left text-xs font-semibold text-[#64748B] uppercase tracking-wider border-b border-stone-100 pb-3">
                        <th class="pb-3">Judul Kampanye</th>
                        <th class="pb-3">Kategori</th>
                        <th class="pb-3">Target</th>
                        <th class="pb-3">Terkumpul</th>
                        <th class="pb-3">Status</th>
                        <th class="pb-3">Tenggat</th>
                        <th class="pb-3 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-stone-100">
                    @forelse($campaigns as $c)
                        <tr class="hover:bg-stone-50/80 transition">
                            <td class="py-3.5 pr-3 font-semibold text-[#1E293B] max-w-xs line-clamp-1">{{ $c->title }}</td>
                            <td class="py-3.5 px-3">
                                <span class="inline-block px-2.5 py-0.5 rounded-full text-xs font-semibold bg-stone-100 text-stone-700 capitalize">
                                    {{ $c->category }}
                                </span>
                            </td>
                            <td class="py-3.5 px-3 font-medium text-[#1E293B] whitespace-nowrap">Rp{{ number_format($c->target_amount, 0, ',', '.') }}</td>
                            <td class="py-3.5 px-3 font-bold text-[#059669] whitespace-nowrap">Rp{{ number_format($c->verifiedTotal(), 0, ',', '.') }}</td>
                            <td class="py-3.5 px-3 whitespace-nowrap">
                                @if($c->status === 'aktif')
                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full text-xs font-semibold bg-emerald-50 text-[#059669] border border-emerald-200">
                                        <span class="w-1.5 h-1.5 rounded-full bg-[#059669]"></span>
                                        Aktif
                                    </span>
                                @else
                                    <span class="inline-block px-2.5 py-0.5 rounded-full text-xs font-semibold bg-stone-100 text-stone-600 capitalize">
                                        {{ $c->status }}
                                    </span>
                                @endif
                            </td>
                            <td class="py-3.5 px-3 text-xs text-[#64748B] whitespace-nowrap">{{ $c->deadline?->format('d M Y') ?? 'Tidak Ada' }}</td>
                            <td class="py-3.5 pl-3 text-right whitespace-nowrap">
                                <a class="text-brand-600 hover:text-brand-700 font-semibold text-xs mr-3" href="{{ route('admin.campaigns.edit', $c) }}">Ubah</a>
                                <form method="POST" action="{{ route('admin.campaigns.destroy', $c) }}" class="inline" onsubmit="return confirm('Hapus kampanye ini? Kampanye dengan donasi terverifikasi tidak dapat dihapus.')">
                                    @csrf @method('DELETE')
                                    <button class="text-danger hover:underline text-xs font-semibold">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr><td class="py-8 text-center text-[#64748B] text-xs" colspan="7">Belum ada kampanye terdaftar.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-6 pt-4 border-t border-stone-100 flex justify-center">
            {{ $campaigns->links() }}
        </div>
    </div>
</div>

@endsection
