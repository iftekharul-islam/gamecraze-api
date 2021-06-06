<?php


namespace App\Transformers;


use App\Models\GameOrder;
use League\Fractal\TransformerAbstract;

class GameOrderTransformers extends TransformerAbstract
{

    protected $availableIncludes = ['lenders'];

    public function transform(GameOrder $order)
    {
        // specify what elements are going to be visible to the API
        return [
            'id' => $order->id,
            'order_no' => $order->order_no,
            'user_id' =>  $order->user_id,
            'amount' =>  ceil($order->amount),
            'commission' =>  $order->commission,
            'payment_method' =>  $order->payment_method,
            'payment_status' =>  $order->payment_status,
            'delivery_charge' =>  $order->delivery_charge,
            'delivery_status' =>  $order->delivery_status,
            'payment_status' => $order->payment_status,
            'address' =>  $order->address,
            'wallet_amount' =>  $order->wallet_amount,
            'create_date' => $order->created_at,
            'end_date' => $order->end_date
        ];
    }

    public function includeLenders(GameOrder $order) {
        return $this->collection($order->lenders, new LendTransformers());
    }
}
