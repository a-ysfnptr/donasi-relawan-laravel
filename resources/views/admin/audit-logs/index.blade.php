@extends('layouts.app')
@section('title', 'Audit Log')
@section('content')

<div class="space-y-6">
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <h1 class="font-bold text-2xl sm:text-3xl text-[#1E293B]">Audit Log Sistem</h1>
            <p class="text-xs sm:text-sm text-[#64748B] mt-0.5">Catatan jejak aktivitas keamanan, perubahan data, dan IP address.</p>
        </div>
    </div>

    <!-- Kartu Tabel Audit Log -->
    <div class="bg-white rounded-3xl p-6 sm:p-7 shadow-sm border border-stone-200/80">
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead>
                    <tr class="text-left text-xs font-semibold text-[#64748B] uppercase tracking-wider border-b border-stone-100 pb-3">
                        <th class="pb-3">Waktu</th>
                        <th class="pb-3">Pelaku</th>
                        <th class="pb-3">Aksi</th>
                        <th class="pb-3">Entitas</th>
                        <th class="pb-3">Detail Keterangan</th>
                        <th class="pb-3 text-right">Alamat IP</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-stone-100">
                    @forelse($logs as $log)
                        <tr class="hover:bg-stone-50/80 transition text-xs sm:text-sm">
                            <td class="py-3.5 pr-3 text-xs text-[#64748B] whitespace-nowrap">{{ $log->created_at->format('d M Y H:i') }}</td>
                            <td class="py-3.5 px-3 font-semibold text-[#1E293B] whitespace-nowrap">{{ $log->user?->name ?? 'Sistem' }}</td>
                            <td class="py-3.5 px-3">
                                <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full text-xs font-semibold bg-orange-50 text-brand-700">
                                    <span class="w-1.5 h-1.5 rounded-full bg-brand-500"></span>
                                    {{ $log->action }}
                                </span>
                            </td>
                            <td class="py-3.5 px-3 whitespace-nowrap">
                                <span class="px-2 py-0.5 rounded-md bg-stone-100 text-stone-700 text-xs font-mono">
                                    {{ $log->entity }} #{{ $log->entity_id }}
                                </span>
                            </td>
                            <td class="py-3.5 px-3 text-[#1E293B] max-w-sm line-clamp-1">{{ $log->detail }}</td>
                            <td class="py-3.5 pl-3 text-right text-xs font-mono text-[#64748B] whitespace-nowrap">{{ $log->ip_address }}</td>
                        </tr>
                    @empty
                        <tr><td class="py-8 text-center text-[#64748B] text-xs" colspan="6">Belum ada riwayat audit log.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-6 pt-4 border-t border-stone-100 flex justify-center">
            {{ $logs->links() }}
        </div>
    </div>
</div>

@endsection
