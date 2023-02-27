<?php

namespace App\Transformers;

// We need to reference the Items Model
use App\Models\PhoneNumber;
use League\Fractal\TransformerAbstract;

// Dingo includes Fractal to help with transformations

class PhoneNumberTransformer extends TransformerAbstract
{
    public function transform(PhoneNumber $number): array
    {
        // specify what elements are going to be visible to the API
        return [
            'id' => $number->id,
            'number' => $number->number,
        ];
    }
}
