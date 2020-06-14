<?php

namespace App\Repositories;

use App\Models\UserRequest;
use Illuminate\Http\Request;

class UserRequestRepository {
    public function all() {
        return UserRequest::all();
    }

    public function findById($id) {
        return UserRequest::findOrFail($id);
    }

    public function create(Request $request) {
        $user_request = new UserRequest();
        $user_id = auth()->user()->id;
        $user_request->user_id = $user_id;
        $user_request->post_id = $request->post_id;
        $user_request->management_id = $request->management_id;
        $user_request->delivery_address = $request->delivery_address;
        $user_request->save();

        return $user_request;
    }

    public function update(Request $request) {
        $user_request = UserRequest::findOrFail($request->id);
        $user_request->post_id = $request->post_id;
        $user_request->management_id = $request->management_id;
        $user_request->delivery_address = $request->delivery_address;
        $user_request->save();

        return $user_request;
    }

    public function delete($id) {
        $user_request = UserRequest::findOrFail($id);
        $user_request->delete();
        return;
    }
}
