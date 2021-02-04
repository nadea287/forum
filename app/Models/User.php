<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected static function boot()
    {
        parent::boot();
        static::created(function ($user) {
            $user->profile()->create([
               'image' => '/profile/vEqHv71XVdKjX5kM5EpWjuvwaknfknGMGqe8HxaJ.jpeg',
            ]);
        });
    }

    public function threads()
    {
        return $this->hasMany(Thread::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function hasFlaged()
    {
        return $this->hasMany(Flag::class, 'author_id');
    }

    public function getSolution()
    {
        return $this->hasFlaged()->where('type', 'solution');
    }

    public function profile()
    {
        return $this->hasOne(Profile::class);
    }

//    public function getRouteKeyName()
//    {
//        return 'name';
//    }

public function feeds()
{
    return $this->hasMany(Feed::class);
}

public function orders()
{
    return $this->hasMany(Order::class);
}
}
