<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostRequest;
use App\Services\Repository\PostRepository;

class PostController extends Controller
{
    /**
     * @var PostRepository
     */
    private $repository;

    public function __construct(PostRepository $repository)
    {
        $this->repository = $repository;
    }

    public function store(PostRequest $request)
    {
        $this->repository->create();

        // in AppServiceProvider
        return response()->success();
    }

}
