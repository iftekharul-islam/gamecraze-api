<?php


namespace App\Repositories;

use App\Models\BasePrice;

class BasePriceRepository
{
    /**
     * @return BasePrice[]|\Illuminate\Database\Eloquent\Collection
     */
    public function all() {
        return BasePrice::all();
    }

    public function show($id) {
        return BasePrice::findOrFail($id);
    }
}
