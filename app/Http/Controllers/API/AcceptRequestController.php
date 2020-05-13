<?php

namespace App\Http\Controllers\API;

use App\Exchange;
use App\Http\Controllers\BaseController;
use App\Notifications\AcceptNotification;
use App\User;
use Illuminate\Http\Request;

class AcceptRequestController extends BaseController
{
    public function acceptRequest(Request $request) {
        $post = Exchange::findOrFail($request->post_id);
        $post->borrower_id = $request->input('borrower_id');
        $post->save();
        $user = User::findOrFail($post->borrower_id);
        $user->notify(new AcceptNotification());

        return response()->json('Request accepted');
    }
}
