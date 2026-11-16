@extends('layouts.app')
@section('title', 'Profil Saya')
@section('content')
<div class="max-w-xl mx-auto space-y-8 my-6">
    
    <!-- Kartu Informasi Profil -->
    <div class="bg-white rounded-3xl shadow-sm border border-stone-200/80 p-7 sm:p-8">
        <div class="flex items-center gap-3 mb-6 pb-4 border-b border-stone-100">
            <div class="w-10 h-10 rounded-2xl bg-orange-50 text-brand-500 flex items-center justify-center">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
            </div>
            <div>
                <h1 class="font-bold text-xl text-[#1E293B]">Profil Pengguna</h1>
                <p class="text-xs text-[#64748B]">Perbarui informasi kontak dan data akun Anda</p>
            </div>
        </div>

        <form method="POST" action="{{ route('profile.update') }}" class="space-y-4">
            @csrf @method('PATCH')
            <div>
                <label class="block text-xs font-semibold uppercase tracking-wider text-[#1E293B] mb-1.5">Nama Lengkap</label>
                <input type="text" 
                       name="name" 
                       value="{{ old('name', $user->name) }}" 
                       required 
                       maxlength="100" 
                       class="w-full px-4 py-3 bg-[#FFFBF5] border border-stone-200 rounded-xl text-sm text-[#1E293B] focus:outline-none focus:ring-2 focus:ring-brand-500/40 focus:border-brand-500 transition">
            </div>

            <div>
                <label class="block text-xs font-semibold uppercase tracking-wider text-[#1E293B] mb-1.5">Alamat Email (Akun)</label>
                <input type="email" 
                       value="{{ $user->email }}" 
                       disabled 
                       class="w-full px-4 py-3 bg-stone-100 border border-stone-200 rounded-xl text-sm text-stone-500 cursor-not-allowed">
                <p class="text-[11px] text-[#64748B] mt-1">Email digunakan untuk verifikasi login dan tidak dapat diubah sembarangan.</p>
            </div>

            <div>
                <label class="block text-xs font-semibold uppercase tracking-wider text-[#1E293B] mb-1.5">No. HP</label>
                <input type="text" 
                       name="phone" 
                       value="{{ old('phone', $user->phone) }}" 
                       maxlength="20" 
                       class="w-full px-4 py-3 bg-[#FFFBF5] border border-stone-200 rounded-xl text-sm text-[#1E293B] focus:outline-none focus:ring-2 focus:ring-brand-500/40 focus:border-brand-500 transition">
            </div>

            <!-- Tombol Simpan Profil Oranye #F97316 -->
            <button type="submit" 
                    class="inline-flex items-center gap-2 bg-brand-500 hover:bg-brand-600 text-white font-bold text-sm px-6 py-3 rounded-full shadow-sm hover:shadow-orange-glow transition">
                <span>Simpan Profil</span>
            </button>
        </form>
    </div>

    <!-- Kartu Ganti Kata Sandi -->
    <div class="bg-white rounded-3xl shadow-sm border border-stone-200/80 p-7 sm:p-8">
        <div class="flex items-center gap-3 mb-6 pb-4 border-b border-stone-100">
            <div class="w-10 h-10 rounded-2xl bg-stone-100 text-[#1E293B] flex items-center justify-center">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>
            </div>
            <div>
                <h2 class="font-bold text-xl text-[#1E293B]">Ganti Kata Sandi</h2>
                <p class="text-xs text-[#64748B]">Pastikan akun Anda terlindungi dengan sandi yang kuat</p>
            </div>
        </div>

        <form method="POST" action="{{ route('profile.password') }}" class="space-y-4">
            @csrf @method('PATCH')
            <div>
                <label class="block text-xs font-semibold uppercase tracking-wider text-[#1E293B] mb-1.5">Kata Sandi Saat Ini</label>
                <input type="password" 
                       name="current_password" 
                       required 
                       placeholder="••••••••" 
                       class="w-full px-4 py-3 bg-[#FFFBF5] border border-stone-200 rounded-xl text-sm text-[#1E293B] focus:outline-none focus:ring-2 focus:ring-brand-500/40 focus:border-brand-500 transition">
            </div>

            <div>
                <label class="block text-xs font-semibold uppercase tracking-wider text-[#1E293B] mb-1.5">Kata Sandi Baru (min. 8 karakter, kombinasi)</label>
                <input type="password" 
                       name="password" 
                       required 
                       placeholder="••••••••" 
                       class="w-full px-4 py-3 bg-[#FFFBF5] border border-stone-200 rounded-xl text-sm text-[#1E293B] focus:outline-none focus:ring-2 focus:ring-brand-500/40 focus:border-brand-500 transition">
            </div>

            <div>
                <label class="block text-xs font-semibold uppercase tracking-wider text-[#1E293B] mb-1.5">Konfirmasi Kata Sandi Baru</label>
                <input type="password" 
                       name="password_confirmation" 
                       required 
                       placeholder="••••••••" 
                       class="w-full px-4 py-3 bg-[#FFFBF5] border border-stone-200 rounded-xl text-sm text-[#1E293B] focus:outline-none focus:ring-2 focus:ring-brand-500/40 focus:border-brand-500 transition">
            </div>

            <!-- Tombol Ubah Kata Sandi Oranye #F97316 -->
            <button type="submit" 
                    class="inline-flex items-center gap-2 bg-[#111827] hover:bg-stone-800 text-white font-bold text-sm px-6 py-3 rounded-full shadow-sm transition">
                <span>Ubah Kata Sandi</span>
            </button>
        </form>
    </div>

</div>
@endsection
