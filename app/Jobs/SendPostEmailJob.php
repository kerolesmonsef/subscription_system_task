<?php

namespace App\Jobs;

use App\Mail\PostNotificatinEmail;
use App\Models\Post;
use App\Models\Subscriber;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendPostEmailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    /**
     * @var Post
     */
    private $post;

    /**
     * Create a new job instance.
     *
     * @param Post $post
     */
    public function __construct(Post $post)
    {
        $this->post = $post;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $emailTemplate = new PostNotificatinEmail($this->post);

        Subscriber::query()
            ->select("subscribers.email")
            ->join('subscriptions', 'subscribers.id', 'subscriptions.subscriber_id')
            ->where('subscriptions.website_id', $this->post->website_id)
            ->chunk(50, function (Collection $subscribers) use ($emailTemplate) {
                $emails = $subscribers->pluck("email");

                Mail::to($emails)->send($emailTemplate);
            });
    }
}
