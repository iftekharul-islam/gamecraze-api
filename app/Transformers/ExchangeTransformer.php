<?php

namespace App\Transformers;

// We need to reference the Items Model
use App\Models\Exchange;

// Dingo includes Fractal to help with transformations
use League\Fractal\TransformerAbstract;

class ExchangeTransformer extends TransformerAbstract
{
    public function transform(Exchange $exchange)
    {
        // specify what elements are going to be visible to the API
        return [
            'id' => $exchange->id,
            'lender' => $exchange->lender,
            'borrower' => $exchange->borrower,
            'game' => $exchange->game,
            'no_of_days' => $exchange->no_of_days,
            'condition' => $exchange->condition,
            'disk_health' => $exchange->disk_health,
            'status' => $exchange->status,
        ];
    }
}
