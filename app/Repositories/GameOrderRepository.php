<?php


namespace App\Repositories;

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
            return true;
        }

        return false;
    }
}
