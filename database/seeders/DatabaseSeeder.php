<?php

namespace Database\Seeders;

use App\Models\Campaign;
use App\Models\Disbursement;
use App\Models\Donation;
use App\Models\User;
use App\Models\Volunteer;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // AKUN UJI — hanya untuk demo/penilaian dosen. Ganti password setelah deploy.
        $admin = User::create([
            'name' => 'Admin Donasi', 'email' => 'admin@donasi.local',
            'password' => Hash::make('Admin123!'), 'role' => 'admin', 'phone' => '081234567890',
        ]);
        $donaturA = User::create([
            'name' => 'Donatur A', 'email' => 'donatur.a@donasi.local',
            'password' => Hash::make('Donatur123!'), 'role' => 'user', 'phone' => '081234567891',
        ]);
        $donaturB = User::create([
            'name' => 'Donatur B', 'email' => 'donatur.b@donasi.local',
            'password' => Hash::make('Donatur123!'), 'role' => 'user', 'phone' => '081234567892',
        ]);

        $c1 = Campaign::create([
            'title' => 'Bantu Korban Banjir di Desa Sukamaju',
            'category' => 'bencana',
            'description' => 'Penggalangan dana untuk kebutuhan pokok, selimut, dan obat-obatan warga terdampak banjir.',
            'target_amount' => 10000000, 'deadline' => now()->addDays(30)->toDateString(),
            'status' => 'aktif', 'created_by' => $admin->id,
        ]);
        $c2 = Campaign::create([
            'title' => 'Beasiswa Anak Pesisir',
            'category' => 'pendidikan',
            'description' => 'Bantuan biaya sekolah dan buku untuk 20 anak pesisir selama satu semester.',
            'target_amount' => 5000000, 'deadline' => now()->addDays(45)->toDateString(),
            'status' => 'aktif', 'created_by' => $admin->id,
        ]);
        $c3 = Campaign::create([
            'title' => 'Kesehatan Gratis untuk Lansia',
            'category' => 'kesehatan',
            'description' => 'Pemeriksaan kesehatan dan obat gratis bagi lansia di tiga kelurahan.',
            'target_amount' => 7500000, 'deadline' => now()->addDays(20)->toDateString(),
            'status' => 'aktif', 'created_by' => $admin->id,
        ]);

        // Donasi terverifikasi (masuk progres/laporan) + satu menunggu (tidak dihitung)
        Donation::create(['campaign_id' => $c1->id, 'user_id' => $donaturA->id, 'amount' => 500000, 'method' => 'BCA', 'status' => 'terverifikasi', 'verified_by' => $admin->id, 'verified_at' => now(), 'message' => 'Semoga cepat pulih.']);
        Donation::create(['campaign_id' => $c1->id, 'user_id' => $donaturB->id, 'amount' => 250000, 'method' => 'DANA', 'status' => 'terverifikasi', 'verified_by' => $admin->id, 'verified_at' => now(), 'is_anonymous' => true]);
        Donation::create(['campaign_id' => $c2->id, 'user_id' => $donaturA->id, 'amount' => 1000000, 'method' => 'BRI', 'status' => 'terverifikasi', 'verified_by' => $admin->id, 'verified_at' => now()]);
        Donation::create(['campaign_id' => $c2->id, 'user_id' => $donaturB->id, 'amount' => 150000, 'method' => 'GoPay', 'status' => 'menunggu', 'message' => 'Menunggu verifikasi.']);

        Volunteer::create(['campaign_id' => $c1->id, 'user_id' => $donaturB->id, 'skill' => 'Logistik', 'availability' => 'Sabtu-Minggu', 'motivation' => 'Ingin membantu distribusi bantuan.', 'status' => 'diterima']);
        Volunteer::create(['campaign_id' => $c3->id, 'user_id' => $donaturA->id, 'skill' => 'Kesehatan', 'availability' => 'Senin-Jumat pagi', 'motivation' => 'Berpengalaman sebagai kader posyandu.', 'status' => 'menunggu']);

        Disbursement::create(['campaign_id' => $c1->id, 'amount' => 400000, 'recipient' => 'Pembelian sembako 50 paket', 'disbursed_at' => now()->toDateString(), 'description' => 'Sembako untuk warga terdampak banjir.', 'created_by' => $admin->id]);
    }
}
