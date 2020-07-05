<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\BaseController;
use App\Http\Requests\PlatformCreateRequest;
use App\Http\Requests\PlatformUpdateRequest;
use App\Repositories\PlatformRepository;
use App\Transformers\PlatformTransformer;
use Dingo\Api\Exception\DeleteResourceFailedException;

class PlatformController extends BaseController
{
    /**
     * @var PlatformRepository
     */
    private $platformRepository;

    /**
     * PlatformController constructor.
     * @param PlatformRepository $platformRepository
     */
    public function __construct(PlatformRepository $platformRepository)
    {
        $this->platformRepository = $platformRepository;
    }

    /**
     * @return \Dingo\Api\Http\Response
     */
    public function index() {
        $platforms = $this->platformRepository->all();
        return $this->response->collection($platforms, new PlatformTransformer());
    }

    /**
     * @param $id
     * @return \Dingo\Api\Http\Response
     */
    public function show($id) {
        $platform = $this->platformRepository->findById($id);
        return $this->response->item($platform, new PlatformTransformer());
    }

    /**
     * @param PlatformCreateRequest $request
     * @return \Dingo\Api\Http\Response
     */
    public function store(PlatformCreateRequest $request) {
        $platform = $this->platformRepository->create($request);
        return $this->response->item($platform, new PlatformTransformer());
    }

    /**
     * @param PlatformUpdateRequest $request
     * @return \Dingo\Api\Http\Response
     */
    public function update(PlatformUpdateRequest $request) {
        $platform = $this->platformRepository->update($request);
        return $this->response->item($platform, new PlatformTransformer());
    }

    /**
     * @param $id
     * @return mixed
     */
    public function destroy($id) {
        $status = $this->platformRepository->delete($id);
        if ($status == 0) {
            throw new DeleteResourceFailedException();
        }

        return $this->response->array([
            "status_code" => 200,
            "message" => "Resource has been deleted."
        ]);
    }
}
