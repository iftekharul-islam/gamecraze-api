<?php

namespace App\Services;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserLoginService {
    public function login(Request $request) {
        if( Auth::attempt(['email'=>$request->email, 'password'=>$request->password]) ) {
        $user = Auth::user();

        return $user->createToken($user->email.'-'.now());
        }
    }
}
