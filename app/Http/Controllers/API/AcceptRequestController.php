<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\AcceptCreateRequest;
use App\Models\Exchange;
use App\Http\Controllers\BaseController;
use App\Notifications\AcceptNotification;
use App\Models\User;

class AcceptRequestController extends BaseController
{
    /**
     * @param AcceptCreateRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function acceptRequest(AcceptCreateRequest $request) {
        $post = Exchange::findOrFail($request->post_id);
        $post->borrower_id = $request->input('borrower_id');
        $post->save();
        $user = User::findOrFail($post->borrower_id);
        $user->notify(new AcceptNotification());

        return response()->json('Request accepted');
    }
}
