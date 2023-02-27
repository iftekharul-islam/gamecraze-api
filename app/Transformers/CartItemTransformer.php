<?php


namespace App\Transformers;


use App\Models\CartItem;
use League\Fractal\TransformerAbstract;

class CartItemTransformer extends TransformerAbstract
{
    protected $availableIncludes = [
        'rent', 'user'
    ];
    public function transform(CartItem $data)
    {
        // specify what elements are going to be visible to the API
        return [
            'id' => $data->id,
            'rent_id' => $data->rent_id,
            'user_id' => $data->user_id,
            'rent_week' => $data->rent_week,
            'address' => $data->address,
            'status' => $data->status,
        ];
    }

    public function includeRent(CartItem $data) {
        return $this->item($data->rent, new RentTransformer());
    }

    public function includeUser(CartItem $data) {
        return $this->item($data->user, new UserTransformer());
    }
}
