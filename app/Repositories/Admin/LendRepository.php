<?php


namespace App\Repositories\Admin;

use App\Models\Lender;

class LendRepository
{
    /**
     * @return \Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection
     */
    public function history() {
        return Lender::with('lender', 'rent.user', 'rent.game')->get();
    }

    /**
     * @param $id
     * @return \Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection
     */
    public function details($id) {
        return Lender::with('lender', 'rent.user', 'rent.game')->findOrFail($id);
    }
}
