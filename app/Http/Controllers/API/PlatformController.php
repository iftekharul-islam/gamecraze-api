<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\BaseController;
use App\Http\Requests\PlatformCreateRequest;
use App\Http\Requests\PlatformUpdateRequest;
use App\Repositories\PlatformRepository;
use App\Transformers\PlatformTransformer;

class PlatformController extends BaseController
{
    private $platformRepository;
    public function __construct(PlatformRepository $platformRepository)
    {
        $this->platformRepository = $platformRepository;
    }

    public function index() {
        $platforms = $this->platformRepository->all();
        return $this->response->collection($platforms, new PlatformTransformer());
    }

    public function show($id) {
        $platform = $this->platformRepository->findById($id);
        return $this->response->item($platform, new PlatformTransformer());
    }

    public function store(PlatformCreateRequest $request) {
        $platform = $this->platformRepository->create($request);
        return $this->response->item($platform, new PlatformTransformer());
    }

    public function update(PlatformUpdateRequest $request) {
        $platform = $this->platformRepository->update($request);
        return $this->response->item($platform, new PlatformTransformer());
    }

    public function destroy($id) {
        $this->platformRepository->delete($id);
    }
}
