{{-- Blade {{ }} otomatis meng-escape output — payload XSS tampil sebagai teks, bukan dieksekusi. --}}
<article class="group bg-white rounded-3xl shadow-soft hover:shadow-soft-xl transition-all duration-300 border border-stone-200/80 overflow-hidden flex flex-col">
    <!-- Foto Sampul Kampanye (Gunakan foto dari database atau fallback tematik) -->
    <div class="relative w-full h-52 sm:h-56 bg-stone-900 overflow-hidden">
        @if($campaign->cover_image)
            <img src="{{ asset('storage/' . $campaign->cover_image) }}" 
                 alt="{{ $campaign->title }}" 
                 loading="lazy"
                 class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
        @else
            <!-- Fallback visual tematik bila belum diunggah admin -->
            <div class="w-full h-full flex flex-col justify-between p-5 bg-gradient-to-br from-stone-900 via-stone-800 to-amber-950 text-white relative">
                <div class="absolute -right-6 -bottom-6 w-32 h-32 rounded-full bg-brand-500/10 blur-xl pointer-events-none"></div>
                <div class="flex justify-between items-start z-10">
                    <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-[11px] font-bold tracking-wider uppercase bg-white/20 backdrop-blur-md text-amber-200">
                        {{ $campaign->category }}
                    </span>
                    <span class="text-xs text-stone-300 bg-stone-900/60 px-2 py-0.5 rounded-md">
                        {{ $campaign->status === 'aktif' ? 'Aktif' : ucfirst($campaign->status) }}
                    </span>
                </div>
                <div class="z-10">
                    <div class="w-10 h-10 rounded-xl bg-brand-500/30 text-amber-300 flex items-center justify-center mb-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                        </svg>
                    </div>
                    <p class="text-xs text-stone-300 line-clamp-1">Aksi Kebaikan &amp; Relawan</p>
                </div>
            </div>
        @endif

        <!-- Floating Category Badge di atas foto (jika foto tersedia) -->
        @if($campaign->cover_image)
            <div class="absolute top-3 left-3 z-10">
                <span class="inline-block px-3 py-1 rounded-full text-[11px] font-bold tracking-wider uppercase bg-white/95 backdrop-blur-md text-brand-600 shadow-sm">
                    {{ $campaign->category }}
                </span>
            </div>
            <div class="absolute top-3 right-3 z-10">
                <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-[11px] font-semibold bg-stone-900/80 backdrop-blur-md text-stone-200">
                    <span class="w-1.5 h-1.5 rounded-full {{ $campaign->isOpen() ? 'bg-emerald-400' : 'bg-stone-400' }}"></span>
                    {{ $campaign->isOpen() ? 'Aktif' : 'Tutup' }}
                </span>
            </div>
        @endif
    </div>

    <!-- Body Kartu -->
    <div class="p-6 flex flex-col flex-1 justify-between">
        <div>
            <!-- Meta tenggat waktu -->
            <div class="flex items-center gap-1.5 text-xs font-medium text-[#64748B] mb-2">
                <svg class="w-3.5 h-3.5 text-brand-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                </svg>
                <span>Tenggat: {{ $campaign->deadline?->format('d M Y') ?? 'Tidak Terbatas' }}</span>
            </div>

            <!-- Judul Kampanye -->
            <h3 class="font-serif font-bold text-lg text-[#1E293B] group-hover:text-brand-500 transition-colors line-clamp-2 leading-snug">
                <a href="{{ route('campaigns.show', $campaign) }}">{{ $campaign->title }}</a>
            </h3>

            <!-- Deskripsi Singkat -->
            <p class="text-sm text-[#64748B] line-clamp-2 mt-2 leading-relaxed">
                {{ $campaign->description }}
            </p>
        </div>

        <!-- Progres Donasi & CTA -->
        <div class="mt-6 pt-4 border-t border-stone-100">
            <!-- Jumlah Terkumpul dan Target -->
            <div class="flex justify-between items-baseline mb-1.5">
                <div>
                    <span class="text-[11px] font-semibold text-[#64748B] uppercase tracking-wider block">Terkumpul</span>
                    <span class="font-bold text-base text-brand-600">Rp{{ number_format($campaign->verifiedTotal(), 0, ',', '.') }}</span>
                </div>
                <div class="text-right">
                    <span class="text-[11px] font-semibold text-[#64748B] uppercase tracking-wider block">Target</span>
                    <span class="font-semibold text-xs text-stone-600">Rp{{ number_format($campaign->target_amount, 0, ',', '.') }}</span>
                </div>
            </div>

            <!-- Progress Bar Emerald #059669 (Khusus Progres & Status Sukses) -->
            <div class="w-full bg-stone-100 rounded-full h-2.5 overflow-hidden border border-stone-200/50">
                <div class="bg-[#059669] h-full rounded-full transition-all duration-500" 
                     style="width: {{ $campaign->progressPercent() }}%"></div>
            </div>

            <!-- Persentase Progres -->
            <div class="flex justify-between items-center text-xs mt-2 text-[#64748B]">
                <span class="font-bold text-[#1E293B]">{{ $campaign->progressPercent() }}% Tercapai</span>
                @if($campaign->verifiedTotal() >= $campaign->target_amount && $campaign->target_amount > 0)
                    <span class="text-[#059669] font-bold flex items-center gap-1">
                        <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></svg>
                        Target Terpenuhi
                    </span>
                @endif
            </div>

            <!-- Tombol Donasi Sekarang Oranye (#F97316, hover #EA580C) -->
            <a href="{{ route('campaigns.show', $campaign) }}" 
               class="mt-4 w-full inline-flex items-center justify-center gap-2 bg-brand-500 hover:bg-brand-600 text-white font-semibold text-sm py-2.5 px-4 rounded-xl shadow-sm hover:shadow-orange-glow hover:-translate-y-0.5 active:translate-y-0 transition-all duration-200">
                <span>Donasi Sekarang</span>
                <svg class="w-4 h-4 text-white group-hover:translate-x-0.5 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                </svg>
            </a>
        </div>
    </div>
</article>
