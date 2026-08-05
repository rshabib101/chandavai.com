<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DailyChallengeClaim extends Model
{
    protected $fillable = [
        'user_id',
        'claim_date',
        'reward_points',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
