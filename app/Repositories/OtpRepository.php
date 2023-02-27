<?php

namespace App\Repositories;

use App\Jobs\SendOtp;
use App\Models\Address;
use App\Models\OneTimePassword;
use Carbon\Carbon;
use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;


class OtpRepository
{
    public function all()
    {
        return OneTimePassword::all();
    }

    public function create(Request $request)
    {
        $otp = rand(100000, 999999);

        $phone = $request->input('phone_number');

        SendOtp::dispatch($phone, $otp);

        return $otp;
    }

    public function update(Request $request)
    {

    }

    public function delete($id)
    {

    }

    /**
     * @param Request $request
     * @return array
     * @throws \Exception
     */
    public function verifyOtp(Request $request)
    {
        $phone_number = $request->has('email') ?
            User::where('email', $request->input('email'))->first()->phone_number :
            $request->input('phone_number');

        $otp = OneTimePassword::where('phone_number', $phone_number)->latest()->first();

        if (!$otp) {
            return [
                'error' => true,
                'message' => 'otpNotFound'
            ];
        }

        $created_at = new Carbon($otp->created_at);

        $timeDiff = $created_at->diffInSeconds(Carbon::now());
        if (env('APP_ENV') == 'local') {
            if (!(trim($request->input('otp')) == '123456' || trim($otp->otp) == trim($request->input('otp')))){
                return [
                    'error' => true,
                    'message' => 'wrongOtp'
                ];
            }
        } elseif (trim($otp->otp) !== trim($request->input('otp'))) {
            return [
                'error' => true,
                'message' => 'wrongOtp'
            ];
        }
        if ($timeDiff >= config('otp.lifetime')) {
            return [
                'error' => true,
                'message' => 'timeout'
            ];
        }
        $user = User::where('phone_number', $phone_number)->first();

        if ($user) {
            $user->is_phone_verified = 1;
            $user->save();
            if ($user->status == 0) {
                return [
                    'error' => true,
                    'message' => 'inactiveUser'
                ];
            }
            $token = $user->createToken($user->phone_number . '-' . now());
            $user['image'] = $user->image ? asset($user->image) : null;
            $user->cover =  $user->cover ? asset( $user->cover) : null;
            $user->identification_image = $user->identification_image ? asset($user->identification_image) : '';
            return [
                'error' => false,
                'newUser' => false,
                'token' => $token->accessToken,
                'user' => $user,
                'address' => $user->address,
            ];
        }

        $user = User::create([
            'phone_number' => $phone_number,
            'status' => 1,
            'is_phone_verified' => 1,
            'rent_limit' => config('gamehub.rent_limit'),
            'referred_by' => $request->referral_code,
        ]);

        $address = Address::create([
            'address' => null,
        ]);
        $user->address_id = $address->id;
        $user->referral_code = 'GH-'.rand(1000, 9999).'-'.$user->id;
        $user->save();

        $role = Role::where('name', 'customer')->first();

        if ($user && $role) {
            $user->assignRole($role);
        }

        $token = $user->createToken($user->phone_number . '-' . now());

        return [
            'error' => false,
            'newUser' => true,
            'token' => $token->accessToken,
            'user' => $user,
            'address' => $user->address,
        ];
    }
}
