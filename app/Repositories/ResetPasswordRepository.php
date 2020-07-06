<?php

namespace App\Repositories;
use App\Jobs\SendOtp;
use App\Models\User;
use App\Notifications\PasswordResetRequest;
use Illuminate\Http\Request;

class ResetPasswordRepository {
    public function sendCode(Request $request) {
        $otp = rand(100000, 999999);
        if ($request->input('resetOption') == 'email') {
            $user = User::where('email', $request->input('email'))->first();

            if (!$user) {
                return false;
            }

            $user->notify(new PasswordResetRequest($otp));
            return $user->email;
        }
        else {
            $user = User::where('email', $request->input('email'))->first('phone_number');

            SendOtp::dispatch($user->phone_number, $otp);

            return $user->phone_number;
        }
    }
}
