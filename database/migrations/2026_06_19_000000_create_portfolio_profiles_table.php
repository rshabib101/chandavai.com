<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('portfolio_profiles', function (Blueprint $table) {
            $table->id();
            $table->string('brand_name')->default('Digital Growth Studio');
            $table->string('headline')->default('Digital marketing that brings measurable growth');
            $table->text('tagline')->nullable();
            $table->text('about')->nullable();
            $table->string('hero_image')->nullable();
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->string('address')->nullable();
            $table->string('facebook_url')->nullable();
            $table->string('linkedin_url')->nullable();
            $table->string('website_url')->nullable();
            $table->string('cta_text')->default('Start a Project');
            $table->string('cta_url')->nullable();
            $table->json('stats')->nullable();
            $table->json('services')->nullable();
            $table->json('projects')->nullable();
            $table->json('testimonials')->nullable();
            $table->json('skills')->nullable();
            $table->boolean('is_published')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('portfolio_profiles');
    }
};
