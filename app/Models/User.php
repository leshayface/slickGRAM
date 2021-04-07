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

    public function getAvatarAttribute() {
        return "https://i.pravatar.cc/40?u=" . $this->email;
    }

    public function timeline()
    {
        return Slick::latest()->get();
    }

    public function follow(User $user) {
        return $this->follows()->save($user)
    }

    public function follows() {
        //be explicit that table name is not user_user. Also specify ids.
        return $this->belongsToMany(User::class, 'follows', 'user_id', 'following_user_id');
    }
}
