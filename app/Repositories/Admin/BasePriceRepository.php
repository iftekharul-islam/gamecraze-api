<?php


namespace App\Repositories\Admin;


use App\Models\BasePrice;
use App\Models\Game;

class basePriceRepository
{
    /**
     * @return BasePrice[]|\Illuminate\Database\Eloquent\Collection
     */
    public function all() {
        return BasePrice::all();
    }

    /**
     * @param $request
     * @return mixed
     */
    public function store($request) {
        $data = $request->only(['start', 'end', 'base', 'second_week', 'third_week', 'status']);
        $data['author_id'] = auth()->user()->id;
        return BasePrice::create($data);
    }

    /**
     * @param $id
     * @return mixed
     */
    public function edit($id) {
        return BasePrice::findOrFail($id);
    }

    /**
     * @param $request
     * @return mixed
     */
    public function update($request) {
        $price = BasePrice::findOrFail($request->id);
        $data = $request->only(['start', 'end', 'base', 'second_week', 'third_week', 'status']);

        $price->start = $data['start'];
        $price->end = $data['end'];

        if (isset($data['base'])) {
            $price->base = $data['base'];
        }
        if (isset($data['second_week'])) {
            $price->second_week = $data['second_week'];
        }
        if (isset($data['third_week'])) {
            $price->third_week = $data['third_week'];
        }
        if (isset($data['status'])) {
            $price->status = $data['status'];
        }
        $price->save();
        return $price;
    }

    /**
     * @param $id
     */
    public function delete($id) {
        $price = BasePrice::find($id);
        $price->delete();
    }

    /**
     * @param $start
     * @param $end
     * @param $baseId
     * @return mixed
     */
    public function validateStartPriceUpdate ($start, $end, $baseId) {
        $basePrice = BasePrice::where(function ($query) use ($start, $end) {
            $query->whereBetween('start', [$start, $end])
                ->orWhere(function ($query) use ($start, $end) {
                    $query->whereBetween('end', [$start, $end]);
                });
        })->where('id', '!=', $baseId)
            ->count();
        return $basePrice;
    }

    public function validateStartPriceCreate($start, $end) {
        $basePrice = BasePrice::where(function ($query) use ($start, $end) {
            $query->whereBetween('start', [$start, $end])
                ->orWhere(function ($query) use ($start, $end) {
                    $query->whereBetween('end', [$start, $end]);
                });
        })->count();
        return $basePrice;
    }

    /**
     * @param bool $achieveDiscount
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
            $digital_rate = ceil($sum - (($sum * config('gamehub.digital_game_discount')) / 100));
            $digital_commission = ceil(($digital_rate * config('gamehub.commission_amount')) / 100);

            $digital_discount_amount = ceil($digital_rate);
            $digital_discount_commission = 0;

            $price = [
                'regular_price' => $digital_rate,
                'regular_commission' => $digital_commission,

                'discount_price' => config('gamehub.offer_on_digital_game') == true ?
                    $digital_discount_amount : $digital_rate,
                'discount_commission' => config('gamehub.offer_on_digital_game') == true ?
                    $digital_discount_commission : $digital_commission,
            ];
        } else {
            $physical_rate = $sum ;
            $physical_commission = ($physical_rate * config('gamehub.commission_amount')) / 100;

            $physical_discount_amount = $physical_rate;
            $physical_discount_commission = 0;
            $price = [
                'regular_price' => ceil($physical_rate),
                'regular_commission' => ceil($physical_commission),
                'discount_price' => ceil($physical_discount_amount),
                'discount_commission' => $physical_discount_commission
            ];
        }
        return $price;
    }
}
