<?php


namespace App\Transformers;


use App\Models\Commission;
use League\Fractal\TransformerAbstract;

class CommissionTransformer extends TransformerAbstract
{
    public function transform(Commission $commission){
        return [
            'id' => $commission->id,
            'amount' => $commission->amount,
            'status' => $commission->status,
        ];
    }
}
