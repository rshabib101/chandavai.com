<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            if (!Schema::hasColumn('users', 'points')) {
                $table->integer('points')->default(0)->after('password');
            }
            if (!Schema::hasColumn('users', 'is_monetized')) {
                $table->boolean('is_monetized')->default(false)->after('points');
            }
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['points', 'is_monetized']);
        });
    }
};
