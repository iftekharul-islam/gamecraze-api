<?php

namespace App\Repositories;
use App\Jobs\SendOtp;
use App\Jobs\SendResetCodeEmail;
use App\Models\PasswordReset;
use App\Models\User;
use App\Notifications\PasswordResetRequest;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ResetPasswordRepository {
    public function sendCode(Request $request) {
        $otp = rand(100000, 999999);
        if ($request->input('resetOption') == 'email') {
            $user = User::where('email', $request->input('email'))->first();

            if (!$user) {
                return false;
            }

            SendResetCodeEmail::dispatch($user, $otp);

            return $user->email;
        }
        else {
            $user = User::where('email', $request->input('email'))->first('phone_number');

            SendOtp::dispatch($user->phone_number, $otp);

            return $user->phone_number;
        }
    }

    public function verifyCode(Request $request) {
        $code = PasswordReset::where('email', $request->input('email'))->latest()->first();

        $created_at = new Carbon($code->created_at);

        $timeDiff = $created_at->diffInSeconds(Carbon::now());

        if (trim($code->otp) !== trim($request->input('otp'))) {
            return [
                'error' => true,
                'message' => 'wrongOtp'
            ];
        }
        elseif ($timeDiff >= config('otp.lifetime')) {
            return [
                'error' => true,
                'message' => 'timeout'
            ];
        }

        $user = User::where('email', $request->input('email'))->first();

        if ($user) {
            $token = $user->createToken($user->email .'-'. now());
            return [
                'error' => false,
                'token' => $token->accessToken,
                'user' => $user
            ];
        }
    }
}
