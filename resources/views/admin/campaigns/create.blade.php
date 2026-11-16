@extends('layouts.app')
@section('title', 'Kampanye Baru')
@section('content')
<div class="max-w-xl mx-auto my-6">
    <div class="bg-white rounded-3xl shadow-sm border border-stone-200/80 p-7 sm:p-8">
        <div class="flex items-center justify-between pb-4 mb-6 border-b border-stone-100">
            <div>
                <h1 class="font-serif text-2xl font-bold text-[#1E293B]">Buat Kampanye Baru</h1>
                <p class="text-xs text-[#64748B] mt-0.5">Inisialisasi penggalangan dana kemanusiaan resmi</p>
            </div>
            <a href="{{ route('admin.campaigns.index') }}" class="text-xs font-semibold text-brand-500 hover:underline">
                &larr; Batal
            </a>
        </div>

        <form method="POST" action="{{ route('admin.campaigns.store') }}" enctype="multipart/form-data">
            @csrf 
            @include('admin.campaigns._form')
            
            <!-- Tombol Simpan Oranye #F97316 -->
            <button type="submit" 
                    class="w-full mt-6 bg-brand-500 hover:bg-brand-600 text-white font-bold py-3.5 rounded-full shadow-md shadow-brand-500/25 hover:shadow-orange-glow transition">
                Simpan Kampanye
            </button>
        </form>
    </div>
</div>
@endsection
