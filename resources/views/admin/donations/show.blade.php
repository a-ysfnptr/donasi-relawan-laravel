@extends('layouts.app')
@section('title', 'Periksa Donasi')
@section('content')
<div class="max-w-xl mx-auto my-6">
    <div class="bg-white rounded-3xl shadow-sm border border-stone-200/80 p-7 sm:p-8">
        <div class="flex items-center justify-between pb-4 mb-4 border-b border-stone-100">
            <div>
                <h1 class="font-serif text-2xl font-bold text-[#1E293B]">Periksa &amp; Validasi Donasi</h1>
                <p class="text-xs text-[#64748B] mt-0.5">Verifikasi keabsahan dana dan mutasi rekening</p>
            </div>
            <a href="{{ route('admin.donations.index') }}" class="text-xs font-semibold text-brand-500 hover:underline">
                &larr; Daftar Donasi
            </a>
        </div>

        <dl class="space-y-3 text-sm">
            <div class="flex justify-between items-center py-2 border-b border-stone-100">
                <dt class="text-[#64748B]">Nama Donatur</dt>
                <dd class="font-bold text-[#1E293B]">{{ $donation->user->name }} <span class="text-xs font-normal text-[#64748B]">({{ $donation->user->email }})</span></dd>
            </div>
            <div class="flex justify-between items-center py-2 border-b border-stone-100">
                <dt class="text-[#64748B]">Kampanye Tujuan</dt>
                <dd class="font-semibold text-[#1E293B] text-right max-w-xs line-clamp-1">{{ $donation->campaign->title }}</dd>
            </div>
            <div class="flex justify-between items-center py-2 border-b border-stone-100">
                <dt class="text-[#64748B]">Nominal Donasi</dt>
                <dd class="font-bold text-xl text-brand-600">Rp{{ number_format($donation->amount, 0, ',', '.') }}</dd>
            </div>
            <div class="flex justify-between items-center py-2 border-b border-stone-100">
                <dt class="text-[#64748B]">Metode Pembayaran</dt>
                <dd class="font-semibold px-2.5 py-0.5 rounded-full bg-stone-100 text-stone-700 text-xs">{{ $donation->method }}</dd>
            </div>
            <div class="flex justify-between items-center py-2 border-b border-stone-100">
                <dt class="text-[#64748B]">Status Donasi</dt>
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
                        <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-semibold bg-red-50 text-danger border border-red-200">
                            <span class="w-1.5 h-1.5 rounded-full bg-danger"></span>
                            {{ ucfirst($donation->status) }}
                        </span>
                    @endif
                </dd>
            </div>
            <div class="flex justify-between items-center py-2 border-b border-stone-100">
                <dt class="text-[#64748B]">Bukti Transfer</dt>
                <dd class="text-xs font-semibold">
                    @if($donation->proof_file)
                        <span class="text-[#059669] flex items-center gap-1">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                            {{ $donation->proof_file }}
                        </span>
                    @else
                        <span class="text-amber-600">Belum diunggah</span>
                    @endif
                </dd>
            </div>

            @if($donation->message)
                <div class="p-3 rounded-2xl bg-[#FFFBF5] border border-stone-200 text-xs">
                    <dt class="font-bold text-[#1E293B] mb-0.5">Pesan Donatur:</dt>
                    <dd class="text-[#64748B] italic">"{{ $donation->message }}"</dd>
                </div>
            @endif

            @if($donation->reject_reason)
                <div class="p-3 rounded-2xl bg-red-50 border border-red-200 text-xs">
                    <dt class="font-bold text-danger mb-0.5">Alasan Penolakan:</dt>
                    <dd class="text-danger-700">{{ $donation->reject_reason }}</dd>
                </div>
            @endif
        </dl>

        @if($donation->status === 'menunggu')
            <div class="mt-6 pt-6 border-t border-stone-100 space-y-4">
                <!-- Tombol Verifikasi Donasi (Hijau Emerald #059669 untuk Status Sukses/Terverifikasi) -->
                <form method="POST" action="{{ route('admin.donations.verify', $donation) }}">
                    @csrf
                    <button type="submit" 
                            class="w-full bg-[#059669] hover:bg-[#047857] text-white font-bold py-3.5 px-4 rounded-full shadow-sm transition flex items-center justify-center gap-2" 
                            onclick="return confirm('Verifikasi donasi ini? Dana akan tercatat resmi pada kampanye.')">
                        <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                        <span>Verifikasi Donasi (Valid)</span>
                    </button>
                </form>

                <!-- Form Tolak Donasi (Merah Bahaya #DC2626) -->
                <form method="POST" action="{{ route('admin.donations.reject', $donation) }}" class="space-y-2 pt-2">
                    @csrf
                    <label class="block text-xs font-semibold uppercase tracking-wider text-[#1E293B]">
                        Alasan Penolakan
                    </label>
                    <input type="text" 
                           name="reject_reason" 
                           required 
                           maxlength="500" 
                           placeholder="cth: Mutasi tidak ditemukan / bukti transfer tidak jelas" 
                           class="w-full px-4 py-2.5 bg-[#FFFBF5] border border-stone-200 rounded-xl text-xs text-[#1E293B] focus:outline-none focus:ring-2 focus:ring-red-400 focus:border-danger transition">
                    
                    <button type="submit" 
                            class="w-full bg-danger hover:bg-red-700 text-white font-semibold text-xs py-3 px-4 rounded-full transition">
                        Tolak Donasi
                    </button>
                </form>
            </div>
        @endif
    </div>
</div>
@endsection
