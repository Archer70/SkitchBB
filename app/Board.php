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
}
