<?php


namespace App\Repositories\Admin;


use App\Models\BasePrice;

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

}
