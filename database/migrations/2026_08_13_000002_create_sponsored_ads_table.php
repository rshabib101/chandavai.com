<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasTable('sponsored_ads')) {
            Schema::create('sponsored_ads', function (Blueprint $table) {
                $table->id();
                $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
                $table->text('primary_text')->nullable();
                $table->string('media_type')->default('image'); // image, video
                $table->string('media_path')->nullable();
                $table->string('headline');
                $table->string('cta_text')->default('Order now'); // Order now, Shop now, Install now, Visit now, Apply now
                $table->string('destination_link');
                $table->string('placement')->default('both'); // feed, reels, both
                $table->boolean('is_active')->default(true);
                $table->unsignedInteger('views_count')->default(0);
                $table->unsignedInteger('clicks_count')->default(0);
                $table->timestamps();
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('sponsored_ads');
    }
};
