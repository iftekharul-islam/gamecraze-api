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
use Modules\Orders\Entities\Models\Order;

class LenderRepository {

    public function all() {
        return Lender::with('rent.game','rent.platform','rent.diskCondition', 'order')->where('lender_id', auth()->user()->id)->get();
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
        $cartIds = [];
        $data = [];
        $rentIds = [];
        $renterDetails = [];
        $gameNames = [];
        $myTotalLends = $this->myLends();
        $cartItems = $request->get('cartItems');
        $existInCart = $this->isExistInCart($cartItems);

        if ($existInCart === true){
            return [
                'error' => true,
                'message' => 'Opps !!! This item is not exist in your cart. Please rent again'
            ];
        }
        if ($myTotalLends >= $lender->rent_limit){
            return [
                'error' => true,
                'message' => "Opps !!! You exceeded renting limit. Return your current games to rent new ones "
            ];
        }
        $existRentLimit = $lender->rent_limit - $myTotalLends;
        if (count($cartItems) > $existRentLimit){
            return [
                'error' => true,
                'message' => "You can not rent more than two games at a time please Choose any " . $existRentLimit . " games to proceed an order."
            ];
        }
        $ExistLends = $this->checkRented($cartItems);
        if ($ExistLends) {
            return [
                'error' => true,
                'message' => "Opps !!! The game " . implode(", ",$ExistLends) . " you wanted to rent is not available at this moment."
            ];
        }
        $totalOrderAmount = $request->totalAmount + $request->deliveryCharge;
        $gameOrder = GameOrder::create([
            'order_no' => $this->generateOrderNo(),
            'user_id' => $lender->id,
            'amount' => $totalOrderAmount,
            'commission' => config('gamehub.discount_on_commission') == true ? 0 : $this->commissionAmount($totalOrderAmount),
            'payment_method' => $request->get('paymentMethod'),
            'payment_status' => strtolower($request->get('paymentMethod')) == 'cod' ? 0 : 1,
            'delivery_status' => 0,
            'delivery_charge' => $request->get('deliveryCharge') ? $request->get('deliveryCharge') : 0,
            'address' => $request->address ?? '',
        ]);

        $itemCount = count($cartItems);

        for ($i = 0; $i < $itemCount; $i++) {
            $cartIds[] = $cartItems[$i]['id'];
            $rentIds[] = $cartItems[$i]['rent_id'];
            $renterDetails[] = [
                'renter_id' => $cartItems[$i]['renter_id'],
                'game_name' => $cartItems[$i]['game_name']
            ];
            $gameNames[]= $cartItems[$i]['game_name'];

            $price = $cartItems[$i]['discount_price'];
            $data []= [
                'lender_id' => $lender->id,
                'rent_id' => $cartItems[$i]['rent_id'],
                'lend_week' => $cartItems[$i]['rent_week'],
                'checkpoint_id' => $cartItems[$i]['delivery_type'] ?? null,
                'lend_cost' => $price,
                'commission' => config('gamehub.discount_on_commission') == true ? 0 : $this->commissionAmount($price),
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
        Rent::whereIn('id', $rentIds)->update(['rented_user_id' => $lender->id]);
        SendEmailToRenter::dispatch($renterDetails, $gameNames);
        CartItem::destroy($cartIds);

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

    /**
     * @return string
     */
    public function generateOrderNo()
    {
        $latestOrder = GameOrder::orderBy('id', 'desc')->first();
        if ($latestOrder) {
            $lastNumber = explode('-', $latestOrder->order_no);
            $lastNumber = preg_replace("/[^0-9]/", "", end($lastNumber));
            $orderNo = 'GH-' . str_pad((int)$lastNumber + 1, 4, '0', STR_PAD_LEFT);
            if (GameOrder::where('order_no', $orderNo)->count() > 0) {
                $this->generateOrderNo();
            }

            return $orderNo;
        }

        return 'GH-' . date('Y') . date('m') . '-001';
    }
}
