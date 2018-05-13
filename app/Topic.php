<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Laravel\Scout\Searchable;

class Topic extends Model
{
    use Sluggable;
    use Searchable;

    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }

    protected $appends = ['link'];

    public function getLinkAttribute()
    {
        return route('topics.show', ['topic' => $this, 'slug' => $this->slug]);
    }

    public function board()
    {
        return $this->belongsTo('App\\Board');
    }

    public function user()
    {
        return $this->belongsTo('App\\User');
    }

    public function getFirstPostAttribute()
    {
        return $this->posts()->orderBy('id', 'asc')->first();
    }

    public function getLastPostAttribute()
    {
        return $this->posts()->orderBy('id', 'desc')->first();
    }

    public function posts()
    {
        return $this->hasMany('App\\Post');
    }

    public function toSearchableArray()
    {
        return [
            'title' => $this->title
        ];
    }
}
