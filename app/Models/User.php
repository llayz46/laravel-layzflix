<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Storage;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'username',
        'email',
        'avatar',
        'bio',
        'favorite_films',
        'password',
        'level',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
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
        ];
    }

    public function imageUrl(): string
    {
        return Storage::disk('public')->url($this->avatar);
    }

    public function reviews(): HasMany
    {
        return $this->hasMany(Review::class);
    }

    public function followers(): HasMany
    {
        return $this->hasMany(Follower::class);
    }

    public function isFollowing(User $user): bool
    {
        return Follower::where('user_id', $this->id)
            ->where('friend_id', $user->id)
            ->exists();
    }

    public function messagesSent(): HasMany
    {
        return $this->hasMany(Message::class, 'sender_id');
    }

    public function messagesReceived(): HasMany
    {
        return $this->hasMany(Message::class, 'receiver_id');
    }

    public function userLevel(): void
    {
        $reviews = $this->reviews()->count();

        $userLevel = match (true) {
            $reviews < 5 => 1,
            default => ceil($reviews / 5),
        };

        $this->update([
            'level' => $userLevel,
        ]);
    }

    public function isPremium(): bool
    {
        if ($this->premium) {
            return true;
        }

        return false;
    }
}
