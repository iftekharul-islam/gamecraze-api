<?php


namespace App\Repositories\Admin;

use App\Models\Lender;
use App\Models\Rent;

class LendRepository
{
    /**
     * @param $request
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function history ($request) {
        $lends = Lender::query();
        if ($request->status == 0 && $request->status != null) {
            $lends->where('status', 0);
        }
        if ($request->status) {
            $lends->where('status', $request->status);
        }
        if ($request->search) {
            logger($request->search);
            $lends->whereHas('order', function ($q) use ($request) {
                $q->where('order_no', 'LIKE', "%{$request->search}%");
            });
        }
        return $lends->with('lender', 'rent.game', 'order')
            ->orderBy('created_at','DESC')
            ->paginate(config('gamehub.pagination'));
    }

    /**
     * @param $id
     * @return \Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection
     */
    public function details ($id) {
        return Lender::with('lender', 'lender.address', 'rent.user.address', 'rent.game', 'rent.game.basePrice')->findOrFail($id);
    }

    public function updateStatus($lend_id, $status) {

        $lender = Lender::findOrFail($lend_id);

        if ($status == 1 || $status == 4) {
            $rentPost = Rent::findOrFail($lender->rent_id);
            $rentPost->rented_user_id = null;
            $rentPost->rented_lend_id = null;
            $rentPost->save();

        }
        $lender->status = $status;
        $lender->save();
        return true;
    }
}
