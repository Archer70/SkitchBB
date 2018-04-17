<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['title', 'description'];

    public function boards()
    {
        return $this->hasMany('App\\Board');
    }

    public function lastPost()
    {
        return Post::where('category_id', $this->id)
            ->orderBy('id', 'desc')
            ->limit(1)
            ->get()
            ->last();
    }
}
