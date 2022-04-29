<?php

namespace App\Http\Controllers;

use App\Http\Requests\SubscriptionRequest;
use App\Services\Repository\SubscribeRepository;

class SubscriptionController extends Controller
{
    /**
     * @var SubscribeRepository
     */
    private $repository;

    public function __construct(SubscribeRepository $repository)
    {
        $this->repository = $repository;
    }

    public function subscribe(SubscriptionRequest $request)
    {
        $this->repository->create();

        return response()->success();
    }
}
