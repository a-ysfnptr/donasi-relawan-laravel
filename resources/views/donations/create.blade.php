@extends('layouts.app')
@section('title', 'Donasi — ' . $campaign->title)
@section('content')

<div class="max-w-2xl mx-auto my-4 sm:my-8 px-2 sm:px-4">
    <!-- Kartu Formulir Donasi Bernuansa Krem & Putih Bersih -->
    <div class="bg-white rounded-3xl sm:rounded-[36px] shadow-soft-xl border border-stone-200/80 p-6 sm:p-10">
        
        <!-- Tombol Navigasi Kembali -->
        <a href="{{ route('campaigns.show', $campaign->id) }}" class="inline-flex items-center gap-1.5 text-xs font-semibold text-[#64748B] hover:text-brand-500 transition mb-6 group">
            <svg class="w-4 h-4 transform group-hover:-translate-x-0.5 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
            </svg>
            <span>Kembali ke Detail Kampanye</span>
        </a>

        <!-- Header Donasi -->
        <div class="mb-6">
            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-[11px] font-bold uppercase tracking-wider bg-orange-50 text-brand-600 border border-orange-200/60 mb-2.5">
                <svg class="w-3.5 h-3.5 text-brand-500" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z" clip-rule="evenodd"/>
                </svg>
                Penyaluran Kebaikan
            </span>
            <h1 class="font-serif text-2xl sm:text-3xl font-extrabold text-[#1E293B]">
                Berdonasi untuk Sesama
            </h1>
            <p class="text-xs sm:text-sm text-[#64748B] mt-1.5">
                Untuk kampanye: <strong class="text-[#1E293B]">{{ $campaign->title }}</strong>
            </p>
        </div>

        <!-- =========================================================================
             KOTAK INFO REKENING TUJUAN (SESUAI INSTRUKSI)
             ========================================================================= -->
        <div class="bg-amber-50/50 border border-amber-200/80 rounded-2xl sm:rounded-3xl p-5 sm:p-6 mb-7">
            <div class="flex items-start gap-3 mb-3">
                <div class="w-9 h-9 rounded-xl bg-brand-500/10 text-brand-600 flex items-center justify-center shrink-0 mt-0.5">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"/>
                    </svg>
                </div>
                <div>
                    <h2 class="text-sm font-bold text-[#1E293B]">
                        Rekening tujuan (contoh untuk demo):
                    </h2>
                    <p class="text-xs text-[#64748B] mt-0.5">
                        Donasi via transfer manual. Donasi baru tercatat resmi setelah diverifikasi admin.
                    </p>
                </div>
            </div>

            <!-- Daftar Nomor Rekening / E-Wallet -->
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-2.5 mt-3">
                <!-- Kartu BCA -->
                <div class="bg-white p-3 rounded-xl border border-stone-200/80 shadow-xs flex flex-col justify-between">
                    <div class="flex items-center justify-between">
                        <span class="text-[11px] font-extrabold text-blue-700 bg-blue-50 px-2 py-0.5 rounded">BCA</span>
                        <button type="button" onclick="navigator.clipboard.writeText('1234567890'); alert('Nomor rekening BCA disalin!');" class="text-[10px] text-stone-400 hover:text-brand-600 font-semibold">Salin</button>
                    </div>
                    <p class="font-mono font-bold text-sm text-[#1E293B] mt-2 tracking-wide">1234567890</p>
                </div>

                <!-- Kartu BRI -->
                <div class="bg-white p-3 rounded-xl border border-stone-200/80 shadow-xs flex flex-col justify-between">
                    <div class="flex items-center justify-between">
                        <span class="text-[11px] font-extrabold text-blue-900 bg-blue-50 px-2 py-0.5 rounded">BRI</span>
                        <button type="button" onclick="navigator.clipboard.writeText('1234567890123'); alert('Nomor rekening BRI disalin!');" class="text-[10px] text-stone-400 hover:text-brand-600 font-semibold">Salin</button>
                    </div>
                    <p class="font-mono font-bold text-sm text-[#1E293B] mt-2 tracking-wide">1234567890123</p>
                </div>

                <!-- Kartu E-Wallet -->
                <div class="bg-white p-3 rounded-xl border border-stone-200/80 shadow-xs flex flex-col justify-between">
                    <div class="flex items-center justify-between">
                        <span class="text-[11px] font-extrabold text-emerald-700 bg-emerald-50 px-2 py-0.5 rounded">DANA/GoPay/OVO</span>
                        <button type="button" onclick="navigator.clipboard.writeText('081234567890'); alert('Nomor E-Wallet disalin!');" class="text-[10px] text-stone-400 hover:text-brand-600 font-semibold">Salin</button>
                    </div>
                    <p class="font-mono font-bold text-sm text-[#1E293B] mt-2 tracking-wide">081234567890</p>
                </div>
            </div>

            <!-- Pemilik Rekening & Catatan Simulasi -->
            <div class="mt-3.5 pt-3 border-t border-amber-200/60 flex flex-col sm:flex-row sm:items-center justify-between gap-1 text-xs text-[#64748B]">
                <p>
                    Atas Nama: <strong class="text-[#1E293B]">a.n. Donasi &amp; Relawan Komunitas</strong>
                </p>
                <p class="text-stone-500 italic">
                    Untuk keperluan tugas, transfer bersifat simulasi.
                </p>
            </div>
        </div>

        <!-- =========================================================================
             FORMULIR DONASI
             ========================================================================= -->
        <form method="POST" action="{{ route('donations.store') }}" enctype="multipart/form-data" class="space-y-5">
            @csrf
            <input type="hidden" name="campaign_id" value="{{ $campaign->id }}">

            <!-- Input Nominal Donasi -->
            <div>
                <label for="amount" class="block text-xs font-bold uppercase tracking-wider text-[#1E293B] mb-2">
                    Nominal Donasi (Rp, minimal 1.000) <span class="text-brand-500">*</span>
                </label>
                
                <div class="relative">
                    <span class="absolute left-4 top-1/2 -translate-y-1/2 font-bold text-sm text-stone-400 pointer-events-none">
                        Rp
                    </span>
                    <input type="number" 
                           id="amount" 
                           name="amount" 
                           min="1000" 
                           step="1000" 
                           required 
                           value="{{ old('amount') }}" 
                           placeholder="50000" 
                           class="w-full pl-12 pr-4 py-3.5 bg-[#FFFBF5] border border-stone-200 rounded-2xl text-base font-semibold text-[#1E293B] placeholder-stone-400 focus:outline-none focus:ring-2 focus:ring-brand-500/40 focus:border-brand-500 transition shadow-xs">
                </div>

                <!-- Pilihan Cepat Nominal -->
                <div class="flex flex-wrap items-center gap-2 mt-2.5">
                    <span class="text-[11px] font-semibold text-[#64748B] mr-1">Pilih Cepat:</span>
                    <button type="button" onclick="document.getElementById('amount').value = 10000" class="text-xs font-semibold px-3 py-1 bg-stone-100 hover:bg-orange-50 hover:text-brand-600 rounded-full text-stone-700 border border-stone-200/60 transition">
                        10.000
                    </button>
                    <button type="button" onclick="document.getElementById('amount').value = 25000" class="text-xs font-semibold px-3 py-1 bg-stone-100 hover:bg-orange-50 hover:text-brand-600 rounded-full text-stone-700 border border-stone-200/60 transition">
                        25.000
                    </button>
                    <button type="button" onclick="document.getElementById('amount').value = 50000" class="text-xs font-semibold px-3 py-1 bg-stone-100 hover:bg-orange-50 hover:text-brand-600 rounded-full text-stone-700 border border-stone-200/60 transition">
                        50.000
                    </button>
                    <button type="button" onclick="document.getElementById('amount').value = 100000" class="text-xs font-semibold px-3 py-1 bg-stone-100 hover:bg-orange-50 hover:text-brand-600 rounded-full text-stone-700 border border-stone-200/60 transition">
                        100.000
                    </button>
                    <button type="button" onclick="document.getElementById('amount').value = 250000" class="text-xs font-semibold px-3 py-1 bg-stone-100 hover:bg-orange-50 hover:text-brand-600 rounded-full text-stone-700 border border-stone-200/60 transition">
                        250.000
                    </button>
                </div>
            </div>

            <!-- Input Metode Transfer -->
            <div>
                <label for="method" class="block text-xs font-bold uppercase tracking-wider text-[#1E293B] mb-2">
                    Metode Transfer <span class="text-brand-500">*</span>
                </label>
                <div class="relative">
                    <select id="method" 
                            name="method" 
                            required 
                            class="w-full px-4 py-3.5 bg-[#FFFBF5] border border-stone-200 rounded-2xl text-sm font-medium text-[#1E293B] appearance-none focus:outline-none focus:ring-2 focus:ring-brand-500/40 focus:border-brand-500 transition shadow-xs">
                        @foreach(\App\Models\Donation::METHODS as $m)
                            <option value="{{ $m }}" {{ old('method') == $m ? 'selected' : '' }}>
                                {{ $m }}
                            </option>
                        @endforeach
                    </select>
                    <div class="absolute right-4 top-1/2 -translate-y-1/2 pointer-events-none text-stone-400">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                    </div>
                </div>
            </div>

            <!-- Input Pesan / Doa Dukungan (Opsional) -->
            <div>
                <label for="message" class="block text-xs font-bold uppercase tracking-wider text-[#1E293B] mb-2">
                    Pesan atau Doa Dukungan (Opsional)
                </label>
                <textarea id="message" 
                          name="message" 
                          maxlength="500" 
                          rows="3" 
                          placeholder="Tuliskan doa atau kata-kata penyemangat untuk penerima manfaat..." 
                          class="w-full px-4 py-3.5 bg-[#FFFBF5] border border-stone-200 rounded-2xl text-sm text-[#1E293B] placeholder-stone-400 focus:outline-none focus:ring-2 focus:ring-brand-500/40 focus:border-brand-500 transition shadow-xs">{{ old('message') }}</textarea>
            </div>

            <!-- Checkbox Donasi Anonim -->
            <div class="p-3.5 bg-[#FFFBF5] border border-stone-200/80 rounded-2xl">
                <label class="flex items-start gap-3 cursor-pointer">
                    <input type="checkbox" 
                           name="is_anonymous" 
                           value="1" 
                           {{ old('is_anonymous') ? 'checked' : '' }} 
                           class="w-4 h-4 rounded border-stone-300 text-brand-500 focus:ring-brand-500 mt-0.5 shrink-0">
                    <div>
                        <span class="block text-xs font-bold text-[#1E293B]">
                            Donasi sebagai Anonim
                        </span>
                        <span class="block text-[11px] text-[#64748B] mt-0.5 leading-relaxed">
                            Nama Anda akan disamarkan sebagai <strong class="text-stone-700">"Hamba Allah"</strong> pada daftar donatur publik kampanye.
                        </span>
                    </div>
                </label>
            </div>

            <!-- Input Bukti Transfer -->
            <div>
                <label for="proof_file" class="block text-xs font-bold uppercase tracking-wider text-[#1E293B] mb-2">
                    Unggah Bukti Transfer (Opsional)
                </label>
                <div class="p-4 bg-[#FFFBF5] border border-dashed border-stone-300 rounded-2xl">
                    <input type="file" 
                           id="proof_file" 
                           name="proof_file" 
                           accept=".jpg,.jpeg,.png,.webp,.pdf" 
                           class="w-full text-xs text-[#64748B] file:mr-3 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-xs file:font-semibold file:bg-orange-100 file:text-brand-700 hover:file:bg-orange-200 transition">
                    <p class="text-[11px] text-stone-400 mt-2">
                        Format file: JPG, JPEG, PNG, WEBP, atau PDF (maksimal 2 MB). Dapat diunggah sekarang atau menyusul melalui riwayat donasi.
                    </p>
                </div>
            </div>

            <!-- Status Verifikasi Hijau Emerald #059669 -->
            <div class="flex items-center gap-2 p-3 bg-emerald-50 text-emerald-800 rounded-xl text-xs border border-emerald-100">
                <svg class="w-4 h-4 text-emerald-600 shrink-0" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                </svg>
                <span>Donasi akan diverifikasi oleh admin dengan status <strong class="text-emerald-700 font-bold">Terverifikasi</strong> setelah pengecekan transfer.</span>
            </div>

            <!-- Tombol Utama Oranye #F97316 (Hover #EA580C) -->
            <div class="pt-2">
                <button type="submit" 
                        class="w-full bg-brand-500 hover:bg-brand-600 text-white font-bold text-base py-4 px-6 rounded-full shadow-md shadow-brand-500/25 hover:shadow-orange-glow transition-all duration-200 flex items-center justify-center gap-2">
                    <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z" clip-rule="evenodd"/>
                    </svg>
                    <span>Kirim Donasi</span>
                </button>
            </div>
            
            <p class="text-center text-[11px] text-[#64748B] pt-1">
                Aman &amp; Terpercaya. Setiap donasi tercatat transparan dalam audit platform.
            </p>
        </form>

    </div>
</div>

@endsection
