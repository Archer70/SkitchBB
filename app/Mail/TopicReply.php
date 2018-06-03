<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Topic;
use App\User;
use App\Post;

class TopicReply extends Mailable
{
    use Queueable, SerializesModels;

    public $topic;
    public $post;
    public $user;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Topic $topic, Post $post, User $user)
    {
        $this->topic = $topic;
        $this->post = $post;
        $this->user = $user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.topic_reply');
    }
}
