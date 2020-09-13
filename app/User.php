<?php

namespace App;

use App\Message;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function messages()
    {
        return $this->hasMany(Message::class);
    }
    public function following()
    {
        return $this->belongsToMany(User::class, 'followers', 'user_id', 'following_id')->withTimestamps();
    }
    public function followers()
    {
        return $this->belongsToMany(User::class, 'followers', 'following_id', 'user_id')->withTimestamps();
    }

    public function isFollowing($user)
    {
        return $this->following()->where('following_id', $user->id)->count();
    }
}
