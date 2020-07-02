<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\BaseController;
use App\Http\Requests\PostCreateRequest;
use App\Http\Requests\PostUpdateRequest;
use App\Repositories\PostRepository;
use App\Transformers\ExchangeTransformer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends BaseController
{
	/**
	 * @var PostRepository
	 */
    private $postRepository;
	
	/**
	 * PostController constructor.
	 *
	 * @param PostRepository $postRepository
	 */
    public function __construct(PostRepository $postRepository)
    {
        $this->postRepository = $postRepository;
    }
	
	/**
	 * @return \Dingo\Api\Http\Response
	 */
    public function index() {
        $exchanges = $this->postRepository->all();
        return $this->response->collection($exchanges, new ExchangeTransformer);
    }
	
	/**
	 * @param $id
	 *
	 * @return \Dingo\Api\Http\Response
	 */
    public function show($id) {
        $exchange = $this->postRepository->findById($id);
        return $this->response->item($exchange, new ExchangeTransformer);
    }
	
	/**
	 * @param PostCreateRequest $request
	 *
	 * @return \Dingo\Api\Http\Response
	 */
    public function store(PostCreateRequest $request) {
        $exchange = $this->postRepository->create($request);
	    return $this->response->item($exchange, new ExchangeTransformer);
    }
	
	/**
	 * @param PostUpdateRequest $request
	 *
	 * @return \Dingo\Api\Http\Response
	 */
    public function update(PostUpdateRequest $request)
    {
        $exchange = $this->postRepository->update($request);
	    return $this->response->item($exchange, new ExchangeTransformer);
    }
	
	/**
	 * @param $id
	 *
	 * @return \Illuminate\Http\JsonResponse
	 */
    public function destroy($id)
    {
        $exchange = $this->postRepository->delete($id);
        return response()->json(compact('exchange'), 200);
    }
}
