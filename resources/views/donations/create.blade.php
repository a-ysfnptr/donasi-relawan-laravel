@extends('layouts.app')
@section('title', 'Donasi — ' . $campaign->title)
@section('content')
<div class="max-w-lg mx-auto bg-white rounded shadow p-6">
    <h1 class="text-xl font-bold">Donasi: {{ $campaign->title }}</h1>
    <p class="text-sm text-slate-500 mt-1">Donasi via transfer manual. Donasi baru tercatat setelah diverifikasi admin.</p>
    <div class="bg-slate-100 rounded p-4 text-sm mt-4">
        <p class="font-semibold">Rekening tujuan (contoh untuk demo):</p>
        <p>BCA: 1234567890 a.n. Donasi &amp; Relawan Komunitas</p>
        <p>BRI: 1234567890123 a.n. Donasi &amp; Relawan Komunitas</p>
        <p>DANA / GoPay / OVO: 081234567890 a.n. Donasi &amp; Relawan Komunitas</p>
        <p class="text-slate-500 mt-1">Untuk keperluan tugas, transfer bersifat simulasi. Unggah bukti transfer contoh, lalu admin memverifikasi.</p>
    </div>
    <form method="POST" action="{{ route('donations.store') }}" enctype="multipart/form-data" class="space-y-4 mt-4">
        @csrf
        <input type="hidden" name="campaign_id" value="{{ $campaign->id }}">
        <div><label class="block text-sm font-medium">Nominal (Rp, minimal 1.000)</label>
            <input type="number" name="amount" min="1000" step="1000" required class="w-full border rounded px-3 py-2"></div>
        <div><label class="block text-sm font-medium">Metode Transfer</label>
            <select name="method" required class="w-full border rounded px-3 py-2">
                @foreach(\App\Models\Donation::METHODS as $m)<option value="{{ $m }}">{{ $m }}</option>@endforeach
            </select></div>
        <div><label class="block text-sm font-medium">Pesan (opsional)</label>
            <textarea name="message" maxlength="500" class="w-full border rounded px-3 py-2"></textarea></div>
        <label class="text-sm flex gap-2 items-center"><input type="checkbox" name="is_anonymous" value="1"> Donasi sebagai anonim (nama tampil "Hamba Allah")</label>
        <div><label class="block text-sm font-medium">Bukti Transfer (opsional, gambar/PDF maks 2 MB)</label>
            <input type="file" name="proof_file" accept=".jpg,.jpeg,.png,.webp,.pdf" class="w-full border rounded px-3 py-2"></div>
        <button class="w-full bg-emerald-600 text-white py-2 rounded">Kirim Donasi</button>
    </form>
</div>
@endsection
