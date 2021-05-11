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
    protected $availableIncludes = ['game', 'user', 'platform', 'diskCondition', 'checkpoint', 'renter', 'lend'];

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
            'disk_type' => $rent->disk_type,
            'price_combination' => $this->gamePriceCalculation($rent->game_id, '1', $rent->disk_type),
            'game_user_id' => $rent->game_user_id,
            'game_password' => $rent->game_password,
            'rented_lend_id' => $rent->rented_lend_id,
            'status_by_user' => $rent->status_by_user,
            'end_date' => $rent->end_date
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
        if ($rent->diskCondition) {
            return $this->item($rent->diskCondition, new DiskConditionTransformer());
        }
        return null;
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
    public function includeLend(Rent $rent) {
        if ($rent->lend) {
            return $this->item($rent->lend, new LendTransformers());
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
        $secondWeek = $basePrice->second_week;
        $thirdWeek = $basePrice->third_week;
        $sum = 0;
        $mapping = [
            1 => 1,
            2 => $secondWeek,
            3 => $thirdWeek,
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
            $digital_regular_price = ceil(($digital_rate + (($digital_rate * config('gamehub.commission_amount')) / 100)));
            $digital_discount_price = config('gamehub.offer_on_digital_game') == true ?
                $digital_rate : $digital_regular_price;
            $price = [
                'regular_price' => $digital_regular_price,
                'discount_price' => ceil($digital_discount_price)
            ];
        } else {
            $physical_regular_price = ceil(($sum + (($sum * config('gamehub.commission_amount')) / 100)));
            $physical_discount_price = config('gamehub.offer_on_physical_game') == true ?
                $sum  : $physical_regular_price;
            $price = [
                'regular_price' => $physical_regular_price,
                'discount_price' => ceil($physical_discount_price)
            ];
        }
        return $price;
    }
}
