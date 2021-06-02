<?php


namespace App\Transformers;


use App\Models\Lender;
use League\Fractal\TransformerAbstract;

class LendTransformers extends TransformerAbstract
{
    protected $availableIncludes = [
        'rent', 'order'
    ];

    public function transform(Lender $lender)
    {
        // specify what elements are going to be visible to the API
        return [
            'id' => $lender->id,
            'rent_id' => $lender->rent_id,
            'checkpoint_id' =>  $lender->checkpoint_id,
            'lend_week' =>  $lender->lend_week,
            'lend_cost' =>  $lender->lend_cost,
            'commission' =>  $lender->commission,
            'renter_id' =>  $lender->renter_id,
            'lend_date' =>  $lender->lend_date,
            'end_date' => $lender->end_date,
            'payment_method' =>  $lender->payment_method,
            'status' =>  $lender->status,
            'game_order_id' =>  $lender->game_order_id,
        ];
    }

    public function includeRent(Lender $lender) {
        return $this->item($lender->rent, new RentTransformer());
    }

    public function includeOrder(Lender $lender) {
        return $this->item($lender->order, new GameOrderTransformers());
    }
}
