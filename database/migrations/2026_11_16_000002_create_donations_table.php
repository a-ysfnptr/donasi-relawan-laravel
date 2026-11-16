<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('donations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('campaign_id')->constrained()->cascadeOnDelete();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->bigInteger('amount');
            $table->string('method', 30);
            $table->string('proof_file')->nullable();
            $table->tinyInteger('is_anonymous')->default(0);
            $table->text('message')->nullable();
            $table->string('status', 20)->default('menunggu'); // menunggu|terverifikasi|ditolak|dibatalkan
            $table->foreignId('verified_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamp('verified_at')->nullable();
            $table->text('reject_reason')->nullable();
            $table->timestamps();
            $table->index(['campaign_id', 'status']);
            $table->index(['user_id', 'status']);
        });
        // Nominal harus positif — ditegakkan juga di database, bukan hanya di form.
        // CHECK constraint hanya di PostgreSQL (Neon); SQLite tidak mendukung ADD CONSTRAINT.
        if (\Illuminate\Support\Facades\Schema::getConnection()->getDriverName() === 'pgsql') {
            \Illuminate\Support\Facades\DB::statement('ALTER TABLE donations ADD CONSTRAINT donations_amount_positive CHECK (amount >= 1000)');
        }
    }
    public function down(): void { Schema::dropIfExists('donations'); }
};
