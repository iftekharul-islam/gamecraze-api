<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\BaseController;
use App\Http\Requests\ResetPasswordRequest;
use App\Http\Requests\VerifyResetPasswordRequest;
use App\Repositories\ResetPasswordRepository;
use Illuminate\Http\Request;

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
}
