<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Board extends Model
{
    public function category()
    {
        return $this->belongsTo('App\\Category');
    }

    public function topics()
    {
        return $this->hasMany('App\\Topic');
    }

    public function posts()
    {
        return $this->hasMany('App\\Post');
    }

    public function lastPost()
    {
        return Post::where('board_id', $this->id)
            ->orderBy('id', 'desc')
            ->limit(1)
            ->get()
            ->last();
    }
}
