<?php


namespace App\Transformers;


use App\Models\GameOrder;
use League\Fractal\TransformerAbstract;

class GameOrderTransformers extends TransformerAbstract
{

    public function transform(GameOrder $order)
    {
        // specify what elements are going to be visible to the API
        return [
            'id' => $order->id,
            'order_no' => $order->order_no,
            'user_id' =>  $order->user_id,
            'amount' =>  $order->amount,
            'commission' =>  $order->commission,
            'payment_method' =>  $order->payment_method,
            'payment_status' =>  $order->payment_status,
            'delivery_charge' =>  $order->delivery_charge,
            'delivery_status' =>  $order->delivery_status,
            'address' =>  $order->address,
            'wallet_amount' =>  $order->wallet_amount,
        ];
    }
}
