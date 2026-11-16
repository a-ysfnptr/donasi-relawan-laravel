@extends('layouts.app')
@section('title', 'Masuk Akun')
@section('content')

<div class="max-w-5xl mx-auto my-4 sm:my-8">
    <!-- Kartu Dua Kolom Inspirasi Referensi Volunteer -->
    <div class="bg-white rounded-3xl sm:rounded-[36px] shadow-soft-xl border border-stone-200/80 overflow-hidden grid grid-cols-1 lg:grid-cols-12 items-stretch">
        
        <!-- =========================================================================
             SISI KIRI: Ilustrasi Warna-Warni Ceria (Hands & Speech Bubbles)
             ========================================================================= -->
        <div class="lg:col-span-5 bg-gradient-to-br from-amber-50/40 via-white to-emerald-50/30 p-8 sm:p-10 relative overflow-hidden flex flex-col justify-between border-b lg:border-b-0 lg:border-r border-stone-100 min-h-[340px] lg:min-h-[580px]">
            
            <!-- Elemen SVG Tangan Warna-Warni (Pink, Hijau Teal, Oranye, Kuning) -->
            <div class="absolute inset-0 pointer-events-none opacity-90">
                <!-- Tangan Pink Kiri Atas -->
                <svg class="absolute -top-4 -left-4 w-32 h-32 text-rose-500/80 transform rotate-45" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M12 2a1.5 1.5 0 00-1.5 1.5v7h-1v-6a1.5 1.5 0 00-3 0v7h-1v-4.5a1.5 1.5 0 00-3 0v9.5a7.5 7.5 0 0015 0v-8a1.5 1.5 0 00-3 0v5h-1v-9a1.5 1.5 0 00-1.5-1.5z"/>
                </svg>

                <!-- Tangan Hijau Teal Atas Tengah -->
                <svg class="absolute top-2 left-28 w-36 h-36 text-emerald-500/85 transform -rotate-12" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M12 2a1.5 1.5 0 00-1.5 1.5v7h-1v-6a1.5 1.5 0 00-3 0v7h-1v-4.5a1.5 1.5 0 00-3 0v9.5a7.5 7.5 0 0015 0v-8a1.5 1.5 0 00-3 0v5h-1v-9a1.5 1.5 0 00-1.5-1.5z"/>
                </svg>

                <!-- Tangan Kuning Ceria Kanan Atas -->
                <svg class="absolute top-8 right-2 w-28 h-28 text-amber-400/90 transform rotate-12" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M12 2a1.5 1.5 0 00-1.5 1.5v7h-1v-6a1.5 1.5 0 00-3 0v7h-1v-4.5a1.5 1.5 0 00-3 0v9.5a7.5 7.5 0 0015 0v-8a1.5 1.5 0 00-3 0v5h-1v-9a1.5 1.5 0 00-1.5-1.5z"/>
                </svg>

                <!-- Tangan Oranye Cerah Kiri Tengah -->
                <svg class="absolute top-44 -left-6 w-32 h-32 text-brand-500/80 transform rotate-90" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M12 2a1.5 1.5 0 00-1.5 1.5v7h-1v-6a1.5 1.5 0 00-3 0v7h-1v-4.5a1.5 1.5 0 00-3 0v9.5a7.5 7.5 0 0015 0v-8a1.5 1.5 0 00-3 0v5h-1v-9a1.5 1.5 0 00-1.5-1.5z"/>
                </svg>

                <!-- Tangan Teal Bawah -->
                <svg class="absolute bottom-16 -left-4 w-36 h-36 text-teal-500/85 transform rotate-25" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M12 2a1.5 1.5 0 00-1.5 1.5v7h-1v-6a1.5 1.5 0 00-3 0v7h-1v-4.5a1.5 1.5 0 00-3 0v9.5a7.5 7.5 0 0015 0v-8a1.5 1.5 0 00-3 0v5h-1v-9a1.5 1.5 0 00-1.5-1.5z"/>
                </svg>

                <!-- Tangan Pink Magenta Bawah Kanan -->
                <svg class="absolute -bottom-6 right-6 w-44 h-44 text-pink-500/80 transform -rotate-45" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M12 2a1.5 1.5 0 00-1.5 1.5v7h-1v-6a1.5 1.5 0 00-3 0v7h-1v-4.5a1.5 1.5 0 00-3 0v9.5a7.5 7.5 0 0015 0v-8a1.5 1.5 0 00-3 0v5h-1v-9a1.5 1.5 0 00-1.5-1.5z"/>
                </svg>
            </div>

            <!-- Floating Card: VOLUNTEERING IS AWESOME! (Sesuai Referensi Gambar) -->
            <div class="relative z-10 self-start mt-6 bg-white/95 backdrop-blur-sm border-2 border-dark text-dark px-6 py-4 rounded-3xl shadow-md max-w-xs transform -rotate-2 hover:rotate-0 transition-transform">
                <p class="font-black text-lg sm:text-xl tracking-tight uppercase leading-snug">
                    VOLUNTEERING<br/>IS AWESOME!
                </p>
            </div>

            <!-- Speech Chat Bubbles Inspiratif -->
            <div class="relative z-10 space-y-3 mt-16 lg:mt-auto mb-4">
                <!-- Chat Bubble 1 (Biru seperti gambar referensi) -->
                <div class="bg-[#2563EB] text-white p-3.5 px-4 rounded-2xl rounded-tr-none shadow-md text-xs sm:text-sm font-medium max-w-[260px] ml-auto relative">
                    <p>"Senang sekali bisa ikut aksi! Senyum anak-anak di posko sungguh menghangatkan hati."</p>
                </div>
                <!-- Chat Bubble 2 -->
                <div class="bg-[#0284C7] text-white p-3.5 px-4 rounded-2xl rounded-tl-none shadow-md text-xs sm:text-sm font-medium max-w-[240px] relative">
                    <p>"Pengalaman yang luar biasa! Mari buat lebih banyak aksi kebaikan."</p>
                </div>
            </div>

        </div>

        <!-- =========================================================================
             SISI KANAN: Formulir Masuk (Input Pill Rounded-Full & Tombol Hijau Besar)
             ========================================================================= -->
        <div class="lg:col-span-7 p-8 sm:p-12 lg:p-14 flex flex-col justify-center">
            
            <!-- Top Link Sign Up -->
            <div class="flex justify-end mb-6 text-xs sm:text-sm text-[#64748B]">
                <span>Belum punya akun?&nbsp;</span>
                <a href="{{ route('register') }}" class="font-bold text-[#1E293B] hover:text-brand-500 underline transition">
                    Daftar di sini
                </a>
            </div>

            <!-- Header Form dengan Ikon Kemanusiaan -->
            <div class="flex items-center justify-between gap-4 mb-8">
                <div>
                    <h1 class="font-serif text-2xl sm:text-3xl font-extrabold text-[#1E293B]">
                        Masuk ke Akun
                    </h1>
                    <p class="text-xs sm:text-sm text-[#64748B] mt-1">
                        Selamat datang kembali di platform donasi &amp; relawan.
                    </p>
                </div>
                <!-- Ikon Kerjasama Kemanusiaan (Sesuai Referensi) -->
                <div class="w-14 h-14 rounded-full bg-emerald-50 text-emerald-600 flex items-center justify-center shrink-0 shadow-sm border border-emerald-150">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                    </svg>
                </div>
            </div>

            <!-- Form Masuk -->
            <form method="POST" action="{{ route('login') }}" class="space-y-5">
                @csrf

                <!-- Input Email Pill (Rounded-Full) -->
                <div>
                    <input type="email" 
                           name="email" 
                           value="{{ old('email') }}" 
                           required 
                           placeholder="Alamat Email" 
                           class="w-full px-6 py-4 bg-white border border-stone-300 rounded-full text-sm text-[#1E293B] placeholder-stone-400 focus:outline-none focus:ring-2 focus:ring-emerald-400 focus:border-emerald-500 transition shadow-sm">
                </div>

                <!-- Input Password Pill (Rounded-Full) -->
                <div>
                    <input type="password" 
                           name="password" 
                           required 
                           placeholder="Kata Sandi" 
                           class="w-full px-6 py-4 bg-white border border-stone-300 rounded-full text-sm text-[#1E293B] placeholder-stone-400 focus:outline-none focus:ring-2 focus:ring-emerald-400 focus:border-emerald-500 transition shadow-sm">
                </div>

                <!-- Checkbox Ingat Saya -->
                <div class="flex items-center justify-between text-xs px-2 pt-1">
                    <label class="flex items-center gap-2.5 cursor-pointer text-[#64748B]">
                        <input type="checkbox" name="remember" class="w-4 h-4 rounded border-stone-300 text-emerald-600 focus:ring-emerald-500">
                        <span>Ingat saya di perangkat ini</span>
                    </label>
                </div>

                <!-- Tombol Hijau Besar (Sesuai Referensi Gambar) -->
                <div class="pt-2">
                    <button type="submit" 
                            class="w-full bg-[#4ADE80] hover:bg-[#22C55E] text-[#064E3B] font-bold text-base py-4 px-6 rounded-full shadow-sm hover:shadow-md transition-all duration-200 text-center flex items-center justify-center gap-2">
                        <span>Masuk</span>
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                    </button>
                </div>
            </form>

        </div>

    </div>
</div>

@endsection
