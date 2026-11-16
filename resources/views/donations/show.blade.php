@extends('layouts.app')
@section('title', 'Detail Donasi')
@section('content')
<div class="max-w-xl mx-auto my-6">
    <div class="bg-white rounded-3xl shadow-sm border border-stone-200/80 p-7 sm:p-8">
        <div class="flex items-center justify-between pb-4 mb-4 border-b border-stone-100">
            <div>
                <h1 class="font-serif text-2xl font-bold text-[#1E293B]">Detail Donasi</h1>
                <p class="text-xs text-[#64748B] mt-0.5">Informasi status dan verifikasi transaksi</p>
            </div>
            <a href="{{ route('donations.index') }}" class="text-xs font-semibold text-brand-500 hover:underline">
                &larr; Riwayat Donasi
            </a>
        </div>

        <dl class="space-y-3 text-sm">
            <div class="flex justify-between items-center py-2 border-b border-stone-100">
                <dt class="text-[#64748B]">Kampanye</dt>
                <dd class="font-bold text-[#1E293B] text-right max-w-xs line-clamp-1">{{ $donation->campaign->title }}</dd>
            </div>
            <div class="flex justify-between items-center py-2 border-b border-stone-100">
                <dt class="text-[#64748B]">Nominal Donasi</dt>
                <dd class="font-bold text-lg text-brand-600">Rp{{ number_format($donation->amount, 0, ',', '.') }}</dd>
            </div>
            <div class="flex justify-between items-center py-2 border-b border-stone-100">
                <dt class="text-[#64748B]">Metode Pembayaran</dt>
                <dd class="font-semibold px-2.5 py-0.5 rounded-full bg-stone-100 text-stone-700 text-xs">{{ $donation->method }}</dd>
            </div>
            <div class="flex justify-between items-center py-2 border-b border-stone-100">
                <dt class="text-[#64748B]">Status Verifikasi</dt>
                <dd>
                    @if($donation->status === 'terverifikasi')
                        <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold bg-emerald-50 text-[#059669] border border-emerald-200">
                            <span class="w-1.5 h-1.5 rounded-full bg-[#059669]"></span>
                            Terverifikasi
                        </span>
                    @elseif($donation->status === 'menunggu')
                        <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold bg-amber-50 text-amber-700 border border-amber-200">
                            <span class="w-1.5 h-1.5 rounded-full bg-amber-500 animate-pulse"></span>
                            Menunggu Verifikasi
                        </span>
                    @else
                        <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold bg-red-50 text-danger border border-red-200">
                            <span class="w-1.5 h-1.5 rounded-full bg-danger"></span>
                            {{ ucfirst($donation->status) }}
                        </span>
                    @endif
                </dd>
            </div>
            <div class="flex justify-between items-center py-2 border-b border-stone-100">
                <dt class="text-[#64748B]">Bukti Transfer</dt>
                <dd class="text-xs font-medium">
                    @if($donation->proof_file)
                        <span class="text-[#059669] font-bold flex items-center gap-1">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                            Sudah diunggah
                        </span>
                    @else
                        <span class="text-amber-600 font-semibold">Belum diunggah</span>
                    @endif
                </dd>
            </div>

            @if($donation->reject_reason)
                <div class="p-3 rounded-2xl bg-red-50 border border-red-200 text-xs">
                    <dt class="font-bold text-danger mb-0.5">Alasan Penolakan:</dt>
                    <dd class="text-danger-700">{{ $donation->reject_reason }}</dd>
                </div>
            @endif

            @if($donation->message)
                <div class="p-3 rounded-2xl bg-[#FFFBF5] border border-stone-200 text-xs">
                    <dt class="font-bold text-[#1E293B] mb-0.5">Pesan Donatur:</dt>
                    <dd class="text-[#64748B] italic">"{{ $donation->message }}"</dd>
                </div>
            @endif
        </dl>

        @if($donation->status === 'menunggu')
            <div class="mt-6 pt-6 border-t border-stone-100">
                <form method="POST" action="{{ route('donations.proof', $donation) }}" enctype="multipart/form-data" class="space-y-3">
                    @csrf
                    <label class="block text-xs font-semibold uppercase tracking-wider text-[#1E293B]">
                        Unggah / Ganti Bukti Transfer (gambar/PDF maks 2 MB)
                    </label>
                    <input type="file" 
                           name="proof_file" 
                           required 
                           accept=".jpg,.jpeg,.png,.webp,.pdf" 
                           class="w-full px-4 py-2.5 bg-[#FFFBF5] border border-stone-200 rounded-xl text-xs text-[#1E293B] focus:outline-none focus:ring-2 focus:ring-brand-500/40 focus:border-brand-500 transition file:mr-4 file:py-1 file:px-3 file:rounded-full file:border-0 file:text-xs file:font-semibold file:bg-orange-50 file:text-brand-600 hover:file:bg-orange-100">
                    
                    <!-- Tombol Unggah Bukti Oranye #F97316 -->
                    <button type="submit" 
                            class="inline-flex items-center gap-2 bg-brand-500 hover:bg-brand-600 text-white font-bold text-sm px-5 py-2.5 rounded-full shadow-sm hover:shadow-orange-glow transition">
                        <span>Unggah Bukti</span>
                    </button>
                </form>

                <form method="POST" action="{{ route('donations.cancel', $donation) }}" class="mt-4" onsubmit="return confirm('Batalkan donasi ini?')">
                    @csrf
                    <button type="submit" class="text-danger hover:underline text-xs font-semibold">
                        Batalkan Donasi Ini
                    </button>
                </form>
            </div>
        @endif
    </div>
</div>
@endsection
