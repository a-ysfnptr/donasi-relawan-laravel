@extends('layouts.app')
@section('title', 'Catat Penyaluran')
@section('content')
<div class="max-w-xl mx-auto my-6">
    <div class="bg-white rounded-3xl shadow-sm border border-stone-200/80 p-7 sm:p-8">
        <div class="flex items-center justify-between pb-4 mb-4 border-b border-stone-100">
            <div>
                <h1 class="font-serif text-2xl font-bold text-[#1E293B]">Catat Penyaluran Dana</h1>
                <p class="text-xs text-[#64748B] mt-0.5">Dokumentasi resmi distribusi bantuan ke penerima</p>
            </div>
            <a href="{{ route('admin.disbursements.index') }}" class="text-xs font-semibold text-brand-500 hover:underline">
                &larr; Batal
            </a>
        </div>

        <div class="p-3 bg-amber-50 rounded-xl border border-amber-200 text-xs text-amber-800 mb-6">
            Jumlah pengeluaran tidak boleh melebihi sisa saldo dana terverifikasi pada kampanye yang dipilih (Aturan BR-02).
        </div>

        <form method="POST" action="{{ route('admin.disbursements.store') }}" enctype="multipart/form-data" class="space-y-4">
            @csrf
            <div>
                <label class="block text-xs font-semibold uppercase tracking-wider text-[#1E293B] mb-1.5">Kampanye Sumber Dana</label>
                <select name="campaign_id" required 
                        class="w-full px-4 py-3 bg-[#FFFBF5] border border-stone-200 rounded-xl text-sm text-[#1E293B] focus:outline-none focus:ring-2 focus:ring-brand-500/40 focus:border-brand-500 transition cursor-pointer">
                    @foreach($campaigns as $c)
                        <option value="{{ $c->id }}">{{ $c->title }} — Sisa: Rp{{ number_format($c->remainingFunds(), 0, ',', '.') }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block text-xs font-semibold uppercase tracking-wider text-[#1E293B] mb-1.5">Jumlah Penyaluran (Rp)</label>
                <input type="number" name="amount" required min="1" placeholder="cth: 2500000"
                       class="w-full px-4 py-3 bg-[#FFFBF5] border border-stone-200 rounded-xl text-sm text-[#1E293B] focus:outline-none focus:ring-2 focus:ring-brand-500/40 focus:border-brand-500 transition">
            </div>

            <div>
                <label class="block text-xs font-semibold uppercase tracking-wider text-[#1E293B] mb-1.5">Penerima Manfaat / Rincian Kegiatan</label>
                <input type="text" name="recipient" required maxlength="200" placeholder="cth: Pembelian paket sembako untuk 50 KK"
                       class="w-full px-4 py-3 bg-[#FFFBF5] border border-stone-200 rounded-xl text-sm text-[#1E293B] focus:outline-none focus:ring-2 focus:ring-brand-500/40 focus:border-brand-500 transition">
            </div>

            <div>
                <label class="block text-xs font-semibold uppercase tracking-wider text-[#1E293B] mb-1.5">Tanggal Penyaluran</label>
                <input type="date" name="disbursed_at" required max="{{ now()->format('Y-m-d') }}"
                       class="w-full px-4 py-3 bg-[#FFFBF5] border border-stone-200 rounded-xl text-sm text-[#1E293B] focus:outline-none focus:ring-2 focus:ring-brand-500/40 focus:border-brand-500 transition">
            </div>

            <div>
                <label class="block text-xs font-semibold uppercase tracking-wider text-[#1E293B] mb-1.5">Keterangan / Berita Acara (opsional)</label>
                <textarea name="description" maxlength="1000" rows="3" placeholder="Catatan tambahan mengenai dokumentasi di lapangan..."
                          class="w-full px-4 py-3 bg-[#FFFBF5] border border-stone-200 rounded-xl text-sm text-[#1E293B] focus:outline-none focus:ring-2 focus:ring-brand-500/40 focus:border-brand-500 transition"></textarea>
            </div>

            <div>
                <label class="block text-xs font-semibold uppercase tracking-wider text-[#1E293B] mb-1.5">Bukti Penyaluran (opsional, kuitansi/foto/PDF maks 2 MB)</label>
                <input type="file" name="proof_file" accept=".jpg,.jpeg,.png,.webp,.pdf"
                       class="w-full px-4 py-2.5 bg-[#FFFBF5] border border-stone-200 rounded-xl text-xs text-[#1E293B] focus:outline-none focus:ring-2 focus:ring-brand-500/40 focus:border-brand-500 transition file:mr-4 file:py-1 file:px-3 file:rounded-full file:border-0 file:text-xs file:font-semibold file:bg-orange-50 file:text-brand-600 hover:file:bg-orange-100">
            </div>

            <!-- Tombol Simpan Penyaluran Oranye #F97316 -->
            <button type="submit" 
                    class="w-full mt-6 bg-brand-500 hover:bg-brand-600 text-white font-bold py-3.5 rounded-full shadow-md shadow-brand-500/25 hover:shadow-orange-glow transition">
                Simpan Penyaluran
            </button>
        </form>
    </div>
</div>
@endsection
