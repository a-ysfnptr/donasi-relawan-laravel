<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('volunteers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('campaign_id')->constrained()->cascadeOnDelete();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->string('skill', 100);
            $table->string('availability', 100);
            $table->text('motivation')->nullable();
            $table->string('status', 20)->default('menunggu'); // menunggu|diterima|ditolak|dibatalkan
            $table->timestamps();
            $table->unique(['campaign_id', 'user_id']); // BR-04: satu pendaftaran per kampanye
            $table->index(['campaign_id', 'status']);
        });
    }
    public function down(): void { Schema::dropIfExists('volunteers'); }
};
