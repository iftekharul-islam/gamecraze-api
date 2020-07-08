<?php

namespace App\Transformers;

// We need to reference the Items Model
use App\Models\Rent;

// Dingo includes Fractal to help with transformations
use League\Fractal\TransformerAbstract;

class RentTransformer extends TransformerAbstract
{
    protected $availableIncludes = ['game','user', 'platform', 'diskCondition'];
    public function transform(Rent $rent)
    {
        // specify what elements are going to be visible to the API
        return [
            'id' => $rent->id,
            'user_id' => $rent->user_id,
            'game_id' =>  $rent->game_id,
            'max_number_of_week' =>  $rent->max_week,
            'availability_from_date' =>  $rent->availability,
            'platform_id' =>  $rent->platform_id,
            'earning_amount' =>  $rent->earning_amount,
            'disk_condition_id' =>  $rent->disk_condition_id,
            'cover_image' =>  $rent->cover_image,
            'disk_image' =>  $rent->disk_image,
            'rented_user_id' =>  $rent->rented_user_id,
            'status' => $rent->status,
        ];
    }

    public function includeGame(Rent $rent) {
        return $this->item($rent->game, new GameTransformer());
    }
    public function includeUser(Rent $rent) {
        return $this->item($rent->user, new UserTransformer());
    }
    public function includePlatform(Rent $rent) {
        return $this->item($rent->platform, new PlatformTransformer());
    }
    public function includeDiskCondition(Rent $rent) {
        return $this->item($rent->diskCondition, new DiskConditionTransformer());
    }

}
