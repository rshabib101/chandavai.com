<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasTable('withdrawals')) {
            Schema::create('withdrawals', function (Blueprint $table) {
                $table->id();
                $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
                $table->decimal('coins', 12, 2);
                $table->decimal('amount_bdt', 12, 2);
                $table->string('payment_method');
                $table->string('account_number');
                $table->string('status')->default('pending'); // pending, approved, rejected, completed
                $table->string('admin_note')->nullable();
                $table->timestamps();
            });
        }

        Schema::table('users', function (Blueprint $table) {
            if (Schema::hasColumn('users', 'points')) {
                $table->decimal('points', 12, 2)->default(0)->change();
            }
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('withdrawals');

        Schema::table('users', function (Blueprint $table) {
            if (Schema::hasColumn('users', 'points')) {
                $table->integer('points')->default(0)->change();
            }
        });
    }
};
