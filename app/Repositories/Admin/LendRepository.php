<?php


namespace App\Repositories\Admin;

use App\Models\Lender;

class LendRepository
{
    /**
     * @return \Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection
     */
    public function history () {
        return Lender::with('lender', 'rent.game')->orderBy('created_at','ASC')->get();
    }

    /**
     * @param $id
     * @return \Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection
     */
    public function details ($id) {
        return Lender::with('lender', 'rent.user.address', 'rent.game', 'rent.game.basePrice')->findOrFail($id);
    }
}
