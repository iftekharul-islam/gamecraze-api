<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\BaseController;
use App\Http\Requests\ResetPasswordRequest;
use App\Http\Requests\VerifyResetPasswordRequest;
use App\Models\ResetPasswordToken;
use App\Models\User;
use App\Repositories\ResetPasswordRepository;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ResetPasswordController extends BaseController
{
    private $resetPasswordRepository;
    public function __construct(ResetPasswordRepository $resetPasswordRepository)
    {
        $this->resetPasswordRepository = $resetPasswordRepository;
    }

    public function sendResetCode(ResetPasswordRequest $request) {
        $code = $this->resetPasswordRepository->sendCode($request);
        if ($code == false) {
            return $this->response->array([
                'error' => true,
                'message' => 'The email has not valid user'
            ]);
        }
        return $this->response->array([
            'error' => false,
            'media' => $code
        ]);
    }

    public function verifyResetCode(VerifyResetPasswordRequest $request) {
        $response = $this->resetPasswordRepository->verifyCode($request);
        return $this->response->array($response);
    }

    public function validateToken($token) {
        $token = ResetPasswordToken::where('token', $token)->first();
        if (!$token) {
            return $this->response->array([
                'error' => true,
                'message' => 'Token Not Found'
            ]);
        }
        $now = Carbon::now();
        $token_exp = Carbon::parse($token->expires_at);
        if ($now->gt($token_exp)) {
            return $this->response->array([
                'error' => true,
                'message' => 'Token Expired',
                'now' => $now
            ]);
        }

        return $this->response->array([
            'error' => false,
            'message' => 'Valid token'
        ]);
    }

    public function updatePassword(Request $request) {

        $request->validate([
            'password' => 'required|confirmed|min:8',
        ]);

        $token = ResetPasswordToken::query()->where('token', $request->token)->first();

        if (!$token) {
            return $this->response->array([
                'error' => true,
                'message' => 'Token not found'
            ]);
        }

        if (User::query()->where('id', $token->user_id)->count() == 0) {
            return $this->response->array([
                'error' => true,
                'message' => 'accountNotExists'
            ]);
        }

        $user = User::findOrFail($token->user_id);
        if ($user) {
            $user->password = Hash::make($request->password);
            $user->save();
            $token->delete();

            $accessToken = $user->createToken($user->email.'-'.now());

            $data = [
                'address_id' => $user->address_id,
                'birth_date' => $user->birth_date,
                'email' => $user->email,
                'gender' => $user->gender,
                'id' => $user->id,
                'identification_image' => asset($user->identification_image),
                'identification_number' => $user->identification_number,
                'image' => isset($user->image) ? asset($user->image) : null,
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
            return $this->response->array([
                'error' => false,
                'message' => 'Password updated',
                'user' => $data,
                'token' => $accessToken->accessToken
            ]);
        }

        return $this->response->array([
            'error' => true,
            'message' => 'User not found'
        ]);
    }
}
