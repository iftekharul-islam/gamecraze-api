<?php

namespace App\Transformers;

// We need to reference the Items Model
use App\Models\Rent;

// Dingo includes Fractal to help with transformations
use League\Fractal\TransformerAbstract;

class RentTransformer extends TransformerAbstract
{
    protected $availableIncludes = ['game','user'];
    public function transform(Rent $rent)
    {
        // specify what elements are going to be visible to the API
        return [
            'id' => $rent->id,
            'price' => $rent->price,
            'no_of_days' => $rent->no_of_days,
            'condition' => $rent->condition,
            'disk health' => $rent->disk_health,
        ];
    }

    public function includeGame(Rent $rent) {
        return $this->item($rent->game, new GameTransformer());
    }
    public function includeUser(Rent $rent) {
        return $this->item($rent->user, new UserTransformer());
    }

}
