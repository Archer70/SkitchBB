<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Topic extends Model
{
    protected $appends = ['link'];

    public function getLinkAttribute()
    {
        return route('topic.show', ['slug' => $this->slug]);
    }

    public function board()
    {
        return $this->belongsTo('App\\Board');
    }

    public function user()
    {
        return $this->belongsTo('App\\User');
    }

    public function firstPost()
    {
        return $this->hasOne('App\\Post', 'id', 'first_post_id');
    }

    public function lastPost()
    {
        return $this->hasOne('App\\Post', 'id', 'last_post_id');
    }

    public function posts()
    {
        return $this->hasMany('App\\Post');
    }
}