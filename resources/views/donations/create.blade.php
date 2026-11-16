@extends('layouts.app')
@section('title', 'Kirim Donasi — ' . $campaign->title)
@section('content')
<div class="max-w-xl mx-auto my-6">
    <div class="bg-white rounded-3xl shadow-sm border border-stone-200/80 p-7 sm:p-8">
        <div class="mb-6 pb-4 border-b border-stone-100">
            <span class="inline-block px-3 py-0.5 rounded-full text-[11px] font-bold tracking-wider uppercase bg-orange-50 text-brand-600 mb-2">
                {{ $campaign->category }}
            </span>
            <h1 class="font-serif text-2xl sm:text-3xl font-bold text-[#1E293B]">Formulir Donasi</h1>
            <p class="text-xs sm:text-sm text-[#64748B] mt-1 line-clamp-1">Untuk kampanye: <strong>{{ $campaign->title }}</strong></p>
            <p class="text-xs text-amber-700 bg-amber-50 p-2.5 rounded-xl border border-amber-200 mt-3">
                Donasi diproses melalui transfer manual. Dana tercatat resmi setelah diverifikasi oleh tim admin.
            </p>
        </div>

        <form method="POST" action="{{ route('donations.store') }}" enctype="multipart/form-data" class="space-y-4">
            @csrf
            <input type="hidden" name="campaign_id" value="{{ $campaign->id }}">

            <div>
                <label class="block text-xs font-semibold uppercase tracking-wider text-[#1E293B] mb-1.5">Nominal Donasi (Rp, minimal 1.000)</label>
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 pl-4 flex items-center font-bold text-stone-400 text-sm">Rp</span>
                    <input type="number" 
                           name="amount" 
                           min="1000" 
                           step="1000" 
                           required 
                           placeholder="50000"
                           class="w-full pl-12 pr-4 py-3 bg-[#FFFBF5] border border-stone-200 rounded-xl text-sm font-semibold text-[#1E293B] focus:outline-none focus:ring-2 focus:ring-brand-500/40 focus:border-brand-500 transition">
                </div>
            </div>

            <div>
                <label class="block text-xs font-semibold uppercase tracking-wider text-[#1E293B] mb-1.5">Metode Transfer Manual</label>
                <select name="method" required class="w-full px-4 py-3 bg-[#FFFBF5] border border-stone-200 rounded-xl text-sm text-[#1E293B] focus:outline-none focus:ring-2 focus:ring-brand-500/40 focus:border-brand-500 transition cursor-pointer">
                    @foreach(\App\Models\Donation::METHODS as $m)
                        <option value="{{ $m }}">{{ $m }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block text-xs font-semibold uppercase tracking-wider text-[#1E293B] mb-1.5">Doa / Pesan Kebaikan (opsional)</label>
                <textarea name="message" 
                          maxlength="500" 
                          rows="3" 
                          placeholder="Tuliskan harapan atau doa baik Anda..."
                          class="w-full px-4 py-3 bg-[#FFFBF5] border border-stone-200 rounded-xl text-sm text-[#1E293B] focus:outline-none focus:ring-2 focus:ring-brand-500/40 focus:border-brand-500 transition"></textarea>
            </div>

            <div class="p-3 bg-[#FFFBF5] rounded-xl border border-stone-200/60">
                <label class="text-xs font-medium text-[#1E293B] flex items-center gap-2.5 cursor-pointer">
                    <input type="checkbox" name="is_anonymous" value="1" class="rounded border-stone-300 text-brand-500 focus:ring-brand-500">
                    <span>Donasi sebagai anonim (nama Anda akan tampil sebagai "Hamba Allah")</span>
                </label>
            </div>

            <div>
                <label class="block text-xs font-semibold uppercase tracking-wider text-[#1E293B] mb-1.5">Bukti Transfer (opsional saat ini, gambar/PDF maks 2 MB)</label>
                <input type="file" 
                       name="proof_file" 
                       accept=".jpg,.jpeg,.png,.webp,.pdf" 
                       class="w-full px-4 py-2.5 bg-[#FFFBF5] border border-stone-200 rounded-xl text-xs text-[#1E293B] focus:outline-none focus:ring-2 focus:ring-brand-500/40 focus:border-brand-500 transition file:mr-4 file:py-1 file:px-3 file:rounded-full file:border-0 file:text-xs file:font-semibold file:bg-orange-50 file:text-brand-600 hover:file:bg-orange-100">
            </div>

            <!-- Tombol Kirim Donasi Oranye #F97316 -->
            <button type="submit" 
                    class="w-full mt-4 bg-brand-500 hover:bg-brand-600 text-white font-bold py-3.5 px-4 rounded-full shadow-md shadow-brand-500/25 hover:shadow-orange-glow transition flex items-center justify-center gap-2">
                <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z" clip-rule="evenodd"/></svg>
                <span>Kirim Donasi</span>
            </button>
        </form>
    </div>
</div>
@endsection
