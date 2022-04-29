<?php


namespace App\Services\Repository;


use App\Jobs\SendPostEmailJob;
use App\Models\Post;
use Illuminate\Http\Request;

class PostRepository
{
    /**
     * @var Request
     */
    private $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function create()
    {

        // we can create event and listener here
        // create post is the event
        // publish the post is the listener


        /** @var Post $post */
        $post = Post::query()->create([
            'website_id' => $this->request->get('website_id'),
            'title' => $this->request->get('title'),
            'description' => $this->request->get('description'),
        ]);


        $this->publishPost($post);

        return $post;

    }

    private function publishPost(Post $post)
    {
        dispatch(new SendPostEmailJob($post));
    }
}
