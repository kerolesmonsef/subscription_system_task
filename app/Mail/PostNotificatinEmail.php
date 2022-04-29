<?php

namespace App\Mail;

use App\Models\Post;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PostNotificatinEmail extends Mailable
{
    use Queueable, SerializesModels;
    /**
     * @var Post
     */
    private $post;

    /**
     * Create a new message instance.
     *
     * @param Post $post
     */
    public function __construct(Post $post)
    {
        //
        $this->post = $post;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('post_notification_email', [
            'title' => $this->post->title,
            'description' => $this->post->description,
        ]);
    }
}
