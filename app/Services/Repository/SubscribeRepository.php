<?php


namespace App\Services\Repository;


use App\Models\Subscriber;
use App\Models\Subscription;
use Illuminate\Http\Request;

class SubscribeRepository
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
        $subscriber = Subscriber::query()->firstOrCreate([
            'email' => $this->request->get('email'),
        ]);

        return Subscription::query()->firstOrCreate([
            'subscriber_id' => $subscriber->id,
            'website_id' => $this->request->get('website_id'),
        ]);

    }
}
