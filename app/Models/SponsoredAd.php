<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SponsoredAd extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'report_id',
        'primary_text',
        'media_type',
        'media_path',
        'headline',
        'cta_text',
        'destination_link',
        'placement',
        'is_active',
        'views_count',
        'clicks_count',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'views_count' => 'integer',
        'clicks_count' => 'integer',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function report()
    {
        return $this->belongsTo(Report::class);
    }

    public function getMediaUrlAttribute(): ?string
    {
        if (!empty($this->media_path)) {
            return asset('storage/' . $this->media_path);
        }
        return null;
    }
}
