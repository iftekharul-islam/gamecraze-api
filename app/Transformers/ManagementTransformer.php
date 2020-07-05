<?php


namespace App\Transformers;

use App\Models\Management;
use League\Fractal\TransformerAbstract;

class ManagementTransformer extends TransformerAbstract
{
    /**
     * @param Management $management
     * @return array
     */
    public function transform(Management $management){
        // specify what elements are going to be visible to the API
        return [
            'delivery_type' => $management->delivery_type,
            'delivery_amount' =>  $management->delivery_amount,
            'delivery_commission' =>  $management->delivery_commission,
        ];
    }
}
