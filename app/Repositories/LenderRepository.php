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
        logger($request->all());
//        die();
        $lender = auth()->user();
        $cartIds = [];
        $data = [];
        $rentIds = [];
        $renterIds = [];
        $myTotalLends = $this->myLends();
        $cartItems = $request->get('cartItems');
        $existInCart = $this->isExistInCart($cartItems);

        if ($existInCart === true){
            logger('Not exist in the cart section');
            return [
                'error' => true,
                'message' => 'Opps !!! This item is not exist in your cart. Please rent again'
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
            logger('Opps !!! The game is rented');
            return [
                'error' => true,
                'message' => "Opps !!! The game " . implode(", ",$ExistLends) . " you wanted to rent is not available at this moment."
            ];
        }
        logger(' in the lend store section');
        $totalOrderAmount = $request->discount_price + $request->delivery_charge;
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
            $cartIds[] = $cartItems[$i]['id'];
            $rentIds[] = $cartItems[$i]['rent_id'];
            $renterIds[] = $cartItems[$i]['renter_id'];

            $price = $cartItems[$i]['discount_price'];
            $data []= [
                'lender_id' => $lender->id,
                'rent_id' => $cartItems[$i]['rent_id'],
                'lend_week' => $cartItems[$i]['rent_week'],
                'checkpoint_id' => $cartItems[$i]['delivery_type'] ?? null,
                'lend_cost' => $price,
                'commission' => $this->commissionAmount($price),
                'renter_id' => $cartItems[$i]['renter_id'],
                'lend_date' => Carbon::now(),
                'payment_method' => $request->get('paymentMethod'),
                'status' => 0,
                'game_order_id' => $gameOrder->id,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ];

        }
        Lender::insert($data);
        $rentedGames = Rent::whereIn('id', $rentIds)->update(['rented_user_id' => $lender->id]);
        logger('rented games');
        logger($rentedGames);
        SendEmailToRenter::dispatch($renterIds, $rentIds);
        CartItem::destroy($cartIds);

        logger('Store Successful');
        return [
            'error' => false,
            'message' => "Store Successful"
        ];
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
            $value = Rent::where('id', $items[$i]['rent_id'])
                ->where('rented_user_id', '!=', null)
                ->first();

            if ($value) {
                $data []= $items[$i]['game_name'];
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
        $totalData = false;
        for ($i = 0; $i < $itemCount; $i++) {
            $value = CartItem::where('id', $items[$i]['id'])->first();
            if ($value === null) {
                $totalData = true;
                // data doesn't exist
            }
        }
        return $totalData;

    }
}
