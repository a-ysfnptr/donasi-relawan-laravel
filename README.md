# Donasi & Relawan Komunitas

Aplikasi web penggalangan dana komunitas yang tercatat, terverifikasi admin, dan transparan — lengkap dengan pengelolaan relawan per kampanye.

**Tugas Project — Cyber Security (Individu, Pra-UTS)**
Tema 18 (non-kampus) · FRD: `workspace/your_files/frd-donasi-relawan-komunitas/frd-donasi-relawan-komunitas.pdf` (v1.0, 18 halaman)

> **URL aplikasi:** *(diisi setelah deploy Render — mis. `https://donasi-relawan.onrender.com`)*
> **URL repository:** *(diisi setelah push ke GitHub)*

## Fitur

| Modul | Fitur |
|---|---|
| Autentikasi | Registrasi (nama, email unik, kata sandi min. 8 karakter huruf+angka+simbol), login, logout, ganti kata sandi, profil |
| Kampanye (Admin) | CRUD kampanye: judul, kategori, deskripsi, target dana, tenggat, status, foto sampul; publikasi & pencarian |
| Donasi | Donasi transfer manual + bukti transfer (gambar/PDF maks 2 MB, nama berkas acak); verifikasi/tolak oleh admin; donatur hanya melihat donasinya sendiri |
| Relawan | Pendaftaran per kampanye (satu akun = satu pendaftaran per kampanye), persetujuan admin, pembatalan oleh pemilik |
| Penyaluran Dana | Catat penyaluran; jumlah **tidak boleh melebihi sisa dana terverifikasi** (BR-02); tampil di halaman transparansi publik |
| Laporan | Dashboard admin & donatur, rekap per kampanye / per bulan / per kategori, ekspor **CSV** dan **PDF** (admin saja) |
| Audit | Audit log semua aksi penting (login, verifikasi, perubahan status, penyaluran) beserta pelaku, waktu, dan IP |

**Di luar lingkup (sengaja):** payment gateway sungguhan, aplikasi mobile, notifikasi WhatsApp/SMS. Pembayaran memakai transfer manual agar realistis dan tidak menyimpan data kartu.

## Teknologi

- **Laravel 12** (PHP 8.2+), Blade + Tailwind CSS (CDN — sengaja sederhana, UI final diganti via FigCraft/Antigravity)
- **Database: Neon PostgreSQL** (eksternal) via `DATABASE_URL`; fallback SQLite untuk pengembangan lokal
- Hashing kata sandi **bcrypt**, sesi database + cookie HttpOnly/Secure/SameSite=Lax, CSRF, rate limiting login (5/menit), security headers, RBAC + Policy anti-IDOR, audit log
- **Deploy: Render.com (free tier) via Dockerfile** — Render tidak punya runtime PHP native, jadi Laravel dijalankan dalam container PHP 8.3 + Apache

## Cara Menjalankan Lokal

```bash
git clone <url-repo-ini>
cd donasi-relawan-laravel
cp .env.example .env
php artisan key:generate
```

### Opsi A — Neon (disarankan, sama dengan production)

1. Buat project di [Neon](https://neon.tech) (free tier), salin **Connection string** (pilih *Pooled connection* bila tersedia).
2. Isi `.env`:
   ```env
   DATABASE_URL="postgres://user:password@ep-xxx.ap-southeast-1.aws.neon.tech/neondb?sslmode=require"
   DB_CONNECTION=pgsql
   APP_URL=http://127.0.0.1:8000
   SESSION_SECURE_COOKIE=false   # lokal pakai HTTP; production wajib true
   ```
3. Jalankan migrasi + seeder, lalu server:
   ```bash
   composer install
   php artisan migrate --seed
   php artisan serve
   ```
   Buka `http://127.0.0.1:8000`.

### Opsi B — SQLite (tanpa Neon, untuk cek cepat)

```bash
composer install
touch database/database.sqlite
# di .env: DB_CONNECTION=sqlite  (hapus DATABASE_URL)
php artisan migrate --seed
php artisan serve
```

## Variabel Environment

| Variabel | Wajib | Keterangan |
|---|---|---|
| `APP_KEY` | Ya | Hasil `php artisan key:generate --show`; **jangan commit** |
| `APP_URL` | Ya | URL publik aplikasi (Render) |
| `DATABASE_URL` | Ya (prod) | Connection string Neon, `sslmode=require` |
| `DB_CONNECTION` | Ya | `pgsql` |
| `SESSION_DRIVER` | — | `database` |
| `SESSION_SECURE_COOKIE` | Prod | `true` (HTTPS); lokal `false` |
| `SESSION_SAME_SITE` / `SESSION_HTTP_ONLY` | — | `lax` / `true` |

`.env` masuk `.gitignore`. Repo hanya berisi `.env.example` **tanpa nilai rahasia**.

## Deploy ke Render.com (Free Tier)

1. Push repo ini ke GitHub (repo publik, atau privat dengan akses untuk dosen).
2. Di [Render](https://render.com) → **New → Blueprint** → pilih repo → Render membaca `render.yaml`.
3. Isi environment variable yang berstatus `sync: false`:
   - `APP_KEY` — hasil `php artisan key:generate --show` dari lokal
   - `DATABASE_URL` — connection string Neon (pooled, `sslmode=require`)
   - Periksa `APP_URL` — sesuaikan dengan URL `.onrender.com` yang sebenarnya
4. Deploy. Entrypoint container otomatis menjalankan `php artisan migrate --force` lalu Apache.
5. Buka URL aplikasi, login sebagai admin (lihat akun uji), periksa halaman `/up` (health check).

**Alternatif tanpa Blueprint:** New → Web Service → pilih repo → Environment: **Docker** → Dockerfile Path: `./Dockerfile` → isi env var yang sama secara manual.

### Keterbatasan free tier Render (diketahui & diterima)

- **Spin down setelah ±15 menit idle** — request pertama setelah idle membutuhkan **cold start ±30–60 detik** (kadang lebih). Ini normal di free tier, bukan bug.
- **Tidak ada Postgres Render** — database tetap di Neon (eksternal), jadi data aman meski service Render sleep.
- Free tier memakai **satu instance** dan penyimpanan file bersifat **ephemeral** (bukti transfer yang diunggah bisa hilang saat redeploy — untuk tugas ini dapat diterima; di production gunakan object storage).

## Akun Uji (Seeder)

| Peran | Email | Kata Sandi |
|---|---|---|
| Admin | `admin@donasi.local` | `Admin123!` |
| Donatur A | `donatur.a@donasi.local` | `Donatur123!` |
| Donatur B / Relawan | `donatur.b@donasi.local` | `Donatur123!` |

Akun uji hanya untuk demo/penilaian. **Ganti kata sandinya setelah deploy** dan jangan memakai akun ini untuk data nyata. Pasangan Donatur A / Donatur B dipakai untuk uji IDOR (A tidak boleh membuka donasi B).

Data contoh seeder: 3 kampanye aktif, 3 donasi terverifikasi + 1 menunggu, 2 pendaftaran relawan, 1 penyaluran dana.

## Keamanan yang Diterapkan

- **Hashing:** bcrypt (`password` cast `hashed` + `Hash::make`); tidak ada kata sandi plaintext di kode, log, atau database.
- **Sesi aman:** cookie HttpOnly, Secure (HTTPS), SameSite=Lax; ID sesi diregenerasi setelah login; sesi dihapus saat logout.
- **RBAC:** middleware `admin` di semua rute `/admin`; Policy `DonationPolicy`/`VolunteerPolicy` (pemilik atau admin) untuk anti-IDOR.
- **Anti-SQLi:** seluruh query memakai Eloquent/parameterized; pencarian memakai parameter binding; tidak ada penggabungan string input ke SQL.
- **Anti-XSS:** Blade `{{ }}` meng-escape semua output pengguna; deskripsi/pesan/nama tampil sebagai teks.
- **CSRF:** token `@csrf` di semua form ubah data; diverifikasi Laravel.
- **Rate limiting:** login 5 percobaan/menit (`throttle:5,1`), registrasi 10/menit.
- **Security headers:** `X-Content-Type-Options`, `X-Frame-Options`, `Referrer-Policy`, `Permissions-Policy`, CSP, HSTS (saat HTTPS) via `SecurityHeaders` middleware.
- **Validasi unggahan:** hanya gambar/PDF, maks 2 MB, nama berkas acak (`Str::random(40)`), disimpan di `storage/app/public` (bukan `public/`).
- **Audit log:** tabel `audit_logs` — pelaku, aksi, entitas, detail, IP, waktu; hanya bisa dibaca admin.
- **Secret:** hanya di environment variable / `.env` (di-`.gitignore`); repo hanya berisi `.env.example`.

## Self-Testing Keamanan

### Hasil verifikasi lokal (16 Nov 2026, SQLite + `php artisan serve`) — LOLOS

- **PHPUnit — 7/7 lolos, 13 assertions** (`vendor/bin/phpunit`): manipulasi peran saat registrasi ditolak, IDOR donasi (403), user biasa tidak bisa buka `/admin` (403), rate limiting login (429), penyaluran melebihi sisa dana ditolak, progres hanya menghitung donasi terverifikasi, kata sandi tersimpan sebagai hash bcrypt.
- **Smoke test HTTP:** beranda 200 (kampanye + total Rp750.000 tampil), login 200, admin tanpa login diarahkan (302), login admin → dashboard 200, ekspor CSV 200 (data benar, anonim tampil "Hamba Allah"), ekspor PDF 200 (dokumen PDF valid).
- **SEC-02 XSS — LOLOS (diuji via curl):** donasi dengan pesan `<script>alert(1)</script>` tersimpan sebagai data, lalu tampil di halaman admin sebagai `&lt;script&gt;alert(1)&lt;/script&gt;`; 0 kemunculan `<script>` mentah di HTML.
- **SEC-03 IDOR — LOLOS (diuji via curl):** Donatur A membuka donasi #2 milik Donatur B → 403; donasi #1 milik sendiri → 200; `/admin/dashboard` sebagai donatur → 403.
- **SEC-04 — LOLOS sebagian:** cookie `HttpOnly` + header keamanan (`X-Content-Type-Options`, `X-Frame-Options`, CSP, `Referrer-Policy`) terkonfirmasi di respons HTTP; rate limiting 429 terkonfirmasi di PHPUnit; hash bcrypt terkonfirmasi di tes.
- **SEC-01 SQL Injection — BELUM diuji end-to-end** (baru dijamin di level kode: Eloquent/parameterized + validasi). Uji manual dengan payload di form login/pencarian setelah deploy.
- **SEC-05 HTTPS & Headers — BELUM bisa diuji lokal** (butuh URL Render HTTPS): jalankan securityheaders.com + SSL Labs setelah deploy.
- **SEC-06 Audit Dependensi — BELUM dijalankan:** jalankan `composer audit` sebelum pengumpulan dan catat keluarannya di laporan.

### Skenario uji untuk laporan akhir

| ID | Skenario | Cara Uji | Hasil yang Diharapkan |
|---|---|---|---|
| SEC-01 | SQL Injection | Payload injeksi di form login & pencarian kampanye | Login gagal normal, hasil pencarian tidak berubah, tanpa galat SQL |
| SEC-02 | XSS | Simpan `<script>` di judul/pesan/deskripsi, buka halamannya | Payload tampil sebagai teks, tidak dieksekusi |
| SEC-03 | Kontrol Akses / IDOR | Login Donatur A, buka `/donations/{id-milik-B}` dan `/admin/dashboard` | 403/404 pada keduanya |
| SEC-04 | Autentikasi & Sesi | Cek hash di DB, atribut cookie di DevTools, percobaan login berulang, akses halaman privat setelah logout | Hash bcrypt, cookie HttpOnly/Secure, 429 setelah batas, akses ditolak setelah logout |
| SEC-05 | HTTPS & Security Headers | Buka via HTTP, pindai di securityheaders.com | Dialihkan ke HTTPS, header keamanan utama hadir |
| SEC-06 | Audit Dependensi | `composer audit` | Keluaran dicatat; kerentanan kritis diperbaiki/dijelaskan |

Pengujian otomatis: `tests/Feature/SecurityTest.php` (7 kasus).
Jalankan: `vendor/bin/phpunit` (memakai SQLite in-memory).

## Penggunaan AI Agent

- **Alat:** Muse (Pax) — merancang FRD, menulis kode Laravel, dan menyusun dokumentasi ini.
- **Bagian yang dibantu AI:** kerangka FRD, seluruh kode awal (model, migrasi, controller, policy, view, Dockerfile, render.yaml), README, dan skenario self-testing.
- **Contoh prompt utama:** *"Bangun aplikasi Laravel lengkap untuk Tugas Project Cyber Security, tema Donasi & Relawan Komunitas, sesuai FRD … stack Laravel + Neon PostgreSQL via DATABASE_URL, tanpa payment gateway …"*
- **Verifikasi oleh mahasiswa:** kode ditinjau dan diuji fungsional + keamanan (tabel SEC-01 s.d. SEC-06) sebelum dikumpulkan; mahasiswa wajib memahami dan mampu menjelaskan seluruh kode saat demo/tanya jawab.

## Struktur Proyek

```
app/Models            User, Campaign, Donation, Volunteer, Disbursement, AuditLog
app/Http/Controllers  Auth, Home, Campaign, Donation, Volunteer, Profile, Report
app/Http/Controllers/Admin  Dashboard, Campaign, Donation, Volunteer, Disbursement, User, AuditLog
app/Http/Middleware   AdminMiddleware (RBAC), SecurityHeaders
app/Http/Requests     Validasi server per form (StoreCampaign/Donation/Volunteer/Disbursement)
app/Policies          DonationPolicy, VolunteerPolicy (anti-IDOR)
app/Services          AuditService
config/database.php   Parsing DATABASE_URL Neon (pgsql, sslmode=require)
database/migrations   users, campaigns, donations, volunteers, disbursements, audit_logs, cache, jobs
database/seeders      DatabaseSeeder (akun uji + data contoh)
resources/views       Blade + Tailwind (layout bersih, mudah diganti FigCraft)
routes/web.php        Rute publik, auth (throttle), pengguna, admin
Dockerfile            PHP 8.3 + Apache, pdo_pgsql, entrypoint migrasi otomatis
render.yaml           Blueprint Render (web service free, Docker, env var placeholder)
tests/Feature         SecurityTest (7 kasus)
```

## Catatan UI (FigCraft / Antigravity)

View Blade di `resources/views` sengaja dibuat bersih dan berbasis satu layout (`layouts/app.blade.php`) + komponen kecil (`partials/campaign-card.blade.php`, `partials/flash.blade.php`) agar mudah diganti hasil FigCraft dari referensi Pinterest. Ganti isi layout/komponen tanpa mengubah nama route atau struktur data yang dikirim controller ke view.

## Lisensi

Tugas kuliah individu — bukan untuk penggunaan produksi dengan data/dana nyata.
