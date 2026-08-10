<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('post_views', function (Blueprint $table) {
            if (!Schema::hasColumn('post_views', 'country')) {
                $table->string('country', 100)->nullable()->after('ip_address');
            }
        });

        Schema::table('follows', function (Blueprint $table) {
            if (!Schema::hasColumn('follows', 'report_id')) {
                $table->foreignId('report_id')->nullable()->constrained('reports')->onDelete('set null')->after('following_id');
            }
        });
    }

    public function down(): void
    {
        Schema::table('post_views', function (Blueprint $table) {
            if (Schema::hasColumn('post_views', 'country')) {
                $table->dropColumn('country');
            }
        });

        Schema::table('follows', function (Blueprint $table) {
            if (Schema::hasColumn('follows', 'report_id')) {
                $table->dropForeign(['report_id']);
                $table->dropColumn('report_id');
            }
        });
    }
};
