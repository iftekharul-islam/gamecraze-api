<?php

namespace App\Repositories;

use App\Jobs\SendOtp;
use App\Models\OneTimePassword;
use Carbon\Carbon;
use App\Models\User;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Http\Request;



class OtpRepository {
    public function all() {
        return OneTimePassword::all();
    }

    public function create(Request $request) {
        $otp = rand(100000, 999999);
        $phone = $request->input('phone_number');

        SendOtp::dispatch($phone, $otp);
    }

    public function update(Request $request) {

    }

    public function delete($id) {

    }

    public function verifyOtp(Request $request) {
        $otp = OneTimePassword::where('phone_number', $request->input('phone_number'))->latest()->first();
        $currentTime = Carbon::now()->format('H:i:s');
        $otpCreateTime = Carbon::parse($otp->created_at)->format('H:i:s');
        $timeDifference = strtotime($currentTime) - strtotime($otpCreateTime);

        if ($otp->otp == $request->input('otp') && $timeDifference <= 60) {
            $user = User::where('phone_number', $request->input('phone_number'))->first();
            if($user) {
                return 1;
            }
            else {
                User::create([
                    'name' => $request->input('name'),
                    'phone_number' => $request->input('phone_number')
                ]);
                return 1;
            }
        }
        return 0;
    }
}
