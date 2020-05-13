<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\BaseController;
use App\Repositories\UserRequestRepository;
use App\Notifications\RequestEmail;
use Illuminate\Http\Request;

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
        $user_request->user_id->notify(new RequestEmail());

        return response()->json("Request sent successfully", 200);
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
