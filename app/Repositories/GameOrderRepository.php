<?php


namespace App\Repositories;

use App\Jobs\SentOrderCompletedEmail;
use App\Jobs\SentOrderDeliveredEmail;
use App\Jobs\SentOrderPostponedEmail;
use App\Jobs\SentOrderProcessingEmail;
use App\Models\GameOrder;
use App\Models\Order;
use App\Models\User;
use App\Models\WalletHistory;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class GameOrderRepository
{

    public function index()
    {
        return GameOrder::where('user_id', Auth::user()->id)->get();
    }

    public function getById($id)
    {
        return GameOrder::where('id', $id)->where('user_id', Auth::user()->id)->first();
    }
    /**
     * @param $request
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function all($request) {

        $order = GameOrder::query();

        if ($request->status == 0 && $request->status != null) {
            $order->where('delivery_status', 0);
        }
        if ($request->status) {
            $order->where('delivery_status', $request->status);
        }
        if ($request->search) {
            $order->where('order_no', 'LIKE', "%{$request->search}%");
        }

        if ($request->start_date !== null || $request->end_date !== null) {
            $order->whereBetween('end_date', [$request->start_date ?? Carbon::today()->subDays(30), $request->end_date ?? Carbon::today()]);
        }

        return $order->with(['user'])->orderby('created_at', 'desc')->paginate(config('gamehub.pagination'));
    }

    /**
     * @param $id
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model
     */
    public function show($id) {
        return GameOrder::with(['user.address', 'lenders.rent.game'])->findOrFail($id);
    }

    /**
     * @param $status_type
     * @param $order_id
     * @param $status
     * @return bool
     */
    public function updateStatus($status_type, $order_id, $status) {

        $order = GameOrder::findOrFail($order_id);
        if ($status_type == 'payment') {
            $order->payment_status = $status;
            $order->save();
            return true;
        }

        if ($status_type == 'delivery') {
            $order->delivery_status = $status;
            $order->save();
//            if ($status == 5) {
//                SentOrderPostponedEmail::dispatch($order);
//            }
            if ($status == 4) {
                SentOrderProcessingEmail::dispatch($order);
            }
            if ($status == 2) {
                SentOrderDeliveredEmail::dispatch($order);
            }
            if ($status == 1) {
                SentOrderCompletedEmail::dispatch($order);

                $lender = User::find($order->user_id);
                logger('lender');
                logger($lender);
                if (isset($lender->referred_by)) {

                    $orderCount = GameOrder::where('user_id', $order->user_id)->where('delivery_status', 1)->count();
                    logger('order count');
                    logger($orderCount);

                    if ( 2 > $orderCount ) {

                        logger('in the order count');

                        $referredUser = User::where('referral_code', $lender->referred_by)->first();
                        $referredUser->wallet = $referredUser->wallet + config('gamehub.referred_amount');
                        $referredUser->save();

                        logger('referred user');
                        logger($referredUser);

                        $wallet = new WalletHistory();
                        $wallet->user_id = $referredUser->id;
                        $wallet->referred_user_id = $lender->id;
                        $wallet->amount = config('gamehub.referred_amount');
                        $wallet->reason = 'Reference';
                        $wallet->save();

                        logger($referredUser->wallet);
                        logger('wallet history');
                        logger($wallet);
                    }
                }
            }
            return true;
        }

        return false;
    }
}
