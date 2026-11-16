<div class="space-y-4 text-sm">
    <div>
        <label class="block text-xs font-semibold uppercase tracking-wider text-[#1E293B] mb-1.5">Judul Kampanye</label>
        <input type="text" name="title" value="{{ old('title', $campaign->title ?? '') }}" required maxlength="200" 
               class="w-full px-4 py-3 bg-[#FFFBF5] border border-stone-200 rounded-xl text-sm text-[#1E293B] focus:outline-none focus:ring-2 focus:ring-brand-500/40 focus:border-brand-500 transition">
    </div>

    <div>
        <label class="block text-xs font-semibold uppercase tracking-wider text-[#1E293B] mb-1.5">Kategori</label>
        <select name="category" required 
                class="w-full px-4 py-3 bg-[#FFFBF5] border border-stone-200 rounded-xl text-sm text-[#1E293B] focus:outline-none focus:ring-2 focus:ring-brand-500/40 focus:border-brand-500 transition cursor-pointer">
            @foreach(\App\Models\Campaign::CATEGORIES as $cat)
                <option value="{{ $cat }}" @selected(old('category', $campaign->category ?? '') === $cat)>{{ ucfirst($cat) }}</option>
            @endforeach
        </select>
    </div>

    <div>
        <label class="block text-xs font-semibold uppercase tracking-wider text-[#1E293B] mb-1.5">Deskripsi Lengkap</label>
        <textarea name="description" required maxlength="5000" rows="4" 
                  class="w-full px-4 py-3 bg-[#FFFBF5] border border-stone-200 rounded-xl text-sm text-[#1E293B] focus:outline-none focus:ring-2 focus:ring-brand-500/40 focus:border-brand-500 transition">{{ old('description', $campaign->description ?? '') }}</textarea>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
        <div>
            <label class="block text-xs font-semibold uppercase tracking-wider text-[#1E293B] mb-1.5">Target Dana (Rp)</label>
            <input type="number" name="target_amount" value="{{ old('target_amount', $campaign->target_amount ?? '') }}" required min="1000" 
                   class="w-full px-4 py-3 bg-[#FFFBF5] border border-stone-200 rounded-xl text-sm text-[#1E293B] focus:outline-none focus:ring-2 focus:ring-brand-500/40 focus:border-brand-500 transition">
        </div>
        <div>
            <label class="block text-xs font-semibold uppercase tracking-wider text-[#1E293B] mb-1.5">Tenggat Waktu</label>
            <input type="date" name="deadline" value="{{ old('deadline', isset($campaign) ? $campaign->deadline?->format('Y-m-d') : '') }}" required 
                   class="w-full px-4 py-3 bg-[#FFFBF5] border border-stone-200 rounded-xl text-sm text-[#1E293B] focus:outline-none focus:ring-2 focus:ring-brand-500/40 focus:border-brand-500 transition">
        </div>
    </div>

    <div>
        <label class="block text-xs font-semibold uppercase tracking-wider text-[#1E293B] mb-1.5">Status Kampanye</label>
        <select name="status" required 
                class="w-full px-4 py-3 bg-[#FFFBF5] border border-stone-200 rounded-xl text-sm text-[#1E293B] focus:outline-none focus:ring-2 focus:ring-brand-500/40 focus:border-brand-500 transition cursor-pointer">
            @foreach(\App\Models\Campaign::STATUSES as $s)
                <option value="{{ $s }}" @selected(old('status', $campaign->status ?? 'aktif') === $s)>{{ ucfirst($s) }}</option>
            @endforeach
        </select>
    </div>

    <div>
        <label class="block text-xs font-semibold uppercase tracking-wider text-[#1E293B] mb-1.5">Foto Sampul (opsional, gambar maks 2 MB)</label>
        <input type="file" name="cover_image" accept=".jpg,.jpeg,.png,.webp" 
               class="w-full px-4 py-2.5 bg-[#FFFBF5] border border-stone-200 rounded-xl text-xs text-[#1E293B] focus:outline-none focus:ring-2 focus:ring-brand-500/40 focus:border-brand-500 transition file:mr-4 file:py-1 file:px-3 file:rounded-full file:border-0 file:text-xs file:font-semibold file:bg-orange-50 file:text-brand-600 hover:file:bg-orange-100">
    </div>
</div>
