@extends('layouts.app')
@section('title', 'Terjadi Kesalahan')
@section('content')
<div class="max-w-md mx-auto my-12">
    <div class="bg-white rounded-3xl shadow-sm border border-stone-200/80 p-8 text-center">
        <div class="w-16 h-16 rounded-full bg-orange-50 text-brand-500 mx-auto flex items-center justify-center mb-4">
            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
        </div>
        <h1 class="font-serif text-4xl font-extrabold text-[#1E293B]">{{ $code ?? 500 }}</h1>
        <p class="mt-2 text-sm text-[#64748B]">{{ $message ?? 'Terjadi kesalahan pada sistem. Silakan coba beberapa saat lagi.' }}</p>
        
        <!-- Tombol Oranye #F97316 -->
        <a href="{{ route('home') }}" 
           class="inline-flex items-center gap-2 mt-6 bg-brand-500 hover:bg-brand-600 text-white font-bold text-sm px-6 py-3 rounded-full shadow-sm hover:shadow-orange-glow transition">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
            <span>Kembali ke Beranda</span>
        </a>
    </div>
</div>
@endsection
