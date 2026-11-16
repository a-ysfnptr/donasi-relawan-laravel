<?php

namespace Tests\Feature;

use App\Models\Campaign;
use App\Models\Donation;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SecurityTest extends TestCase
{
    use RefreshDatabase;

    private function user(array $attrs = []): User
    {
        return User::factory()->create($attrs);
    }

    private function campaign(): Campaign
    {
        return Campaign::factory()->create([
            'status' => 'aktif', 'target_amount' => 1000000,
            'deadline' => now()->addDays(10)->toDateString(),
            'created_by' => $this->user(['email' => 'admin-test@donasi.local', 'role' => 'admin'])->id,
        ]);
    }

    /** @test */
    public function registrasi_tidak_bisa_memanipulasi_peran_menjadi_admin()
    {
        $this->post('/register', [
            'name' => 'Penyusup', 'email' => 'penyusup@donasi.local',
            'password' => 'Rahasia123!', 'password_confirmation' => 'Rahasia123!',
            'role' => 'admin', // manipulasi parameter — harus diabaikan
        ]);
        $this->assertDatabaseHas('users', ['email' => 'penyusup@donasi.local', 'role' => 'user']);
        $this->assertDatabaseMissing('users', ['email' => 'penyusup@donasi.local', 'role' => 'admin']);
    }

    /** @test */
    public function donatur_tidak_bisa_melihat_donasi_donatur_lain_idor()
    {
        $a = $this->user(['email' => 'a@donasi.local']);
        $b = $this->user(['email' => 'b@donasi.local']);
        $donation = Donation::create([
            'campaign_id' => $this->campaign()->id, 'user_id' => $a->id,
            'amount' => 100000, 'method' => 'BCA', 'status' => 'menunggu',
        ]);
        $this->actingAs($b)->get('/donations/'.$donation->id)->assertForbidden();
        $this->actingAs($a)->get('/donations/'.$donation->id)->assertOk();
    }

    /** @test */
    public function user_biasa_tidak_bisa_membuka_halaman_admin()
    {
        $this->actingAs($this->user())->get('/admin/dashboard')->assertForbidden();
        $this->actingAs($this->user(['role' => 'admin']))->get('/admin/dashboard')->assertOk();
    }

    /** @test */
    public function login_berulang_dibatasi_rate_limit()
    {
        for ($i = 0; $i < 6; $i++) {
            $this->post('/login', ['email' => 'tidakada@donasi.local', 'password' => 'salah123']);
        }
        $this->post('/login', ['email' => 'tidakada@donasi.local', 'password' => 'salah123'])
            ->assertStatus(429);
    }

    /** @test */
    public function penyaluran_tidak_boleh_melebihi_sisa_dana()
    {
        $admin = $this->user(['role' => 'admin']);
        $campaign = $this->campaign();
        $donor = $this->user(['email' => 'donor@donasi.local']);
        Donation::create(['campaign_id' => $campaign->id, 'user_id' => $donor->id, 'amount' => 100000, 'method' => 'BCA', 'status' => 'terverifikasi']);
        $this->actingAs($admin)->post('/admin/disbursements', [
            'campaign_id' => $campaign->id, 'amount' => 200000,
            'recipient' => 'Tes', 'disbursed_at' => now()->toDateString(),
        ])->assertSessionHasErrors('amount');
        $this->assertDatabaseMissing('disbursements', ['amount' => 200000]);
    }

    /** @test */
    public function hanya_donasi_terverifikasi_yang_dihitung_progres()
    {
        $campaign = $this->campaign();
        $donor = $this->user(['email' => 'donor2@donasi.local']);
        Donation::create(['campaign_id' => $campaign->id, 'user_id' => $donor->id, 'amount' => 100000, 'method' => 'BCA', 'status' => 'menunggu']);
        Donation::create(['campaign_id' => $campaign->id, 'user_id' => $donor->id, 'amount' => 50000, 'method' => 'BCA', 'status' => 'terverifikasi']);
        $this->assertEquals(50000, $campaign->fresh()->verifiedTotal());
    }

    /** @test */
    public function kata_sandi_tersimpan_sebagai_hash_bukan_plaintext()
    {
        $user = $this->user(['email' => 'hash@donasi.local']);
        $this->assertNotEquals('password', $user->password);
        $this->assertTrue(\Illuminate\Support\Facades\Hash::check('password', $user->password));
    }
}
