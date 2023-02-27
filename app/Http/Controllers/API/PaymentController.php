<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\BaseController;
use App\Repositories\PaymentRepository;
use Illuminate\Http\Request;

class PaymentController extends BaseController
{
    protected $paymentRepository;
    public function __construct(PaymentRepository $paymentRepository)
    {
        $this->paymentRepository = $paymentRepository;
    }

    public function success() {
        return $this->paymentRepository->success();
    }

}
