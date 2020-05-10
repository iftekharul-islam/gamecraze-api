<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\BaseController;
use App\Repositories\UserRequestRepository;
use App\UserRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserRequestController extends BaseController
{
    private $requestRepository;
    public function __construct(UserRequestRepository $requestRepository)
    {
        $this->requestRepository = $requestRepository;
    }

    public function index() {
        $user_requests = $this->requestRepository->all();
        return response()->json(compact('user_requests'), 200);
    }

    public function show(Request $request) {
        $user_request = $this->requestRepository->findById($request->id);
        return response()->json(compact('user_request'), 200);
    }

    public function store(Request $request) {
        $user_request = $this->requestRepository->create($request);
        return response()->json(compact('user_request'), 200);
    }

    public function update(Request $request) {
        $user_request = $this->requestRepository->update($request);
        return response()->json(compact('user_request'), 200);
    }

    public function destroy(Request $request) {
        $this->requestRepository->delete($request->id);
        return response()->json('Deleted Successfully');
    }
}
