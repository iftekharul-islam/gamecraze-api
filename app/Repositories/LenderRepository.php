<?php

namespace App\Repositories;

use App\Jobs\SendEmailToLender;
use App\Jobs\SendEmailToRenter;
use App\Models\Commission;
use App\Models\GameOrder;
use App\Models\Lender;
use App\Models\Rent;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class LenderRepository {

    public function all() {
        return Lender::with('rent.game','rent.platform','rent.diskCondition')->where('lender_id', auth()->user()->id)->get();
    }
    /**
     * @param Request $request
     * @return array
     */
    public function create(Request $request) {
        $lender = auth()->user();
        $cartItems = $request->get('cart_items');
        $totalOrderAmount = $this->cartTotal($cartItems);;
        $gameOrder = GameOrder::create([
            'order_no' => generateOrderNo(), 
            'user_id' => $lender->id, 
            'amount' => $totalOrderAmount,
            'commission' => $this->commissionAmount($totalOrderAmount),
            'payment_method' => $request->get('paymentMethod'), 
            'payment_status' => strtolower($request->get('paymentMethod')) == 'cod' ? 0 : 1,
            'delivery_status' => 0,
            'delivery_charge' => $request->get('delivery_charge') ? $request->get('delivery_charge') : 0,
            'address' => $request->address ?? '',
        ]);

        for ($i = 0; $i < count($cartItems); $i++) {
            $totalOrderAmount = $totalOrderAmount + $cartItems[$i]['price'];
            $data = [
                'lender_id' => $lender->id,
                'rent_id' => $cartItems[$i]['rent']['id'],
                'lend_week' => $cartItems[$i]['lend_week'],
                'checkpoint_id' => $cartItems[$i]['delivery_type'] == 'u'  ? null :  $cartItems[$i]['delivery_type'],
                'lend_cost' => $cartItems[$i]['price'],
                'commission' => $this->commissionAmount($cartItems[$i]['price']),
                'renter_id' => $cartItems[$i]['rent']['user_id'],
                'lend_date' => Carbon::now(),
                'payment_method' => $request->get('paymentMethod'),
                'address' => $request->get('address') ? $request->get('address') : null,
                'status' => 0,
                'game_order_id' => $gameOrder->id
            ];

            $lend = Lender::create($data);
            if (!$lend) {
                return [
                    'error' => true,
                    'message' => "Something went wrong"
                ];
            }
            $rent = Rent::findOrFail($cartItems[$i]['rent']['id']);
            $rent->rented_user_id = $lender->id;
            $rent->save();

            $renter = User::findOrFail($cartItems[$i]['rent']['user_id']);
            SendEmailToRenter::dispatch($renter);
        }

        SendEmailToLender::dispatch($lender);
        return [
            'error' => false,
            'message' => "Store Successful"
        ];
    }

    /**
     * @param $cart
     * @return float|int
     */
    public function cartTotal($cart) {
        if (count($cart)) {
            $amount = 0;
            foreach($cart as $item) {
                $amount = $amount + $item['price'];
            }
            return round($amount, 2);
        }

        return 0;
    }

    /**
     * @param $amount
     * @return float|int
     */
    public function commissionAmount($amount)
    {
        $commission = Commission::first();

        return ($amount * $commission->amount / 100);
    }
}
