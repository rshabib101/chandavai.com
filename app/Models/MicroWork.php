<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MicroWork extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'category',
        'reward_coins',
        'total_slots',
        'task_link',
        'instruction',
        'demo_screenshot',
        'required_proofs_count',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'reward_coins' => 'integer',
        'total_slots' => 'integer',
        'required_proofs_count' => 'integer',
    ];

    public function submissions()
    {
        return $this->hasMany(MicroWorkSubmission::class, 'micro_work_id');
    }

    public function approvedSubmissions()
    {
        return $this->hasMany(MicroWorkSubmission::class, 'micro_work_id')->where('status', 'approved');
    }

    public function getApprovedCountAttribute()
    {
        return $this->approvedSubmissions()->count();
    }

    public function getRemainingSlotsAttribute()
    {
        $remaining = $this->total_slots - $this->approved_count;
        return max(0, $remaining);
    }

    public function getDemoScreenshotUrlAttribute(): ?string
    {
        if (!empty($this->demo_screenshot)) {
            return asset('storage/' . $this->demo_screenshot);
        }
        return null;
    }
}
