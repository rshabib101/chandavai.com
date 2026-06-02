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
        Schema::create('reseller_surveys', function (Blueprint $table) {
            $table->id();

            $table->string('full_name');
            $table->string('mobile');
            $table->string('facebook');
            $table->string('district');
            $table->string('profession');

            $table->string('business_before');
            $table->string('platform');
            $table->string('product');
            $table->string('monthly_target');
            $table->string('stock_type');
            $table->string('package');

            $table->text('reason')->nullable();

            $table->boolean('agreement')->default(false);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reseller_surveys');
    }
};
