<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\BaseController;
use App\Http\Requests\ManagementCreateRequest;
use App\Http\Requests\ManagementUpdateRequest;
use App\Repositories\ManagementRepository;
use App\Transformers\ManagementTransformer;
use Dingo\Api\Exception\DeleteResourceFailedException;
use Dingo\Api\Exception\StoreResourceFailedException;
use Dingo\Api\Exception\UpdateResourceFailedException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ManagementController extends BaseController
{
    /**
     * @var ManagementRepository
     */
    private $managementRepository;

    /**
     * ManagementController constructor.
     * @param ManagementRepository $managementRepository
     */
    public function __construct(ManagementRepository $managementRepository)
    {
        $this->managementRepository = $managementRepository;
    }

    /**
     * @return \Dingo\Api\Http\Response
     */
    public function index() {
        $managements = $this->managementRepository->all();
        return $this->response->collection($managements, new ManagementTransformer());
    }

    /**
     * @param $id
     * @return \Dingo\Api\Http\Response
     */
    public function show($id) {
        $management = $this->managementRepository->findById($id);
        return $this->response->item($management, new ManagementTransformer());
    }

    /**
     * @param ManagementCreateRequest $request
     * @return \Dingo\Api\Http\Response
     */
    public function store(ManagementCreateRequest $request) {
        $management = $this->managementRepository->create($request);
        if (!$management) {
            throw new StoreResourceFailedException();
        }
        return $this->response->item($management, new ManagementTransformer());
    }

    /**
     * @param Request $request
     * @param $id
     * @return \Dingo\Api\Http\Response|string
     */
    public function update(Request $request) {
        $management = $this->managementRepository->update($request);
        if (!$management) {
            throw new UpdateResourceFailedException();
        }
        return $this->response->item($management, new ManagementTransformer());
    }

    /**
     * @param $id
     * @return mixed
     */
    public function destroy($id) {
        $status = $this->managementRepository->delete($id);
        if ($status == 0) {
            throw new DeleteResourceFailedException();
        }

        return $this->response->array([
            "status_code" => 200,
            "message" => "Resource has been deleted."
        ]);
    }
}
