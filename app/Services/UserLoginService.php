<?php

namespace App\Services;

use App\Notifications\RequestEmail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class UserLoginService {
    public function login(Request $request) {
        if (isset($request->phone_number)) {
            $user = User::where('phone_number', $request->input('phone_number'))->first();
            if ($user) {
                $token = $user->createToken($user->phone_number .'-'. now());
                return $token->accessToken;
            }
            else {
                return false;
            }
        }
        else {
            if (Auth::attempt(['email' => $request->input('email'), 'password' => $request->input('password')])) {
                $user = Auth::user();
                $user['address'] = $user->address;
                $token = $user->createToken($user->email .'-'. now());
                return [
                    'user' => $user,
                    'token' => $token->accessToken,
                ];
            }
            else {
                return false;
            }
        }


    }
}
