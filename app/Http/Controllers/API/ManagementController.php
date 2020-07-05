<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\BaseController;
use App\Http\Requests\ManagementCreateRequest;
use App\Http\Requests\ManagementUpdateRequest;
use App\Repositories\ManagementRepository;
use Dingo\Api\Exception\DeleteResourceFailedException;
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
     * @return \Illuminate\Http\JsonResponse
     */
    public function index() {
        $managements = $this->managementRepository->all();
        return response()->json(compact('managements'), 200);
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id) {
        $management = $this->managementRepository->findById($id);
        return response()->json(compact('management'), 200);
    }

    /**
     * @param ManagementCreateRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(ManagementCreateRequest $request) {
        $management = $this->managementRepository->create($request);
        return response()->json(compact('management'), 200);
    }

    /**
     * @param ManagementUpdateRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(ManagementUpdateRequest $request) {
        $management = $this->managementRepository->update($request);
        return response()->json(compact('management'), 200);
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
