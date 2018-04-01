<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use YoHang88\LetterAvatar\LetterAvatar;

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

    public function group()
    {
        return $this->belongsTo('App\\Group');
    }

    public function avatarUrl()
    {
        if (!empty($this->avatar_url)) {
            return $this->avatar_url;
        }

        $avatar = new LetterAvatar($this->name, 'square', 128);
        return $avatar->__toString();
    }
}
