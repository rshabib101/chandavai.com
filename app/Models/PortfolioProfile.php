<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PortfolioProfile extends Model
{
    protected $fillable = [
        'brand_name',
        'headline',
        'tagline',
        'about',
        'hero_image',
        'email',
        'phone',
        'address',
        'facebook_url',
        'linkedin_url',
        'website_url',
        'cta_text',
        'cta_url',
        'stats',
        'services',
        'projects',
        'testimonials',
        'skills',
        'is_published',
    ];

    protected $casts = [
        'stats' => 'array',
        'services' => 'array',
        'projects' => 'array',
        'testimonials' => 'array',
        'skills' => 'array',
        'is_published' => 'boolean',
    ];

    public static function defaultData(): array
    {
        return [
            'brand_name' => 'Digital Growth Studio',
            'headline' => 'Digital marketing that brings measurable growth',
            'tagline' => 'I help brands get more leads, better content, and stronger online visibility through practical digital marketing.',
            'about' => 'A simple, conversion-focused portfolio for digital marketing work. Manage this content from the admin panel and keep your public portfolio fresh.',
            'hero_image' => 'https://images.unsplash.com/photo-1556761175-b413da4baf72?auto=format&fit=crop&w=1400&q=80',
            'email' => 'hello@example.com',
            'phone' => '+880 1700 000000',
            'address' => 'Dhaka, Bangladesh',
            'facebook_url' => '#',
            'linkedin_url' => '#',
            'website_url' => '#',
            'cta_text' => 'Start a Project',
            'cta_url' => '#contact',
            'stats' => [
                ['label' => 'Campaigns', 'value' => '80+'],
                ['label' => 'Happy Clients', 'value' => '35+'],
                ['label' => 'Avg. Growth', 'value' => '2.4x'],
            ],
            'services' => [
                ['title' => 'Social Media Marketing', 'description' => 'Content planning, post design direction, page growth, and campaign management.'],
                ['title' => 'Paid Ads', 'description' => 'Facebook and Google ad campaigns focused on leads, sales, and return on spend.'],
                ['title' => 'SEO & Content', 'description' => 'Keyword research, content strategy, and on-page optimization for organic growth.'],
            ],
            'projects' => [
                ['title' => 'Local Brand Launch', 'category' => 'Social Campaign', 'description' => 'Built awareness and generated qualified customer inquiries in the first month.'],
                ['title' => 'Lead Generation Funnel', 'category' => 'Paid Ads', 'description' => 'Created a simple funnel that improved lead quality and reduced wasted ad spend.'],
                ['title' => 'SEO Content Plan', 'category' => 'Organic Growth', 'description' => 'Mapped search topics and content priorities for long-term organic traffic.'],
            ],
            'testimonials' => [
                ['name' => 'Client Name', 'role' => 'Business Owner', 'quote' => 'The work was clear, practical, and helped us understand where our marketing money should go.'],
            ],
            'skills' => ['Meta Ads', 'Google Ads', 'SEO', 'Analytics', 'Content Strategy', 'Brand Positioning'],
            'is_published' => true,
        ];
    }

    public static function firstOrCreateDefault(): self
    {
        return self::firstOrCreate([], self::defaultData());
    }
}
