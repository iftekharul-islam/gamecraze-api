<?php

namespace App\Services;

use App\Notifications\RequestEmail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class UserLoginService {
    public function login(Request $request) {
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $user = Auth::user();
            $token = $user->createToken($user->email .'-'. now());
            return $token->accessToken;
        }
        else {
            return 0;
        }
    }
}
