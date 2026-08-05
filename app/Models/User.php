<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'points',
        'is_monetized',
        'is_blocked',
        'referral_code',
        'referred_by_id',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'is_monetized' => 'boolean',
            'is_blocked' => 'boolean',
        ];
    }

    public function isAdmin(): bool
    {
        return $this->role === 'admin' || $this->role === 'super_admin';
    }

    public function isUser(): bool
    {
        return !$this->isAdmin();
    }

    public function reports()
    {
        return $this->hasMany(Report::class);
    }

    public function reactions()
    {
        return $this->hasMany(Reaction::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function followers()
    {
        return $this->hasMany(Follow::class, 'following_id');
    }

    public function following()
    {
        return $this->hasMany(Follow::class, 'follower_id');
    }

    public function dailyChallengeClaims()
    {
        return $this->hasMany(DailyChallengeClaim::class);
    }

    public function userNotifications()
    {
        return $this->hasMany(UserNotification::class)->latest();
    }

    public function unreadNotificationsCount()
    {
        return $this->userNotifications()->where('is_read', false)->count();
    }

    public function sentStars()
    {
        return $this->hasMany(StarTransaction::class, 'sender_id');
    }

    public function receivedStars()
    {
        return $this->hasMany(StarTransaction::class, 'receiver_id');
    }

    public function isFollowing($targetUserId)
    {
        return $this->following()->where('following_id', $targetUserId)->exists();
    }

    public function getFollowersCountAttribute()
    {
        return $this->followers()->count();
    }

    public function getFollowingCountAttribute()
    {
        return $this->following()->count();
    }

    public function referrer()
    {
        return $this->belongsTo(User::class, 'referred_by_id');
    }

    public function referrals()
    {
        return $this->hasMany(User::class, 'referred_by_id');
    }

    public function getMonthlyReferralsCountAttribute()
    {
        return $this->referrals()
            ->whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year)
            ->count();
    }

    public function getReferralLinkAttribute()
    {
        if (!$this->referral_code) {
            $this->referral_code = static::generateUniqueReferralCode();
            $this->save();
        }
        return url('/register?ref=' . $this->referral_code);
    }

    public static function generateUniqueReferralCode()
    {
        do {
            $code = strtoupper(\Illuminate\Support\Str::random(6));
        } while (static::where('referral_code', $code)->exists());

        return $code;
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($user) {
            if (empty($user->referral_code)) {
                $user->referral_code = static::generateUniqueReferralCode();
            }
        });
    }

    public function checkMonetizationEligibility()
    {
        $minFollowers = (int) Setting::get('min_followers_for_income', 20);
        $eligible = $this->followers_count >= $minFollowers;

        if ($eligible && !$this->is_monetized) {
            $this->is_monetized = true;
            $this->save();
        } elseif (!$eligible && $this->is_monetized) {
            $this->is_monetized = false;
            $this->save();
        }

        return [
            'eligible' => $eligible,
            'current' => $this->followers_count,
            'required' => $minFollowers,
        ];
    }
}
