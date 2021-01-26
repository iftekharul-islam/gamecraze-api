<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Repositories\Admin\DeliveryChargeRepository;
use App\Transformers\DeliveryChargeTransformer;
use Illuminate\Http\Request;

class DeliveryChargeController extends Controller
{

    public $deliveryChargeRepository;

    public function __construct(DeliveryChargeRepository $deliveryChargeRepository)
    {
        $this->deliveryChargeRepository = $deliveryChargeRepository;
    }

    public function getCharge()
    {
        $charge = $this->deliveryChargeRepository->getCharge(); 
        if($charge) {
            return $this->response->item($charge, new DeliveryChargeTransformer());
        }

        return $this->response->array([
            'data' => [],
        ]);

    }
}
