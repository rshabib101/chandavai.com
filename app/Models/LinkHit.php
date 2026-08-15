<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LinkHit extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'url',
        'reward_points',
        'timer_seconds',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'reward_points' => 'integer',
        'timer_seconds' => 'integer',
    ];
}
