@extends('layouts.app')
@section('title', 'Penyaluran Dana')
@section('content')

<div class="space-y-6">
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <h1 class="font-bold text-2xl sm:text-3xl text-[#1E293B]">Penyaluran Dana</h1>
            <p class="text-xs sm:text-sm text-[#64748B] mt-0.5">Catat dan pantau distribusi bantuan kepada penerima manfaat.</p>
        </div>
        <!-- Tombol Catat Penyaluran Oranye #F97316 -->
        <a href="{{ route('admin.disbursements.create') }}" 
           class="inline-flex items-center gap-2 bg-brand-500 hover:bg-brand-600 text-white text-xs sm:text-sm font-semibold px-5 py-2.5 rounded-full shadow-sm hover:shadow-orange-glow transition self-start sm:self-auto">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
            <span>+ Catat Penyaluran</span>
        </a>
    </div>

    <!-- Kartu Tabel Penyaluran Dana -->
    <div class="bg-white rounded-3xl p-6 sm:p-7 shadow-sm border border-stone-200/80">
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead>
                    <tr class="text-left text-xs font-semibold text-[#64748B] uppercase tracking-wider border-b border-stone-100 pb-3">
                        <th class="pb-3">Tanggal Penyaluran</th>
                        <th class="pb-3">Kampanye</th>
                        <th class="pb-3">Penerima / Rincian Kegiatan</th>
                        <th class="pb-3">Jumlah Dana</th>
                        <th class="pb-3 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-stone-100">
                    @forelse($disbursements as $p)
                        <tr class="hover:bg-stone-50/80 transition">
                            <td class="py-3.5 pr-3 text-xs text-[#64748B] whitespace-nowrap">{{ $p->disbursed_at->format('d M Y') }}</td>
                            <td class="py-3.5 px-3 font-semibold text-[#1E293B] max-w-xs line-clamp-1">{{ $p->campaign->title }}</td>
                            <td class="py-3.5 px-3 text-[#1E293B]">{{ $p->recipient }}</td>
                            <td class="py-3.5 px-3 font-bold text-brand-600 whitespace-nowrap">Rp{{ number_format($p->amount, 0, ',', '.') }}</td>
                            <td class="py-3.5 pl-3 text-right whitespace-nowrap">
                                <form method="POST" action="{{ route('admin.disbursements.destroy', $p) }}" onsubmit="return confirm('Hapus catatan penyaluran ini?')">
                                    @csrf @method('DELETE')
                                    <button class="text-danger hover:underline text-xs font-semibold">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr><td class="py-8 text-center text-[#64748B] text-xs" colspan="5">Belum ada penyaluran dana tercatat.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-6 pt-4 border-t border-stone-100 flex justify-center">
            {{ $disbursements->links() }}
        </div>
    </div>
</div>

@endsection
