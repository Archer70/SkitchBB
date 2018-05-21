<?php

namespace App;

use Illuminate\Support\Facades\Auth;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Scout\Searchable;


class User extends Authenticatable
{
    use Notifiable;
    use Searchable;

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

    protected $appends = ['avatarUrl'];

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

    public function hasCustomAvatar()
    {
        return (bool)$this->avatar_url;
    }

    public function avatarUrl()
    {
        if (!empty($this->avatar_url)) {
            return $this->avatar_url;
        }

        return sprintf('https://www.gravatar.com/avatar/%s?s=128&d=identicon&r=g', md5($this->email));
    }

    public function getAvatarUrlAttribute()
    {
        return $this->avatarUrl();
    }

    public function isAdmin()
    {
        return !is_null($this->group) && $this->group->id == env('USER_GROUP_ADMIN');
    }

    public function toSearchableArray()
    {
        return [
            'name' => $this->name,
            'email' => $this->email
        ];
    }
}
