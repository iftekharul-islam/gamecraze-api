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

	    return $otp;
    }

    public function update(Request $request) {

    }

    public function delete($id) {

    }

	/**
	 * @param Request $request
	 *
	 * @return mixed
	 */
    public function verifyOtp(Request $request) {
        $otp = OneTimePassword::where('phone_number', $request->input('phone_number'))->latest()->first();

        $created_at = new Carbon($otp->created_at);

        $otpCreateTime = $created_at->diff(Carbon::now())->s;


	    if (trim($otp->otp) !== trim($request->input('otp')) || $otpCreateTime >= config('otp.lifetime')) {
		    return [
		        'error' => true,
                'message' => 'There is an error'
            ];
	    }

	    $user = User::where('phone_number', $request->input('phone_number'))->first();

	    if ($user) {
		    $token = $user->createToken($user->phone_number .'-'. now());
		    return [
                'error' => false,
		        'new_user' => false,
		        'token' => $token->accessToken
            ];
	    }

	    $user = User::create([
		    'phone_number' => $request->input('phone_number')
	    ]);

	    $token = $user->createToken($user->phone_number .'-'. now());

	    return [
            'error' => false,
            'new_user' => true,
            'token' => $token->accessToken
        ];
    }
}
