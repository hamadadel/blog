<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    public $preventsLazyLoading = true;

    /**
     * Get the route key for the model.
     */
    // public function getRouteKeyName(): string
    // {
    //     return 'username';
    // }
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'username',
        'name',
        'email',
        'password',
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
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];
    public function getAvatarAttribute($value)
    {
        return ($value) ? $value :
            'storage/avatars/fallback-avatar.jpg';
    }
    public function follow(User $user)
    {
        return $this->follows()->save($user);
    }
    public function isFollowing(User $user)
    {
        return $this->follows()->wherePivot('followed_id', $user->id)->exists();
    }
    public function toggleFollow(User $user)
    {
        return $this->follows()->toggle($user);
    }
    // Relationships
    public function posts()
    {
        return $this->hasMany(Post::class, 'user_id')->latest();
    }

    public function follows()
    {
        return $this->belongsToMany(User::class, 'follows', 'follower_id', 'followed_id')
            ->withTimestamps();
    }

    // Users that i follow
    public function following()
    {
        return $this->BelongsToMany(User::class, 'follows', 'follower_id', 'followed_id');
    }
    // user that follow me,you can call them "fans" 
    public function followers()
    {
        return $this->BelongsToMany(User::class, 'follows', 'followed_id', 'follower_id');
    }

    public function timeline()
    {
        $followingList = [...$this->follows()->pluck('id'), $this->id];
        return Post::whereIn('user_id', $followingList)->latest()->paginate(5);
    }
}
