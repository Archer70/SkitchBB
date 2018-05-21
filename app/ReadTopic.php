<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ReadTopic extends Model
{
    protected $fillable = ['user_id', 'topic_id'];
}
