<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ResellerSurvey extends Model
{
    protected $fillable = [
        'full_name',
        'mobile',
        'facebook',
        'district',
        'profession',
        'business_before',
        'platform',
        'product',
        'monthly_target',
        'stock_type',
        'package',
        'reason',
        'agreement'
    ];
}
