<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserNotification extends Model
{
    protected $fillable = [
        'user_id',
        'sender_id',
        'type',
        'title',
        'message',
        'link',
        'is_read',
    ];

    protected $casts = [
        'is_read' => 'boolean',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function sender()
    {
        return $this->belongsTo(User::class, 'sender_id');
    }

    public static function createNotification($userId, $senderId, $type, $title, $message, $link = null)
    {
        if ($userId == $senderId) {
            return null; // Don't notify self
        }

        return static::create([
            'user_id' => $userId,
            'sender_id' => $senderId,
            'type' => $type,
            'title' => $title,
            'message' => $message,
            'link' => $link,
            'is_read' => false,
        ]);
    }
}
