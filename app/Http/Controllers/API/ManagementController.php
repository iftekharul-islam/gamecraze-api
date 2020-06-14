<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\BaseController;
use App\Http\Requests\ManagementCreateRequest;
use App\Http\Requests\ManagementUpdateRequest;
use App\Repositories\ManagementRepository;
use Illuminate\Support\Facades\Auth;

class ManagementController extends BaseController
{
    private $managementRepository;
    public function __construct(ManagementRepository $managementRepository)
    {
        $this->managementRepository = $managementRepository;
    }

    public function index() {
        $managements = $this->managementRepository->all();
        return response()->json(compact('managements'), 200);
    }

    public function show($id) {
        $management = $this->managementRepository->findById($id);
        return response()->json(compact('management'), 200);
    }

    public function store(ManagementCreateRequest $request) {
        $management = $this->managementRepository->create($request);
        return response()->json(compact('management'), 200);
    }

    public function update(ManagementUpdateRequest $request) {
        $management = $this->managementRepository->update($request);
        return response()->json(compact('management'), 200);
    }

    public function destroy($id) {
        $this->managementRepository->delete($id);
    }
}
