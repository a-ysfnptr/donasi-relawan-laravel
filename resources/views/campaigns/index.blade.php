@extends('layouts.app')
@section('title', 'Daftar Kampanye Donasi & Relawan')
@section('content')

<!-- Header Banner Halaman Kampanye -->
<div class="relative bg-gradient-to-br from-[#111827] via-stone-900 to-[#111827] text-white rounded-3xl p-8 sm:p-12 mb-10 overflow-hidden shadow-soft-xl">
    <div class="absolute -right-10 -bottom-10 w-72 h-72 rounded-full bg-brand-500/10 blur-3xl pointer-events-none"></div>
    <div class="relative z-10 max-w-2xl">
        <span class="inline-block px-3.5 py-1 rounded-full text-xs font-bold tracking-widest uppercase bg-brand-500/20 text-amber-300 border border-brand-500/30 mb-4">
            Gerakan Solidaritas Sesama
        </span>
        <h1 class="font-serif text-3xl sm:text-4xl lg:text-5xl font-extrabold text-white leading-tight">
            Jelajahi Semua Kampanye Kebaikan
        </h1>
        <p class="mt-3 text-stone-300 text-sm sm:text-base leading-relaxed">
            Pilih dan salurkan donasi terbaik Anda. Setiap kampanye telah diverifikasi oleh tim admin, dan rincian penyaluran dana dapat dipantau langsung secara terbuka.
        </p>
    </div>
</div>

<!-- Search & Filter Bar -->
<div class="bg-white rounded-3xl shadow-soft border border-stone-200/80 p-5 sm:p-6 mb-10">
    <form method="GET" action="{{ route('campaigns.index') }}" class="flex flex-col sm:flex-row items-center gap-3">
        <!-- Input Search -->
        <div class="relative flex-1 w-full">
            <span class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-stone-400">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
            </span>
            <input type="text" 
                   name="q" 
                   value="{{ request('q') }}" 
                   placeholder="Cari berdasarkan judul atau deskripsi kampanye..." 
                   class="w-full pl-11 pr-4 py-3 bg-[#FFFBF5] border border-stone-200 rounded-2xl text-sm text-[#1E293B] focus:outline-none focus:ring-2 focus:ring-brand-500/40 focus:border-brand-500 transition">
        </div>

        <!-- Dropdown Kategori -->
        <div class="w-full sm:w-64">
            <select name="category" 
                    class="w-full py-3 px-4 bg-[#FFFBF5] border border-stone-200 rounded-2xl text-sm text-[#1E293B] focus:outline-none focus:ring-2 focus:ring-brand-500/40 focus:border-brand-500 transition cursor-pointer">
                <option value="">Semua Kategori</option>
                @foreach(['bencana','pendidikan','kesehatan','sosial','lingkungan','lainnya'] as $c)
                    <option value="{{ $c }}" @selected(request('category') === $c)>{{ ucfirst($c) }}</option>
                @endforeach
            </select>
        </div>

        <!-- Tombol Cari Oranye #F97316 -->
        <button type="submit" 
                class="w-full sm:w-auto inline-flex items-center justify-center gap-2 bg-brand-500 hover:bg-brand-600 text-white font-semibold text-sm px-7 py-3 rounded-2xl shadow-sm hover:shadow-orange-glow transition">
            <span>Cari</span>
        </button>

        @if(request('q') || request('category'))
            <a href="{{ route('campaigns.index') }}" class="text-xs text-[#64748B] hover:text-danger underline py-2 px-1">
                Reset
            </a>
        @endif
    </form>

    <!-- Quick Pill Badges untuk filter kategori cepat -->
    <div class="mt-4 pt-4 border-t border-stone-100 flex items-center gap-2 overflow-x-auto pb-1 text-xs">
        <span class="text-[#64748B] font-medium whitespace-nowrap">Filter Cepat:</span>
        <a href="{{ route('campaigns.index') }}" 
           class="px-3 py-1 rounded-full whitespace-nowrap transition {{ !request('category') ? 'bg-brand-500 text-white font-bold' : 'bg-stone-100 text-[#64748B] hover:bg-stone-200' }}">
            Semua
        </a>
        @foreach(['bencana','pendidikan','kesehatan','sosial','lingkungan','lainnya'] as $cat)
            <a href="{{ route('campaigns.index', array_merge(request()->query(), ['category' => $cat])) }}" 
               class="px-3 py-1 rounded-full whitespace-nowrap transition {{ request('category') === $cat ? 'bg-brand-500 text-white font-bold' : 'bg-stone-100 text-[#64748B] hover:bg-stone-200' }}">
                {{ ucfirst($cat) }}
            </a>
        @endforeach
    </div>
</div>

<!-- Grid 3 Kolom Kartu Kampanye -->
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
    @forelse($campaigns as $campaign)
        @include('partials.campaign-card', ['campaign' => $campaign])
    @empty
        <div class="col-span-full bg-white rounded-3xl border border-dashed border-stone-300 p-14 text-center">
            <div class="w-16 h-16 rounded-full bg-orange-50 text-brand-500 mx-auto flex items-center justify-center mb-4">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            </div>
            <h3 class="font-serif font-bold text-xl text-[#1E293B] mb-2">Tidak Ada Kampanye yang Cocok</h3>
            <p class="text-sm text-[#64748B] max-w-md mx-auto mb-6">
                Silakan coba gunakan kata kunci pencarian yang berbeda atau pilih kategori lain.
            </p>
            <a href="{{ route('campaigns.index') }}" class="inline-flex items-center gap-2 bg-brand-500 hover:bg-brand-600 text-white text-sm font-semibold px-5 py-2.5 rounded-full shadow-sm hover:shadow-orange-glow transition">
                Tampilkan Semua Kampanye
            </a>
        </div>
    @endforelse
</div>

<!-- Pagination -->
<div class="mt-12 flex justify-center">
    {{ $campaigns->links() }}
</div>

@endsection
