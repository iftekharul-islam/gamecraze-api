<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\BaseController;
use App\Http\Requests\OtpCreateRequest;
use App\Http\Requests\VerifyOtpRequest;
use App\Repositories\OtpRepository;


class OneTimePasswordController extends BaseController
{
    /**
     * @var OtpRepository
     */
    private $otpRepository;

    /**
     * OneTimePasswordController constructor.
     * @param OtpRepository $otpRepository
     */
    public function __construct(OtpRepository $otpRepository)
    {
        $this->otpRepository = $otpRepository;
    }

    /**
     * @param OtpCreateRequest $request
     * @return array
     */
    public function sendOtp(OtpCreateRequest $request) {
        $code = $this->otpRepository->create($request);


	    return $this->response->array([
	    	'error' => false,
		    'otp' => $code
	    ]);
    }

	/**
	 * @param VerifyOtpRequest $request
	 *
	 * @return array
	 */
    public function verifyOtp(VerifyOtpRequest $request) {

        $response = $this->otpRepository->verifyOtp($request);

        if ($response === false) {
	        return $this->response->array([
		        'error' => true,
		        'message' => "There is an error"
	        ]);
        }

	    return $this->response->array([
		    'error' => false,
		    'access_token' => $response
	    ]);
    }
}
