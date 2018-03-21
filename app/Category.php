<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public function boards()
    {
        return $this->hasMany('App\\Board');
    }
}
