<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
protected $fillable = [
    'title',
    'description',
    'location',
    'category',
    'status',
    'image',
    'video_url',
    'is_anonymous'
];

}
