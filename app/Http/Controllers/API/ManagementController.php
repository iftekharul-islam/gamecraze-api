<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\BaseController;
use App\Http\Requests\ManagementCreateRequest;
use App\Http\Requests\ManagementUpdateRequest;
use App\Management;
use App\Repositories\ManagementRepository;
use Illuminate\Http\Request;
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

    public function show(Request $request) {
        $management = $this->managementRepository->findById($request->id);
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

    public function destroy(Request $request) {
        $this->managementRepository->delete($request->id);
    }
}
