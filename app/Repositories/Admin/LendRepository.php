<?php


namespace App\Repositories\Admin;

use App\Models\Lender;

class LendRepository
{
    /**
     * @return \Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection
     */
    public function history() {
        return Lender::with('lender', 'renter')->get();
    }
}
