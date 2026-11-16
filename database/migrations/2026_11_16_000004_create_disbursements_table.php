<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('disbursements', function (Blueprint $table) {
            $table->id();
            $table->foreignId('campaign_id')->constrained()->cascadeOnDelete();
            $table->bigInteger('amount');
            $table->string('recipient', 200);
            $table->date('disbursed_at');
            $table->text('description')->nullable();
            $table->string('proof_file')->nullable();
            $table->foreignId('created_by')->constrained('users')->cascadeOnDelete();
            $table->timestamps();
            $table->index(['campaign_id', 'disbursed_at']);
        });
        if (\Illuminate\Support\Facades\Schema::getConnection()->getDriverName() === 'pgsql') {
            \Illuminate\Support\Facades\DB::statement('ALTER TABLE disbursements ADD CONSTRAINT disbursements_amount_positive CHECK (amount > 0)');
        }
    }
    public function down(): void { Schema::dropIfExists('disbursements'); }
};
