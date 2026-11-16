# Donasi & Relawan Komunitas

Aplikasi web penggalangan dana komunitas yang tercatat, terverifikasi admin, dan transparan, lengkap dengan pengelolaan relawan per kampanye.

**Tugas Project — Cyber Security (Individu, Pra-UTS)**
Tema 18 (non-kampus) · FRD v1.0 (18 halaman)

- **Nama:** Azril Yasfin Suhendar Putra
- **NIM:** 20240810052
- **Kelas:** TINFC-2024-03
- **Dosen:** Fitra Nugraha, S.Kom., M.Kom.
- **Program Studi Teknik Informatika, Fakultas Ilmu Komputer, Universitas Kuningan, 2026**
- **URL aplikasi:** https://donasi-relawan-laravel-production.up.railway.app
- **URL repository:** https://github.com/a-ysfnptr/donasi-relawan-laravel

## Fitur

| Modul | Fitur |
|---|---|
| Autentikasi | Registrasi (nama, email unik, kata sandi min. 8 karakter huruf+angka+simbol), login, logout, ganti kata sandi, profil |
| Kampanye (Admin) | CRUD kampanye: judul, kategori, deskripsi, target dana, tenggat, status, foto sampul; publikasi & pencarian |
| Donasi | Donasi transfer manual + bukti transfer (gambar/PDF maks 2 MB, nama berkas acak); verifikasi/tolak oleh admin; donatur hanya melihat donasinya sendiri |
| Relawan | Pendaftaran per kampanye (satu akun = satu pendaftaran per kampanye), persetujuan admin, pembatalan oleh pemilik. Admin tidak bisa mendaftar sebagai relawan. |
| Penyaluran Dana | Catat penyaluran; jumlah **tidak boleh melebihi sisa dana terverifikasi**; tampil di halaman transparansi publik |
| Laporan | Dashboard admin & donatur, rekap per kampanye / per bulan / per kategori, ekspor **CSV** dan **PDF** (admin saja) |
| Audit | Audit log semua aksi penting (login, verifikasi, perubahan status, penyaluran) beserta pelaku, waktu, dan IP |

**Di luar lingkup (sengaja):** payment gateway sungguhan, aplikasi mobile, notifikasi WhatsApp/SMS. Donasi memakai transfer manual agar realistis dan tidak menyimpan data kartu. Rekening yang ditampilkan di halaman donasi hanya **nomor contoh berlabel demo** (BCA 1234567890, BRI 1234567890123, DANA/GoPay/OVO 081234567890, a.n. Donasi & Relawan Komunitas). Transfer bersifat simulasi untuk tugas.

## Teknologi

- **Laravel 12** (PHP 8.2+), Blade + Tailwind CSS
- **Database: Neon PostgreSQL** (eksternal) via `DATABASE_URL`; fallback SQLite untuk pengembangan lokal
- Hashing kata sandi **bcrypt**, sesi database + cookie HttpOnly/Secure/SameSite=Lax, CSRF, rate limiting login, security headers, RBAC + Policy anti-IDOR, audit log
- **Deploy: Railway (trial, tanpa kartu)** — service `donasi-relawan-laravel`, domain `*.up.railway.app` + HTTPS

## Cara Menjalankan Lokal

```bash
git clone https://github.com/a-ysfnptr/donasi-relawan-laravel.git
cd donasi-relawan-laravel
cp .env.example .env
php artisan key:generate
composer install
php artisan migrate --seed
php artisan serve
```

Buka `http://127.0.0.1:8000`.

Isi `.env` untuk Neon:

```env
DATABASE_URL=postgresql://<user>:<password>@<host>/<database>?sslmode=require
DB_CONNECTION=pgsql
APP_URL=http://127.0.0.1:8000
SESSION_SECURE_COOKIE=false
```

Untuk SQLite (cek cepat tanpa Neon), di `.env` set `DB_CONNECTION=sqlite` dan hapus `DATABASE_URL`, lalu `touch database/database.sqlite`.

## Variabel Environment

| Variabel | Wajib | Keterangan |
|---|---|---|
| `APP_KEY` | Ya | Hasil `php artisan key:generate --show`; **jangan commit** |
| `APP_URL` | Ya | URL publik aplikasi (Railway) |
| `DATABASE_URL` | Ya (prod) | Connection string Neon, `sslmode=require` |
| `DB_CONNECTION` | Ya | `pgsql` |
| `SESSION_DRIVER` | — | `database` |
| `SESSION_SECURE_COOKIE` | Prod | `true` (HTTPS); lokal `false` |
| `SESSION_SAME_SITE` / `SESSION_HTTP_ONLY` | — | `lax` / `true` |

`.env` masuk `.gitignore`. Repo hanya berisi `.env.example` **tanpa nilai rahasia**. Jangan pernah menempel `DATABASE_URL` atau `APP_KEY` di chat, kode, laporan, atau screenshot yang diteruskan.

## Deploy ke Railway

1. Push repo ini ke GitHub (branch `main`).
2. Di Railway → New Project → Deploy from GitHub repo → pilih repo ini.
3. Tambahkan environment variable: `APP_KEY`, `APP_URL` (domain Railway), `DATABASE_URL` (Neon), `DB_CONNECTION=pgsql`, `SESSION_DRIVER=database`, `SESSION_SECURE_COOKIE=true`, `SESSION_SAME_SITE=lax`, `SESSION_HTTP_ONLY=true`, `CACHE_STORE=database`, `QUEUE_CONNECTION=database`, `APP_ENV=production`, `APP_DEBUG=false`.
4. Generate Domain, lalu jalankan seeder lewat Railway SSH/CLI: `php artisan migrate:fresh --seed --force`.
5. Buka URL aplikasi, login sebagai admin (lihat akun uji), periksa halaman `/up` (health check).

Catatan: Railway trial $5 / 30 hari. Aplikasi harus tetap aktif sampai nilai diumumkan, jadi pantau sisa kredit trial.

## Akun Uji (Seeder)

| Peran | Email | Kata Sandi |
|---|---|---|
| Admin | `admin@donasi.local` | `Admin123!` |
| Donatur A | `donatur.a@donasi.local` | `Donatur123!` |
| Donatur B / Relawan | `donatur.b@donasi.local` | `Donatur123!` |

Akun uji hanya untuk demo/penilaian. Pasangan Donatur A / Donatur B dipakai untuk uji IDOR (A tidak boleh membuka donasi B).

Data contoh seeder: 3 kampanye aktif, donasi terverifikasi Rp1.750.000, dana tersalurkan Rp400.000, 2 pendaftaran relawan, 1 penyaluran dana.

## Keamanan yang Diterapkan

- **Hashing:** bcrypt; tidak ada kata sandi plaintext di kode, log, atau database.
- **Sesi aman:** cookie HttpOnly, Secure (HTTPS), SameSite=Lax; ID sesi diregenerasi setelah login; sesi dihapus saat logout.
- **RBAC:** middleware `admin` di semua rute `/admin`; Policy `DonationPolicy`/`VolunteerPolicy` (pemilik atau admin) untuk anti-IDOR.
- **Anti-SQLi:** seluruh query memakai Eloquent/parameterized; tidak ada penggabungan string input ke SQL.
- **Anti-XSS:** Blade `{{ }}` meng-escape semua output pengguna; deskripsi/pesan/nama tampil sebagai teks.
- **CSRF:** token `@csrf` di semua form ubah data.
- **Rate limiting:** login `throttle:5,1` di route (terkonfirmasi 429 di PHPUnit; di situs live belum terkonfirmasi, lihat Kendala).
- **Security headers:** `X-Content-Type-Options`, `X-Frame-Options`, `Referrer-Policy`, `Permissions-Policy`, CSP, HSTS (saat HTTPS) via `SecurityHeaders` middleware.
- **Validasi unggahan:** hanya gambar/PDF, maks 2 MB, nama berkas acak, disimpan di `storage/app/public`.
- **Audit log:** tabel `audit_logs` — pelaku, aksi, entitas, detail, IP, waktu; hanya bisa dibaca admin.
- **Secret:** hanya di environment variable / `.env` (di-`.gitignore`).

## Self-Testing Keamanan (situs live, 16 Nov 2026)

| ID | Skenario | Hasil |
|---|---|---|
| SEC-01 | SQL Injection (login & pencarian) | Lolos — payload `'OR'1'='1'@donasi.local` ditolak "Email atau kata sandi salah"; pencarian `%' OR 1=1 --` menghasilkan 0 kampanye, tanpa error SQL |
| SEC-02 | XSS | Lolos — pesan `<script>alert('XSS')</script>` di donasi #5 tampil sebagai teks, tidak ada alert |
| SEC-03 | Kontrol Akses / IDOR | Lolos — Donatur A membuka `/donations/2` dan `/admin/dashboard` → 403 |
| SEC-04 | Autentikasi & Sesi | Lolos sebagian — setelah logout `/dashboard` dialihkan ke `/login`; rate limiting live belum lolos (5x login salah tidak memunculkan 429/lockout) |
| SEC-05 | HTTPS & Security Headers | Belum tuntas — `http://` dialihkan ke `https://`, tetapi semua form POST ke `http://` sehingga Chrome menampilkan peringatan "Form is not secure"; scan securityheaders.com timeout |
| SEC-06 | Audit Dependensi | Lolos — `composer audit`: "No security vulnerability advisories found." |

Pengujian otomatis: `tests/Feature/SecurityTest.php` — **7/7 lolos, 13 assertions** (`vendor/bin/phpunit`, SQLite in-memory).

## Kendala dan Rencana Perbaikan

- Rate limiting live belum bekerja seperti di PHPUnit — periksa konfigurasi throttle di environment production.
- Form POST ke `http://` di balik proxy Railway — periksa trusted proxy / `APP_URL` agar URL form menjadi `https://`.
- Scan securityheaders.com timeout saat pengujian — uji ulang setelah perbaikan di atas.
- Kredit trial Railway terbatas — pantau pemakaian agar aplikasi tetap aktif sampai nilai diumumkan.

## Penggunaan AI

- **Alat:** Muse (Pax) — merancang FRD, menulis kode Laravel, dan menyusun dokumentasi ini.
- **Bagian yang dibantu AI:** kerangka FRD, seluruh kode awal (model, migrasi, controller, policy, view, Dockerfile), README, dan skenario self-testing. UI akhir diterapkan lewat Agent di Antigravity dari referensi Pinterest.
- **Contoh prompt utama:** *"Bangun aplikasi Laravel lengkap untuk Tugas Project Cyber Security, tema Donasi & Relawan Komunitas, sesuai FRD … stack Laravel + Neon PostgreSQL via DATABASE_URL, tanpa payment gateway …"*
- **Verifikasi oleh mahasiswa:** kode ditinjau dan diuji fungsional + keamanan (tabel SEC-01 s.d. SEC-06) sebelum dikumpulkan; mahasiswa wajib memahami dan mampu menjelaskan seluruh kode saat demo/tanya jawab.

## Struktur Proyek

```
app/Models            User, Campaign, Donation, Volunteer, Disbursement, AuditLog
app/Http/Controllers  Auth, Home, Campaign, Donation, Volunteer, Profile, Report
app/Http/Controllers/Admin  Dashboard, Campaign, Donation, Volunteer, Disbursement, User, AuditLog
app/Http/Middleware   AdminMiddleware (RBAC), SecurityHeaders
app/Http/Requests     Validasi server per form
app/Policies          DonationPolicy, VolunteerPolicy (anti-IDOR)
app/Services          AuditService
config/database.php   Parsing DATABASE_URL Neon (pgsql, sslmode=require)
database/migrations   users, campaigns, donations, volunteers, disbursements, audit_logs, cache, jobs
database/seeders      DatabaseSeeder (akun uji + data contoh)
resources/views       Blade + Tailwind, tema oranye #F97316
routes/web.php        Rute publik, auth (throttle), pengguna, admin
Dockerfile            PHP 8.3, pdo_pgsql, entrypoint artisan serve
tests/Feature         SecurityTest (7 kasus)
```

## Lisensi

Tugas kuliah individu — bukan untuk penggunaan produksi dengan data/dana nyata.
