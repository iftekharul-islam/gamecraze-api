<?php


namespace App\Repositories;

use App\Jobs\SentOrderCompletedEmail;
use App\Jobs\SentOrderDeliveredEmail;
use App\Jobs\SentOrderProcessingEmail;
use App\Models\GameOrder;

class GameOrderRepository
{
    /**
     * 
     */
    public function all($page = 20) {
        return GameOrder::with(['user'])->orderby('created_at', 'desc')->paginate($page);
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
                logger('in the pro');
                SentOrderProcessingEmail::dispatch($order);
            }
            if ($status == 2) {
                logger('in the delivered');
                SentOrderDeliveredEmail::dispatch($order);
            }
            if ($status == 1) {
                logger('in the completed');
                SentOrderCompletedEmail::dispatch($order);
            }
            return true;
        }

        return false;
    }
}
