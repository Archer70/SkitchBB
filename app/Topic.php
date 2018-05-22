<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Laravel\Scout\Searchable;
use App\ReadTopic;
use App\User;

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

    public function markRead(User $user)
    {
        $alreadyMarkedRead = ReadTopic::where([
            ['user_id', '=', $user->id],
            ['topic_id', '=', $this->id]
        ])->first();
        if ($alreadyMarkedRead) {
            return;
        }

        ReadTopic::create(['user_id' => $user->id, 'topic_id' => $this->id]);
    }

    public function markUnread(User $user=null)
    {
        $whereConditions = [
            ['topic_id', '=', $this->id],
        ];
        if ($user) {
            $whereConditions[] = ['user_id', '<>', $user->id];
        }

        ReadTopic::where($whereConditions)->delete();
    }

    public function toSearchableArray()
    {
        return [
            'title' => $this->title
        ];
    }
}
