<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TopicSubscriptions extends Model
{
    protected $fillable = ['topic_id', 'user_id'];
}
