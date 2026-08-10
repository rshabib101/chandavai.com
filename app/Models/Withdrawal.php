<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Withdrawal extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'coins',
        'amount_bdt',
        'payment_method',
        'account_number',
        'status',
        'admin_note',
    ];

    protected function casts(): array
    {
        return [
            'coins' => 'float',
            'amount_bdt' => 'float',
        ];
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
