<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Post extends Model
{
    use Searchable;

    public function category()
    {
        return $this->belongsTo('App\\Category');
    }

    public function board()
    {
        return $this->belongsTo('App\\Board');
    }

    public function topic()
    {
        return $this->belongsTo('App\\Topic');
    }

    public function user()
    {
        return $this->belongsTo('App\\User');
    }

    public function toSearchableArray()
    {
        return [
            'body' => $this->body
        ];
    }
}
