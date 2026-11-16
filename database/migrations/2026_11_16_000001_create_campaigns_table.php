<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('campaigns', function (Blueprint $table) {
            $table->id();
            $table->string('title', 200);
            $table->string('category', 50);
            $table->text('description');
            $table->bigInteger('target_amount')->default(0);
            $table->date('deadline')->nullable();
            $table->string('status', 20)->default('draft'); // draft|aktif|ditutup|selesai
            $table->string('cover_image')->nullable();
            $table->foreignId('created_by')->constrained('users')->cascadeOnDelete();
            $table->timestamps();
            $table->index(['status', 'category']);
        });
    }
    public function down(): void { Schema::dropIfExists('campaigns'); }
};
