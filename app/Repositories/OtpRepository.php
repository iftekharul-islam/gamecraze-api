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

//        SendOtp::dispatch($phone, $otp);
	    
	    return $otp;
    }

    public function update(Request $request) {

    }

    public function delete($id) {

    }
	
	/**
	 * @param Request $request
	 *
	 * @return bool
	 */
    public function verifyOtp(Request $request) {
        $otp = OneTimePassword::where('phone_number', $request->input('phone_number'))->latest()->first();
        
        $created_at = new Carbon($otp->created_at);
        
        $otpCreateTime = $created_at->diff(Carbon::now())->s;
        
	
	    if (trim($otp->otp) !== trim($request->input('otp')) || $otpCreateTime >= config('otp.lifetime')) {
		    return false;
	    }
	
	    $user = User::where('phone_number', $request->input('phone_number'))->first();
	    
	    if ($user) {
		    $token = $user->createToken($user->phone_number .'-'. now());
		    return $token->accessToken;
	    }
	
	    $user = User::create([
		    'name' => $request->input('name'),
		    'phone_number' => $request->input('phone_number')
	    ]);
	
	    $token = $user->createToken($user->phone_number .'-'. now());
	    
	    return $token->accessToken;
    }
}
