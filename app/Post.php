<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;
use App\Utils\Markdown;
use Carbon\Carbon;

class Post extends Model
{
    use Searchable;

    protected $fillable = ['category_id', 'board_id', 'topic_id', 'user_id', 'body', 'likes', 'approved'];

    protected $appends = ['markdownBody', 'timeSincePosted'];

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

    public function getMarkdownBodyAttribute()
    {
        return Markdown::render($this->body);
    }

    public function getTimeSincePostedAttribute()
    {
        return $this->updated_at->diffForHumans();
    }

    public function toSearchableArray()
    {
        return [
            'body' => $this->body
        ];
    }
}
