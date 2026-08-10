<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('phone')->nullable();
            $table->string('whatsapp')->nullable();
            $table->text('bio')->nullable();
            $table->string('category')->nullable();
            $table->string('hometown')->nullable();
            $table->string('work')->nullable();
            $table->string('education')->nullable();
            $table->string('relationship_status')->nullable();
            $table->date('birthdate')->nullable();
            $table->string('gender')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'phone',
                'whatsapp',
                'bio',
                'category',
                'hometown',
                'work',
                'education',
                'relationship_status',
                'birthdate',
                'gender'
            ]);
        });
    }
};
