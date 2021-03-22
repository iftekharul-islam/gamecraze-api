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
            $user->password = null;
            $user->save();
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
            $data = [
                    'address_id' => $user->address_id,
                    'birth_date' => $user->birth_date,
                    'email' => $user->email,
                    'gender' => $user->gender,
                    'id' => $user->id,
                    'identification_image' => asset($user->identification_image),
                    'identification_number' => $user->identification_number,
                    'image' => asset($user->image),
                    'is_phone_verified' => $user->is_phone_verified,
                    'is_verified' => $user->is_verified,
                    'name' => $user->name,
                    'last_name' => $user->last_name,
                    'phone_number' => $user->phone_number,
                    'rent_limit' => $user->rent_limit,
                    'status' => $user->status,
                    'updated_at' => $user->updated_at,
                    'wallet' => $user->wallet,
                ];
            return [
                'error' => false,
                'token' => $token->accessToken,
                'user' => $data
            ];
        }
    }
}
