<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('daily_challenge_claims', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->date('claim_date');
            $table->integer('reward_points')->default(100);
            $table->timestamps();

            $table->unique(['user_id', 'claim_date']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('daily_challenge_claims');
    }
};
