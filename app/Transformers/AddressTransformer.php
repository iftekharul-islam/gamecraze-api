<?php

namespace App\Transformers;

// We need to reference the Items Model
use App\Models\Address;
use App\Models\PhoneNumber;
use League\Fractal\TransformerAbstract;

// Dingo includes Fractal to help with transformations

class AddressTransformer extends TransformerAbstract
{
    public function transform(Address $address): array
    {
        // specify what elements are going to be visible to the API
        return [
            'id' => $address->id,
            'user_id' => $address->id,
            'state' => $address->state,
            'city' => $address->city,
            'zip_code' => $address->zip_code,
        ];
    }
}
