<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\BaseController;
use App\Http\Requests\OtpCreateRequest;
use App\Http\Requests\VerifyOtpRequest;
use App\Repositories\OtpRepository;
use Illuminate\Http\Request;


class OneTimePasswordController extends BaseController
{
    private $otpRepository;
    public function __construct(OtpRepository $otpRepository)
    {
        $this->otpRepository = $otpRepository;
    }

    public function sendOtp(OtpCreateRequest $request) {
        $this->otpRepository->create($request);
    }

    public function verifyOtp(VerifyOtpRequest $request) {
        return $this->otpRepository->verifyOtp($request);
    }
}
