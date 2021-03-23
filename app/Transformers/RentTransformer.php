<?php

namespace App\Transformers;

// We need to reference the Items Model
use App\Models\Game;
use App\Models\Rent;

// Dingo includes Fractal to help with transformations
use App\Repositories\Admin\RentRepository;
use App\Repositories\Admin\BasePriceRepository;
use League\Fractal\TransformerAbstract;

class RentTransformer extends TransformerAbstract
{
    protected $availableIncludes = ['game', 'user', 'platform', 'diskCondition', 'checkpoint', 'renter'];

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
            'checkpoint_id' =>  $rent->checkpoint_id,
            'earning_amount' =>  $rent->earning_amount,
            'disk_condition_id' =>  $rent->disk_condition_id,
            'cover_image' =>  asset('/storage/rent-image/' . $rent->cover_image),
            'disk_image' =>  asset('/storage/rent-image/' . $rent->disk_image),
            'rented_user_id' =>  $rent->rented_user_id,
            'status' => $rent->status,
            'renter' => $rent->renter,
            'disk_type' => $rent->disk_type,
            'price_combination' => $this->gamePriceCalculation($rent->game_id, '1', $rent->disk_type),
        ];
    }

    public function includeGame(Rent $rent) {
        if (isset($rent->game)) {
            return $this->item($rent->game, new GameTransformer());
        }
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
    public function includeCheckpoint(Rent $rent) {
        if ($rent->checkpoint) {
            return $this->item($rent->checkpoint, new CheckpointTransformer());
        }
        return null;
    }
    public function includeRenter(Rent $rent) {
        if ($rent->renter) {
            return $this->item($rent->renter, new UserTransformer());
        }
        return null;
    }

    /**
     * @param $gameId
     * @param $lendWeek
     * @param $diskType
     * @return array|void
     */
    public function gamePriceCalculation($gameId, $lendWeek, $diskType)
    {
        $game = Game::with('basePrice')->findOrFail($gameId);
        $basePrice = $game->basePrice;
        $second_week = $basePrice->second_week;
        $third_week = $basePrice->third_week;
        $sum = 0;
        $mapping = [
            1 => 1,
            2 => $second_week,
            3 => $third_week,
        ];
        for ($i = 1; $i <= $lendWeek; $i++) {
            if (isset($mapping[$i])) {
                $sum += $basePrice->base * $mapping[$i];
            } else {
                $lendWeek = $lendWeek - 3;
                if ($lendWeek < 1){
                    return;
                }
                $i = 0;
            }
        }
        if ($diskType == config('gamehub.disk_type.digital_copy')){
            $digital_rate = ceil($sum - ($sum * config('gamehub.digital_game_discount') / 100));
            $price = [
                'regular_price' => $digital_rate,
                'discount_price' => ceil($digital_rate - (($digital_rate * config('gamehub.offer_discount_amount')) / 100))
            ];
        } else {
            $price = [
                'regular_price' => $sum,
                'discount_price' => ceil($sum - (($sum * config('gamehub.offer_discount_amount')) / 100))
            ];
        }

        return $price;
    }
}
