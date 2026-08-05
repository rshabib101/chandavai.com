<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    protected $fillable = [
        'user_id',
        'title',
        'description',
        'location',
        'category',
        'status',
        'image',
        'images',
        'video',
        'video_url',
        'is_anonymous'
    ];

    protected $casts = [
        'images' => 'array',
        'is_anonymous' => 'boolean',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function reactions()
    {
        return $this->hasMany(Reaction::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function views()
    {
        return $this->hasMany(PostView::class);
    }

    public function starTransactions()
    {
        return $this->hasMany(StarTransaction::class);
    }

    public function getImageListAttribute(): array
    {
        if (!empty($this->images) && is_array($this->images)) {
            return $this->images;
        }
        if (!empty($this->image)) {
            return [$this->image];
        }
        return [];
    }
}


