<?php


namespace App\Transformers;


use App\Models\BasePrice;
use League\Fractal\TransformerAbstract;

class BasePriceTransformer extends TransformerAbstract
{
    public function transform(BasePrice $basePrice){
        // specify what elements are going to be visible to the API
        return [
            'id' => $basePrice->id,
            'Author_id' => $basePrice->author_id,
            'Start price' =>  $basePrice->start,
            'End price' =>  $basePrice->end,
            'status' => $basePrice->status,
        ];
    }
}
