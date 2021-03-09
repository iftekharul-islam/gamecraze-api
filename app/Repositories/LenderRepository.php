<?php

namespace App\Repositories;

use App\Jobs\SendEmailToLender;
use App\Jobs\SendEmailToRenter;
use App\Models\CartItem;
use App\Models\Commission;
use App\Models\GameOrder;
use App\Models\Lender;
use App\Models\Rent;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LenderRepository {

    public function all() {
        return Lender::with('rent.game','rent.platform','rent.diskCondition')->where('lender_id', auth()->user()->id)->get();
    }

    /**
     * @return mixed
     */
    public function myLends() {
        return Rent::where('rented_user_id', auth()->user()->id)->count();
    }
    /**
     * @param Request $request
     * @return array
     */
    public function create(Request $request) {
        $lender = auth()->user();
        $itemInCart = [];
        $myTotalLends = $this->myLends();
        $cartItems = $request->get('cart_items');
        $existInCart = $this->isExistInCart($cartItems);

        if ($existInCart > 0 ){
            logger('Not exist in the cart section');
            return [
                'error' => true,
                'message' => "Opps !!! You exceeded renting limit. Return your current games to rent new ones"
            ];
        }
        if ($myTotalLends >= $lender->rent_limit){
            logger('Opps !!! You exceeded renting limit. Return your current games to rent new ones');
            return [
                'error' => true,
                'message' => "Opps !!! You exceeded renting limit. Return your current games to rent new ones "
            ];
        }
        $existRentLimit = $lender->rent_limit - $myTotalLends;
        if (count($cartItems) > $existRentLimit){
            logger('You can not rent more than two games');
            return [
                'error' => true,
                'message' => "You can not rent more than two games at a time please Choose any " . $existRentLimit . " games to proceed an order."
            ];
        }
        $ExistLends = $this->checkRented($cartItems);
        if ($ExistLends) {
            logger($ExistLends);
            logger('Opps !!! The game ' . $ExistLends . ' is exist');
            return [
                'error' => true,
                'message' => "Opps !!! The game " . $ExistLends . " you wanted to rent is not available at this moment."
            ];
        }

        $totalOrderAmount = $this->cartTotal($cartItems);
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

        $itemCount = count($cartItems);

        for ($i = 0; $i < $itemCount; $i++) {
            $itemInCart[] = $cartItems[$i]['id'];
            $price = $cartItems[$i]['rent']['data']['game']['data']['basePrice']['data']['base'];
            $totalOrderAmount = $totalOrderAmount + $price;
            $data = [
                'lender_id' => $lender->id,
                'rent_id' => $cartItems[$i]['rent']['data']['id'],
                'lend_week' => $cartItems[$i]['rent_week'],
                'checkpoint_id' => $cartItems[$i]['delivery_type'] ?? null,
                'lend_cost' => $price,
                'commission' => $this->commissionAmount($price),
                'renter_id' => $cartItems[$i]['rent']['data']['user_id'],
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
            $rent = Rent::findOrFail($cartItems[$i]['rent']['data']['id']);
            $rent->rented_user_id = $lender->id;
            $rent->save();

            $renter = User::findOrFail($cartItems[$i]['rent']['data']['user_id']);
            SendEmailToRenter::dispatch($renter);
        }

        SendEmailToLender::dispatch($lender);
        CartItem::destroy($itemInCart);

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
                $price = $item['rent']['data']['game']['data']['basePrice']['data']['base'];
                $amount = $amount + $price;
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
        $commission = config('gamehub.commission');

        return ($amount * $commission);
    }

    /**
     * @param $items
     * @return mixed|null
     */
    public function checkRented($items) {
        $data = [];
        $itemCount = count($items);

        for ($i = 0; $i < $itemCount; $i++) {
            $value = Rent::where('id', $items[$i]['rent']['data']['id'])
                ->where('rented_user_id', '!=', null)
                ->first();

            if ($value) {
                $data []= $items[$i]['rent']['data']['game']['data']['name'];
            }
        }

        return $data;

    }

    /**
     * @param $items
     * @return int
     */
    public function isExistInCart($items) {
        $itemCount = count($items);
        $totalData = 0;
        for ($i = 0; $i < $itemCount; $i++) {
            $value = CartItem::where('id', $items[$i]['rent']['data']['id'])
                ->where('user_id', Auth::user()->id)
                ->count();
            $totalData += $value;
        }

        return $totalData;

    }
}
