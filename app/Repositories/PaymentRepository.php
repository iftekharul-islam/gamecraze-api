<?php

namespace App\Repositories;


use App\Models\Order;

class PaymentRepository {
    public function success() {
        $order = Order::where('phone', auth()->user()->phone_number)->latest()->first();
        if ($order->status == 'Processing' || $order->status == 'Complete') {
            return [
                'error' => false,
                'order' => $order
            ];
        }

        return [
            'error' => true,
            'order' => $order
        ];
    }
}
