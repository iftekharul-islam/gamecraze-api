<?php

namespace App\Http\Controllers\API;

use App\Exchange;
use App\Http\Controllers\BaseController;
use App\Http\Requests\PostCreateRequest;
use App\Http\Requests\PostUpdateRequest;
use App\Repositories\PostRepository;
use App\Transformers\ExchangeTransformer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends BaseController
{
    private $postRepository;
    public function __construct(PostRepository $postRepository)
    {
        $this->postRepository = $postRepository;
    }

    public function index() {
        $exchanges = $this->postRepository->all();
        return $this->response->collection($exchanges, new ExchangeTransformer);
    }

    public function show(Request $request) {
        $exchange = $this->postRepository->findById($request->id);
        return $this->response->item($exchange, new ExchangeTransformer);
    }

    public function store(PostCreateRequest $request) {
        $exchange = $this->postRepository->create($request);
        return response()->json(compact('exchange'), 200);
    }

    public function update(PostUpdateRequest $request)
    {
        $exchange = $this->postRepository->update($request);
        return response()->json(compact('exchange'), 200);
    }

    public function destroy(Request $request)
    {
        $exchange = $this->postRepository->delete($request->id);
        return response()->json(compact('exchange'), 200);
    }
}
