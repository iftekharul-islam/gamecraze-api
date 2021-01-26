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
            'Start_price' =>  $basePrice->start,
            'End_price' =>  $basePrice->end,
            'base' =>  $basePrice->base,
            'second_week' => $basePrice->second_week,
            'third_week' => $basePrice->third_week,
            'status' => $basePrice->status,
        ];
    }
}
