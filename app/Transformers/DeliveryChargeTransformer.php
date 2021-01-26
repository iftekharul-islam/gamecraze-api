<?php


namespace App\Transformers;

use App\Models\DeliveryCharge;
use League\Fractal\TransformerAbstract;

class DeliveryChargeTransformer extends TransformerAbstract
{
    public function transform(DeliveryCharge $charge){
        // specify what elements are going to be visible to the API
        return [
            'name' => $charge->name,
            'charge' =>  $charge->charge
        ];
    }
}
