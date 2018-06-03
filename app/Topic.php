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

    public function subscribe()
    {
        $exists = TopicSubscriptions::where([
            ['user_id', '=', auth()->user()->id],
            ['topic_id', '=', $this->id]
        ])->first();
        if ($exists) {
            return;
        }

        TopicSubscriptions::create([
            'user_id' => auth()->user()->id,
            'topic_id' => $this->id
        ]);
    }

    public function unsubscribe()
    {
        $exists = TopicSubscriptions::where([
            ['user_id', '=', auth()->user()->id],
            ['topic_id', '=', $this->id]
        ])->delete();
    }

    public function subscribed()
    {
        if (!auth()->check()) {
            return false;
        }
        $exists = TopicSubscriptions::where([
            ['user_id', '=', auth()->user()->id],
            ['topic_id', '=', $this->id]
        ])->first();
        return (boolean) $exists;
    }

    public function subscribedUsers(User $excludingUser=null)
    {
        $where = [
            ['topic_id', '=', $this->id]
        ];
        if ($excludingUser) {
            $where[] = ['user_id', '<>', $excludingUser->id];
        }

        return User::whereIn(
            'id',
            TopicSubscriptions::select('user_id')->where($where)
        )
        ->get();
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
