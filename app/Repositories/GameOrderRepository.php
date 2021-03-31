<?php


namespace App\Repositories;

use App\Jobs\SentOrderCompletedEmail;
use App\Jobs\SentOrderDeliveredEmail;
use App\Jobs\SentOrderProcessingEmail;
use App\Models\GameOrder;
use App\Models\Order;

class GameOrderRepository
{
    /**
     * @param $request
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function all($request) {

        $order = GameOrder::query();

        if ($request->status != 1 && $request->status != null) {
            $order->where('delivery_status', 0);
        }
        if ($request->status) {
            $order->where('delivery_status', $request->status);
        }
        if ($request->search) {
            $order->where('order_no', 'LIKE', "%{$request->search}%");
        }

        return $order->with(['user'])->orderby('created_at', 'desc')->paginate(config('gamehub.pagination'));
    }

    public function show($id) {
        return GameOrder::with(['user.address', 'lenders.rent.game'])->findOrFail($id);
    }

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

            if ($status == 4) {
                SentOrderProcessingEmail::dispatch($order);
            }
            if ($status == 2) {
                SentOrderDeliveredEmail::dispatch($order);
            }
            if ($status == 1) {
                SentOrderCompletedEmail::dispatch($order);
            }
            return true;
        }

        return false;
    }
}
