<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            if (!Schema::hasColumn('users', 'last_ip_address')) {
                $table->string('last_ip_address')->nullable();
            }
            if (!Schema::hasColumn('users', 'country')) {
                $table->string('country')->nullable();
            }
            if (!Schema::hasColumn('users', 'city')) {
                $table->string('city')->nullable();
            }
            if (!Schema::hasColumn('users', 'browser')) {
                $table->string('browser')->nullable();
            }
            if (!Schema::hasColumn('users', 'operating_system')) {
                $table->string('operating_system')->nullable();
            }
            if (!Schema::hasColumn('users', 'screen_resolution')) {
                $table->string('screen_resolution')->nullable();
            }
            if (!Schema::hasColumn('users', 'language')) {
                $table->string('language')->nullable();
            }
            if (!Schema::hasColumn('users', 'timezone')) {
                $table->string('timezone')->nullable();
            }
            if (!Schema::hasColumn('users', 'referrer')) {
                $table->text('referrer')->nullable();
            }
            if (!Schema::hasColumn('users', 'device_type')) {
                $table->string('device_type')->nullable();
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'last_ip_address',
                'country',
                'city',
                'browser',
                'operating_system',
                'screen_resolution',
                'language',
                'timezone',
                'referrer',
                'device_type',
            ]);
        });
    }
};
