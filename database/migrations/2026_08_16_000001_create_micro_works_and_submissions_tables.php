<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // 1. micro_works table
        Schema::create('micro_works', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('category')->default('WEBSITE');
            $table->integer('reward_coins')->default(100);
            $table->integer('total_slots')->default(20);
            $table->string('task_link')->nullable();
            $table->text('instruction')->nullable();
            $table->string('demo_screenshot')->nullable();
            $table->integer('required_proofs_count')->default(1);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        // 2. micro_work_submissions table
        Schema::create('micro_work_submissions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('micro_work_id')->constrained('micro_works')->onDelete('cascade');
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->string('proof_screenshot');
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending');
            $table->string('rejection_reason')->nullable();
            $table->timestamps();
        });

        // 3. link_hits table
        Schema::create('link_hits', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('url');
            $table->integer('reward_points')->default(20);
            $table->integer('timer_seconds')->default(10);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        // Seed initial sample micro works matching the UI
        DB::table('micro_works')->insert([
            [
                'title' => 'MUKTO MONEY BD',
                'category' => 'WEBSITE',
                'reward_coins' => 150,
                'total_slots' => 20,
                'task_link' => 'https://muktomoney.blogspot.com',
                'instruction' => "প্রমাণ চাই: নির্দেশনা: ১. প্রথমে লিংকে ক্লিক করে গুগল যান। ২. টাইটেলে দেওয়া লেখাটি দিয়ে সার্চ করুন। ৩. আমাদের সাইট (muktomoney.blogspot.com) খুঁজে বের করে পোস্টটি ওপেন করুন। ৪. ১ মিনিট পড়ার পর \"সিক্রেট কোড\" বাটন আসবে। ৫. বাটনে ক্লিক করে একটি অ্যাড ৯০ সেকেন্ড দেখুন এবং কোডটি সংগ্রহ করুন। ৬. ভুল কোড দিলে পেমেন্ট পাবেন না। আপনার ব্লগের সেই \"সার্কেল টাইমার\" অথবা \"সিক্রেট কোড বক্স\" এর একটি ছবি এখানে আপলোড করে দিন। (যাতে ইউজার বুঝতে পারে কোড কোথায় থাকে)।",
                'demo_screenshot' => null,
                'required_proofs_count' => 1,
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'গুগল সার্চ করে ১০০ কয়েন নিন',
                'category' => 'WEBSITE',
                'reward_coins' => 100,
                'total_slots' => 20,
                'task_link' => 'https://google.com',
                'instruction' => 'গুগলে সার্চ করে ওয়েবসাইট ভিজিট করুন এবং সিক্রেট কোডের স্ক্রিনশট আপলোড করুন।',
                'demo_screenshot' => null,
                'required_proofs_count' => 1,
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'গুগল সার্চ করে ২০০ কয়েন নিন',
                'category' => 'WEBSITE',
                'reward_coins' => 200,
                'total_slots' => 40,
                'task_link' => 'https://google.com',
                'instruction' => 'সাইটে ২ মিনিট অবস্থান করুন এবং বিজ্ঞাপন ক্লিকের স্ক্রিনশট প্রদান করুন।',
                'demo_screenshot' => null,
                'required_proofs_count' => 1,
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'গুগল সার্চ স্পেশাল টাস্ক',
                'category' => 'WEBSITE',
                'reward_coins' => 100,
                'total_slots' => 30,
                'task_link' => 'https://google.com',
                'instruction' => 'স্পেশাল কিওয়ার্ড দিয়ে সার্চ করে লিংকটি ওপেন করুন এবং প্রুফ আপলোড করুন।',
                'demo_screenshot' => null,
                'required_proofs_count' => 1,
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);

        // Seed sample link hits
        DB::table('link_hits')->insert([
            [
                'title' => 'Chanda Vai Store Offer',
                'url' => 'https://chandavai.com/shop',
                'reward_points' => 20,
                'timer_seconds' => 10,
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Tech News & Gadgets',
                'url' => 'https://example.com/tech',
                'reward_points' => 20,
                'timer_seconds' => 10,
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('micro_work_submissions');
        Schema::dropIfExists('micro_works');
        Schema::dropIfExists('link_hits');
    }
};
