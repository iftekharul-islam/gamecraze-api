<?php

namespace App\Repositories;

use App\Jobs\SendEmailToLender;
use App\Jobs\SendEmailToRenter;
use App\Models\CartItem;
use App\Models\Commission;
use App\Models\CouponUser;
use App\Models\GameOrder;
use App\Models\Lender;
use App\Models\Rent;
use App\Models\User;
use App\Models\walletSpendHistory;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Modules\Orders\Entities\Models\Order;

class LenderRepository {

    public function all() {
        return Lender::with('rent.game','rent.platform','rent.diskCondition', 'order')
            ->where('lender_id', auth()->user()->id)
            ->orderBy('created_at','DESC')
            ->get();
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
//        $discountOnDiskType = false;
        $totalCommission = 0;
        $cartIds = [];
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
        $totalOrderAmount = $request->totalAmount + $request->deliveryCharge + $request->spendWalletAmount;
        $gameOrder = GameOrder::create([
            'order_no' => $this->generateOrderNo(),
            'user_id' => $lender->id,
            'amount' => $totalOrderAmount,
            'commission' =>  0,
            'payment_method' => $request->get('paymentMethod'),
            'payment_status' => 0,
            'delivery_status' => 0,
            'delivery_charge' => $request->get('deliveryCharge') ? $request->get('deliveryCharge') : 0,
            'address' => $request->address ?? '',
            'wallet_amount' => $request->spendWalletAmount ?? 0,
            'coupon_id' => $request->couponId,
            'discount_amount' => $request->discountAmount,
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

            $regularAmount = $cartItems[$i]['regular_price'];
            $regularCommission = $cartItems[$i]['regular_commission'];
            $discountAmount = $cartItems[$i]['discount_price'];
            $discountCommission = $cartItems[$i]['discount_commission'];

            $paymentAmount = $regularAmount;
            $paymentCommission = $regularCommission;
            $data = Lender::create([
                'lender_id' => $lender->id,
                'rent_id' => $cartItems[$i]['rent_id'],
                'lend_week' => $cartItems[$i]['rent_week'],
                'checkpoint_id' => $cartItems[$i]['delivery_type'] ?? null,
                'lend_cost' => $paymentAmount,
                'commission' => $paymentCommission,
                'original_commission' => $cartItems[$i]['regular_commission'],
                'renter_id' => $cartItems[$i]['renter_id'],
                'lend_date' => Carbon::now(),
                'payment_method' => $request->get('paymentMethod'),
                'status' => 0,
                'game_order_id' => $gameOrder->id,
//                'discount_amount' => config('gamehub.discount_on_commission') == true ? ($regularAmount + $regularCommission) - ($paymentAmount + $paymentCommission) : 0,
//                'reference' => config('gamehub.discount_on_commission') == true ? config('gamehub.offer_reference') : '',
            ]);
            $totalCommission += $data['commission'];
            Rent::where('id', $cartItems[$i]['rent_id'])
                ->update([
                    'rented_user_id' => $lender->id,
                    'rented_lend_id' => $data->id
                ]);

        }
        $gameOrder->commission = ceil($totalCommission);
        $gameOrder->save();

//        if ($discountOnDiskType == true) {
//            $lender->achieve_discount = true;
//        }
        if ($request->spendWalletAmount != 0){
            $lender->wallet = $lender->wallet - $request->spendWalletAmount;
            $lender->save();

            $spendData = new walletSpendHistory();
            $spendData->user_id = $lender->id;
            $spendData->order_id = $gameOrder->id;
            $spendData->amount = $request->spendWalletAmount;
            $spendData->reason = 'Spend for order';
            $spendData->save();
        }

        if ($request->couponId != null) {
            $couponHistory = new CouponUser();
            $couponHistory->user_id = $lender->id;
            $couponHistory->order_id = $gameOrder->id;
            $couponHistory->coupon_id = $request->couponId;
            $couponHistory->amount = $request->discountAmount;
            $couponHistory->save();
        }

        SendEmailToRenter::dispatch($renterDetails, $gameNames, $gameOrder['order_no']);
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

        return ceil(($amount * $commission));
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
