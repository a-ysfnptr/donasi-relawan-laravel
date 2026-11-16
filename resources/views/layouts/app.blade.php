<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Donasi & Relawan Komunitas') - Platform Kebaikan Terpercaya</title>

    <!-- Google Fonts: Playfair Display (Serif) & Plus Jakarta Sans (Sans) -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,600;0,700;0,800;0,900;1,600;1,700&family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Tailwind CSS CDN dengan Konfigurasi Design Token Sistem -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        /* DESIGN TOKEN RESMI */
                        brand: {
                            50: '#FFF7ED',
                            100: '#FFEDD5',
                            200: '#FED7AA',
                            300: '#FDBA74',
                            400: '#FB923C',
                            500: '#F97316', /* Warna utama / CTA / link aktif: #F97316 */
                            600: '#EA580C', /* Hover utama: #EA580C */
                            700: '#C2410C',
                            800: '#9A3412',
                            900: '#7C2D12',
                        },
                        success: {
                            50: '#ECFDF5',
                            100: '#D1FAE5',
                            200: '#A7F3D0',
                            500: '#10B981',
                            600: '#059669', /* Sukses / terverifikasi: #059669 */
                            700: '#047857',
                        },
                        dark: {
                            DEFAULT: '#111827', /* Gelap / aksen: #111827 */
                            800: '#1F2937',
                            900: '#111827',
                            950: '#0B0F19',
                        },
                        cream: {
                            DEFAULT: '#FFFBF5', /* Latar krem hangat: #FFFBF5 */
                            50: '#FFFBF5',
                            100: '#FFF7ED',
                            200: '#FDEEE2',
                        },
                        main: '#1E293B',     /* Teks utama: #1E293B */
                        secondary: '#64748B',/* Teks sekunder: #64748B */
                        danger: {
                            DEFAULT: '#DC2626', /* Bahaya / tolak: #DC2626 */
                            50: '#FEF2F2',
                            600: '#DC2626',
                            700: '#B91C1C',
                        }
                    },
                    fontFamily: {
                        serif: ['"Playfair Display"', 'Georgia', 'serif'],
                        sans: ['"Plus Jakarta Sans"', 'ui-sans-serif', 'system-ui', 'sans-serif'],
                    },
                    boxShadow: {
                        'soft': '0 4px 20px -2px rgba(17, 24, 39, 0.05)',
                        'soft-lg': '0 10px 30px -4px rgba(17, 24, 39, 0.08)',
                        'soft-xl': '0 20px 40px -6px rgba(17, 24, 39, 0.12)',
                        'orange-glow': '0 8px 25px -4px rgba(249, 115, 22, 0.35)',
                    }
                }
            }
        }
    </script>
    <style>
        :root {
            --color-primary: #F97316;
            --color-primary-hover: #EA580C;
            --color-success: #059669;
            --color-dark: #111827;
            --color-cream: #FFFBF5;
            --color-text-main: #1E293B;
            --color-text-secondary: #64748B;
            --color-danger: #DC2626;
        }
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: #FFFBF5;
            color: #1E293B;
        }
        .font-serif {
            font-family: 'Playfair Display', serif;
        }
    </style>
</head>
<body class="bg-[#FFFBF5] text-[#1E293B] min-h-screen flex flex-col antialiased selection:bg-brand-500 selection:text-white">

    <!-- Top Bar Inspirasi Charito -->
    <div class="bg-[#111827] text-stone-300 text-xs py-2 px-4 border-b border-stone-800 hidden sm:block">
        <div class="max-w-7xl mx-auto flex justify-between items-center">
            <div class="flex items-center gap-6">
                <span class="flex items-center gap-1.5 text-stone-300">
                    <svg class="w-3.5 h-3.5 text-brand-500" fill="currentColor" viewBox="0 0 20 20"><path d="M2 3a1 1 0 011-1h2.153a1 1 0 01.986.836l.74 4.435a1 1 0 01-.54 1.06l-1.548.773a11.037 11.037 0 006.105 6.105l.774-1.548a1 1 0 011.059-.54l4.435.74a1 1 0 01.836.986V17a1 1 0 01-1 1h-2C7.82 18 2 12.18 2 4V3z"/></svg>
                    Bantuan &amp; Konsultasi: 0812-3456-7890
                </span>
                <span class="flex items-center gap-1.5 text-stone-300">
                    <svg class="w-3.5 h-3.5 text-brand-500" fill="currentColor" viewBox="0 0 20 20"><path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z"/><path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z"/></svg>
                    info@donasirelawan.org
                </span>
            </div>
            <div class="flex items-center gap-4">
                <span class="text-stone-400">Ulurkan tangan, berikan senyuman untuk sesama</span>
                <a href="{{ route('campaigns.index') }}" class="text-brand-400 hover:text-brand-300 font-semibold flex items-center gap-1 transition">
                    Lihat Semua Aksi &rarr;
                </a>
            </div>
        </div>
    </div>

    <!-- Main Header Navbar (Putih Bersih) -->
    <header class="bg-white/95 backdrop-blur-md sticky top-0 z-50 shadow-sm border-b border-stone-200/60 transition-all">
        <nav class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-3.5 flex items-center justify-between gap-4">
            
            <!-- Logo Brand -->
            <a href="{{ route('home') }}" class="flex items-center gap-3 group">
                <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-brand-500 to-brand-600 flex items-center justify-center text-white shadow-md shadow-brand-500/20 group-hover:scale-105 transition-transform duration-200">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                    </svg>
                </div>
                <div>
                    <span class="block font-bold text-lg text-dark tracking-tight leading-none group-hover:text-brand-500 transition-colors">Donasi &amp; Relawan</span>
                    <span class="block text-[11px] font-semibold tracking-wider uppercase text-secondary mt-0.5">Komunitas Kebaikan</span>
                </div>
            </a>

            <!-- Desktop Nav Links -->
            <div class="hidden lg:flex items-center gap-7 text-sm font-medium text-stone-700">
                <a href="{{ route('home') }}" class="hover:text-brand-500 transition-colors {{ request()->routeIs('home') ? 'text-brand-500 font-semibold' : '' }}">Beranda</a>
                <a href="{{ route('campaigns.index') }}" class="hover:text-brand-500 transition-colors {{ request()->routeIs('campaigns.*') ? 'text-brand-500 font-semibold' : '' }}">Kampanye</a>
                
                @auth
                    <a href="{{ route('dashboard') }}" class="hover:text-brand-500 transition-colors {{ request()->routeIs('dashboard') ? 'text-brand-500 font-semibold' : '' }}">Dashboard</a>
                    <a href="{{ route('donations.index') }}" class="hover:text-brand-500 transition-colors {{ request()->routeIs('donations.*') ? 'text-brand-500 font-semibold' : '' }}">Donasi Saya</a>
                    <a href="{{ route('volunteers.index') }}" class="hover:text-brand-500 transition-colors {{ request()->routeIs('volunteers.*') ? 'text-brand-500 font-semibold' : '' }}">Relawan Saya</a>
                    
                    @if(auth()->user()->isAdmin())
                        <a href="{{ route('admin.dashboard') }}" class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-bold bg-orange-50 text-brand-600 border border-brand-200 hover:bg-orange-100 transition">
                            <span class="w-1.5 h-1.5 rounded-full bg-brand-500 animate-pulse"></span>
                            Admin Panel
                        </a>
                    @endif
                @endauth
            </div>

            <!-- Right CTA Action & Auth -->
            <div class="hidden md:flex items-center gap-3">
                @auth
                    <div class="flex items-center gap-3 pl-2 border-l border-stone-200">
                        <div class="text-right">
                            <span class="block text-xs font-semibold text-dark truncate max-w-[120px]">{{ auth()->user()->name }}</span>
                            <span class="block text-[10px] text-secondary capitalize">{{ auth()->user()->role }}</span>
                        </div>
                        <form method="POST" action="{{ route('logout') }}" class="inline">
                            @csrf
                            <button type="submit" class="text-xs font-medium text-danger hover:text-danger-700 bg-red-50 hover:bg-red-100 px-3 py-1.5 rounded-lg transition" title="Keluar Akun">
                                Keluar
                            </button>
                        </form>
                    </div>
                @else
                    <a href="{{ route('login') }}" class="text-sm font-semibold text-stone-700 hover:text-brand-500 px-3 py-2 transition">Masuk</a>
                    <a href="{{ route('register') }}" class="text-sm font-semibold text-dark bg-stone-100 hover:bg-stone-200 px-4 py-2 rounded-xl transition">Daftar</a>
                @endauth

                <!-- Tombol Donasi Sekarang Oranye (#F97316, hover #EA580C) -->
                <a href="{{ route('campaigns.index') }}" class="inline-flex items-center gap-2 bg-brand-500 hover:bg-brand-600 text-white font-semibold text-sm px-5 py-2.5 rounded-full shadow-md shadow-brand-500/25 hover:shadow-orange-glow hover:-translate-y-0.5 active:translate-y-0 transition-all duration-200">
                    <svg class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z" clip-rule="evenodd"/>
                    </svg>
                    <span>Donasi Sekarang</span>
                </a>
            </div>

            <!-- Mobile Hamburger Toggle -->
            <button type="button" id="mobile-menu-btn" class="lg:hidden p-2 rounded-xl text-stone-600 hover:text-dark hover:bg-stone-100 focus:outline-none" aria-label="Menu Navigasi">
                <svg id="menu-icon-open" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
                <svg id="menu-icon-close" class="w-6 h-6 hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
            </button>
        </nav>

        <!-- Mobile Drawer Menu -->
        <div id="mobile-menu" class="hidden lg:hidden border-t border-stone-200 bg-white px-4 pt-3 pb-6 space-y-3">
            <a href="{{ route('home') }}" class="block px-3 py-2 rounded-lg text-base font-medium text-stone-800 hover:bg-orange-50 hover:text-brand-500 {{ request()->routeIs('home') ? 'bg-orange-50 text-brand-500 font-bold' : '' }}">Beranda</a>
            <a href="{{ route('campaigns.index') }}" class="block px-3 py-2 rounded-lg text-base font-medium text-stone-800 hover:bg-orange-50 hover:text-brand-500 {{ request()->routeIs('campaigns.*') ? 'bg-orange-50 text-brand-500 font-bold' : '' }}">Kampanye</a>
            
            @auth
                <a href="{{ route('dashboard') }}" class="block px-3 py-2 rounded-lg text-base font-medium text-stone-800 hover:bg-orange-50 hover:text-brand-500 {{ request()->routeIs('dashboard') ? 'bg-orange-50 text-brand-500 font-bold' : '' }}">Dashboard</a>
                <a href="{{ route('donations.index') }}" class="block px-3 py-2 rounded-lg text-base font-medium text-stone-800 hover:bg-orange-50 hover:text-brand-500 {{ request()->routeIs('donations.*') ? 'bg-orange-50 text-brand-500 font-bold' : '' }}">Donasi Saya</a>
                <a href="{{ route('volunteers.index') }}" class="block px-3 py-2 rounded-lg text-base font-medium text-stone-800 hover:bg-orange-50 hover:text-brand-500 {{ request()->routeIs('volunteers.*') ? 'bg-orange-50 text-brand-500 font-bold' : '' }}">Relawan Saya</a>
                @if(auth()->user()->isAdmin())
                    <a href="{{ route('admin.dashboard') }}" class="block px-3 py-2 rounded-lg text-base font-bold text-brand-600 bg-orange-50">Admin Panel</a>
                @endif
                <div class="pt-3 border-t border-stone-200 flex items-center justify-between px-3">
                    <div>
                        <p class="font-semibold text-sm text-dark">{{ auth()->user()->name }}</p>
                        <p class="text-xs text-secondary capitalize">{{ auth()->user()->role }}</p>
                    </div>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="text-xs font-semibold text-danger bg-red-50 hover:bg-red-100 px-3 py-1.5 rounded-lg">Keluar</button>
                    </form>
                </div>
            @else
                <div class="pt-3 border-t border-stone-200 grid grid-cols-2 gap-2">
                    <a href="{{ route('login') }}" class="text-center font-semibold text-sm py-2 px-3 border border-stone-300 rounded-xl text-stone-700 hover:bg-stone-50">Masuk</a>
                    <a href="{{ route('register') }}" class="text-center font-semibold text-sm py-2 px-3 bg-stone-100 rounded-xl text-dark hover:bg-stone-200">Daftar</a>
                </div>
            @endauth

            <div class="pt-2">
                <a href="{{ route('campaigns.index') }}" class="w-full flex items-center justify-center gap-2 bg-brand-500 hover:bg-brand-600 text-white font-bold py-3 rounded-xl shadow-md text-sm">
                    <svg class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z" clip-rule="evenodd"/></svg>
                    <span>Donasi Sekarang</span>
                </a>
            </div>
        </div>
    </header>

    <!-- Main Content Area -->
    <main class="w-full flex-1">
        @if(!request()->routeIs('home'))
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 w-full">
                @include('partials.flash')
                @yield('content')
            </div>
        @else
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-4">
                @include('partials.flash')
            </div>
            @yield('content')
        @endif
    </main>

    <!-- Footer Bernuansa Hitam Kontras #111827 -->
    <footer class="bg-[#111827] text-stone-400 mt-20 border-t border-stone-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-14 pb-10">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-10 pb-12 border-b border-stone-800/80">
                
                <!-- Kolom 1: Brand Info -->
                <div class="md:col-span-2 space-y-4">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-xl bg-brand-500 flex items-center justify-center text-white shadow-md">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                            </svg>
                        </div>
                        <span class="font-serif font-bold text-xl text-white tracking-wide">Donasi &amp; Relawan</span>
                    </div>
                    <p class="text-sm text-stone-400 max-w-md leading-relaxed">
                        Platform penggalangan dana sosial dan mobilisasi relawan independen. Setiap donasi tercatat aman, diverifikasi manual oleh admin, dan disalurkan secara transparan tanpa potongan tersembunyi.
                    </p>
                    <div class="pt-2 flex items-center gap-3">
                        <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-semibold bg-stone-800 text-stone-300 border border-stone-700">
                            <span class="w-2 h-2 rounded-full bg-emerald-500"></span>
                            Audit &amp; Transparansi Terbuka
                        </span>
                    </div>
                </div>

                <!-- Kolom 2: Navigasi Cepat -->
                <div>
                    <h3 class="text-white font-bold text-sm tracking-wider uppercase mb-4">Navigasi</h3>
                    <ul class="space-y-2.5 text-sm">
                        <li><a href="{{ route('home') }}" class="hover:text-brand-400 transition">Beranda</a></li>
                        <li><a href="{{ route('campaigns.index') }}" class="hover:text-brand-400 transition">Daftar Kampanye</a></li>
                        @auth
                            <li><a href="{{ route('dashboard') }}" class="hover:text-brand-400 transition">Dashboard Saya</a></li>
                            <li><a href="{{ route('donations.index') }}" class="hover:text-brand-400 transition">Riwayat Donasi</a></li>
                        @else
                            <li><a href="{{ route('login') }}" class="hover:text-brand-400 transition">Masuk Akun</a></li>
                            <li><a href="{{ route('register') }}" class="hover:text-brand-400 transition">Daftar Donatur</a></li>
                        @endauth
                    </ul>
                </div>

                <!-- Kolom 3: Kategori Kampanye -->
                <div>
                    <h3 class="text-white font-bold text-sm tracking-wider uppercase mb-4">Kategori Aksi</h3>
                    <ul class="space-y-2.5 text-sm">
                        <li><a href="{{ route('campaigns.index', ['category' => 'bencana']) }}" class="hover:text-brand-400 transition">Tanggap Bencana</a></li>
                        <li><a href="{{ route('campaigns.index', ['category' => 'pendidikan']) }}" class="hover:text-brand-400 transition">Beasiswa &amp; Pendidikan</a></li>
                        <li><a href="{{ route('campaigns.index', ['category' => 'kesehatan']) }}" class="hover:text-brand-400 transition">Kesehatan Masyarakat</a></li>
                        <li><a href="{{ route('campaigns.index', ['category' => 'sosial']) }}" class="hover:text-brand-400 transition">Pemberdayaan Sosial</a></li>
                        <li><a href="{{ route('campaigns.index', ['category' => 'lingkungan']) }}" class="hover:text-brand-400 transition">Kelestarian Lingkungan</a></li>
                    </ul>
                </div>

            </div>

            <div class="pt-8 flex flex-col md:flex-row items-center justify-between gap-4 text-xs text-stone-500">
                <p>&copy; {{ date('Y') }} Donasi &amp; Relawan Komunitas. Tugas Project Cyber Security.</p>
                <p>Transfer manual terverifikasi, aman, dan tanpa integrasi payment gateway pihak ketiga.</p>
            </div>
        </div>
    </footer>

    <!-- Script toggle mobile menu -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const btn = document.getElementById('mobile-menu-btn');
            const menu = document.getElementById('mobile-menu');
            const iconOpen = document.getElementById('menu-icon-open');
            const iconClose = document.getElementById('menu-icon-close');

            if (btn && menu) {
                btn.addEventListener('click', function () {
                    const isHidden = menu.classList.contains('hidden');
                    if (isHidden) {
                        menu.classList.remove('hidden');
                        iconOpen.classList.add('hidden');
                        iconClose.classList.remove('hidden');
                    } else {
                        menu.classList.add('hidden');
                        iconOpen.classList.remove('hidden');
                        iconClose.classList.add('hidden');
                    }
                });
            }
        });
    </script>
</body>
</html>
