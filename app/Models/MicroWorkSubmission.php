<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MicroWorkSubmission extends Model
{
    use HasFactory;

    protected $fillable = [
        'micro_work_id',
        'user_id',
        'proof_screenshot',
        'status',
        'rejection_reason',
    ];

    public function microWork()
    {
        return $this->belongsTo(MicroWork::class, 'micro_work_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function getProofScreenshotUrlAttribute(): ?string
    {
        if (!empty($this->proof_screenshot)) {
            return asset('storage/' . $this->proof_screenshot);
        }
        return null;
    }
}
