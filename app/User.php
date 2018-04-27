<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use YoHang88\LetterAvatar\LetterAvatar;
use Laravel\Scout\Searchable;


class User extends Authenticatable
{
    use Notifiable;
    use Searchable;

    const ADMIN_GROUP = 2;

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

    public function topics()
    {
        return $this->hasMany('App\\Topic');
    }

    public function posts()
    {
        return $this->hasMany('App\\Post');
    }

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

    public function isAdmin()
    {
        return $this->group->id === self::ADMIN_GROUP;
    }

    public function toSearchableArray()
    {
        return [
            'name' => $this->name,
            'email' => $this->email
        ];
    }
}
