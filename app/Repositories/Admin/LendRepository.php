<?php


namespace App\Repositories\Admin;

use App\Jobs\SendReminder;
use App\Jobs\SentSubOrderCompletedEmail;
use App\Jobs\SentSubOrderDeliveredEmail;
use App\Jobs\SentSubOrderPostponedEmail;
use App\Jobs\SentSubOrderProcessingEmail;
use App\Models\GameOrder;
use App\Models\Lender;
use App\Models\Rating;
use App\Models\Rent;
use App\Models\User;
use Carbon\Carbon;

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

        $lend = Lender::findOrFail($lend_id);
        $order = GameOrder::findOrFail($lend->game_order_id);
        $rentPost = Rent::findOrFail($lend->rent_id);
        if ($status == 1 || $status == 4) {
            $rentPost->rented_user_id = null;
            $rentPost->rented_lend_id = null;
            $rentPost->save();
            $availableRent = Rent::where('game_id', $rentPost->game_id)
                ->where('status', 1)
                ->where('rented_user_id', null)
                ->where('rented_lend_id', null)
                ->count();
            if (2 > $availableRent) {
                logger("in the sent reminder section from rent post available");
                SendReminder::dispatch($rentPost->game_id);
            }
        }
        if ($status == 3){
            $date = Carbon::parse($lend->updated_at)->addDays($lend->lend_week * 7);
            if ($rentPost->disk_type != 1){
                $date = Carbon::parse($lend->updated_at)->addDays($lend->lend_week * 7 + 1);
            }
        }
        if ($status == 1) {
            $date = Carbon::today();
        }

        $lend->end_date = $date ?? null;
        $lend->status = $status;
        $lend->save();

        if ($order->end_date == null || $lend->end_date > $order->end_date){
            $order->end_date = $lend->end_date;
            $order->save();
        }


        if ($status == 6){
            SentSubOrderPostponedEmail::dispatch($lend);
        }
        if ($status == 5){
            SentSubOrderProcessingEmail::dispatch($lend);
        }
        if ($status == 3){
            SentSubOrderDeliveredEmail::dispatch($lend);
        }
        if ($status == 1){

            $rating = new Rating();
            $rating->lend_id = $lend->id;
            $rating->renter_id = $lend->lender_id;
            $rating->lender_id = $lend->renter_id;
            $rating->save();

            SentSubOrderCompletedEmail::dispatch($lend);
        }
        return true;
    }
}
