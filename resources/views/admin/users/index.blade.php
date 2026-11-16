@extends('layouts.app')
@section('title', 'Kelola Pengguna')
@section('content')

<div class="space-y-6">
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <h1 class="font-bold text-2xl sm:text-3xl text-[#1E293B]">Kelola Pengguna</h1>
            <p class="text-xs sm:text-sm text-[#64748B] mt-0.5">Manajemen peran akses donatur, hak administrator, dan status akun.</p>
        </div>
    </div>

    <!-- Kartu Tabel Pengguna -->
    <div class="bg-white rounded-3xl p-6 sm:p-7 shadow-sm border border-stone-200/80">
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead>
                    <tr class="text-left text-xs font-semibold text-[#64748B] uppercase tracking-wider border-b border-stone-100 pb-3">
                        <th class="pb-3">Nama Lengkap</th>
                        <th class="pb-3">Email</th>
                        <th class="pb-3">Peran (Role)</th>
                        <th class="pb-3">Status Akun</th>
                        <th class="pb-3 text-right">Aksi Manajemen</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-stone-100">
                    @forelse($users as $u)
                        <tr class="hover:bg-stone-50/80 transition">
                            <td class="py-3.5 pr-3 font-semibold text-[#1E293B]">{{ $u->name }}</td>
                            <td class="py-3.5 px-3 text-[#64748B] text-xs sm:text-sm">{{ $u->email }}</td>
                            <td class="py-3.5 px-3">
                                <span class="inline-block px-2.5 py-0.5 rounded-full text-xs font-bold uppercase tracking-wider {{ $u->role === 'admin' ? 'bg-orange-50 text-brand-600 border border-brand-200' : 'bg-stone-100 text-stone-700' }}">
                                    {{ $u->role }}
                                </span>
                            </td>
                            <td class="py-3.5 px-3 whitespace-nowrap">
                                @if($u->is_active)
                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full text-xs font-semibold bg-emerald-50 text-[#059669] border border-emerald-200">
                                        <span class="w-1.5 h-1.5 rounded-full bg-[#059669]"></span>
                                        Aktif
                                    </span>
                                @else
                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full text-xs font-semibold bg-red-50 text-danger border border-red-200">
                                        <span class="w-1.5 h-1.5 rounded-full bg-danger"></span>
                                        Nonaktif
                                    </span>
                                @endif
                            </td>
                            <td class="py-3.5 pl-3 text-right whitespace-nowrap">
                                <form method="POST" action="{{ route('admin.users.toggle', $u) }}" class="inline">
                                    @csrf
                                    <button class="text-xs font-semibold text-brand-600 hover:text-brand-700 hover:underline">
                                        {{ $u->is_active ? 'Nonaktifkan' : 'Aktifkan' }}
                                    </button>
                                </form>
                                @if($u->role !== 'admin')
                                    <form method="POST" action="{{ route('admin.users.make-admin', $u) }}" class="inline ml-3" onsubmit="return confirm('Jadikan {{ $u->name }} sebagai admin?')">
                                        @csrf
                                        <button class="text-xs font-semibold text-dark hover:text-brand-500 hover:underline">
                                            Jadikan Admin
                                        </button>
                                    </form>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr><td class="py-8 text-center text-[#64748B] text-xs" colspan="5">Tidak ada pengguna terdaftar.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-6 pt-4 border-t border-stone-100 flex justify-center">
            {{ $users->links() }}
        </div>
    </div>
</div>

@endsection
