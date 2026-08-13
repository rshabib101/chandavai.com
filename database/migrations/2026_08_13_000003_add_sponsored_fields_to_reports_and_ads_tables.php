<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('reports', function (Blueprint $table) {
            if (!Schema::hasColumn('reports', 'sponsored_ad_id')) {
                $table->foreignId('sponsored_ad_id')->nullable()->constrained('sponsored_ads')->onDelete('cascade');
            }
            if (!Schema::hasColumn('reports', 'cta_text')) {
                $table->string('cta_text')->nullable();
            }
            if (!Schema::hasColumn('reports', 'destination_link')) {
                $table->string('destination_link')->nullable();
            }
        });

        Schema::table('sponsored_ads', function (Blueprint $table) {
            if (!Schema::hasColumn('sponsored_ads', 'report_id')) {
                $table->foreignId('report_id')->nullable()->constrained('reports')->onDelete('cascade');
            }
        });
    }

    public function down(): void
    {
        Schema::table('reports', function (Blueprint $table) {
            if (Schema::hasColumn('reports', 'sponsored_ad_id')) {
                $table->dropForeign(['sponsored_ad_id']);
                $table->dropColumn(['sponsored_ad_id', 'cta_text', 'destination_link']);
            }
        });

        Schema::table('sponsored_ads', function (Blueprint $table) {
            if (Schema::hasColumn('sponsored_ads', 'report_id')) {
                $table->dropForeign(['report_id']);
                $table->dropColumn('report_id');
            }
        });
    }
};
