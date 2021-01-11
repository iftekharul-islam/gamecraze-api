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
        // if (Carbon::parse($token->expires_at)->gt(Carbon::now())) {
        //     return $this->response->array([
        //         'error' => true,
        //         'message' => 'Token Expired'
        //     ]);
        // }

        return $this->response->array([
            'error' => false,
            'message' => 'Valid token'
        ]);
    }

    public function updatePassword(Request $request) {
        $token = ResetPasswordToken::where('token', $request->token)->first();
        $user = User::findOrFail($token->user_id);
        logger('user: ' . json_encode($user));
        logger('req: ' .json_encode($request->all()));
        if ($user) {
            $user->password = Hash::make($request->password);
            $user->save();
            // $token->expires_at =  Carbon::now()->subDays(5);
            // $token->save();
            $token->delete();

            $accessToke = $user->createToken($user->email.'-'.now());
        
            return $this->response->array([
                'error' => false,
                'message' => 'Password updated',
                'user' => $user,
                'token' =>$accessToke->accessToken
            ]);
        }

        return $this->response->array([
            'error' => true,
            'message' => 'User not found'
        ]);
        
    }
}
