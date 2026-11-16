@if(session('success'))
    <div class="bg-emerald-50 border border-emerald-200 text-emerald-800 px-4 py-3 rounded-2xl mb-6 shadow-sm flex items-center gap-3">
        <div class="w-6 h-6 rounded-full bg-emerald-100 text-[#059669] flex items-center justify-center shrink-0">
            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></svg>
        </div>
        <span class="text-sm font-medium">{{ session('success') }}</span>
    </div>
@endif

@if($errors->any())
    <div class="bg-red-50 border border-red-200 text-[#DC2626] px-4 py-3 rounded-2xl mb-6 shadow-sm">
        <div class="flex items-center gap-2 mb-1.5 font-bold text-sm">
            <svg class="w-4 h-4 text-[#DC2626]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            <span>Terdapat beberapa kesalahan:</span>
        </div>
        <ul class="list-disc pl-5 text-xs sm:text-sm space-y-1">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
