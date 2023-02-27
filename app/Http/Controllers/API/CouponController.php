<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use App\Models\CouponUser;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CouponController extends Controller
{
    public function applyCode(Request $request)
    {
        $today = Carbon::today();
        $coupon = Coupon::where('code', $request->promo)->where('status', true)
                ->where('start_date', '<=', $today)->where('end_date', '>=', $today)
                ->first();
        if (!$coupon){
            return $this->response->array([
                'coupon_id' => null,
                'amount' => 0,
                'error' => true
            ]);
        }
        if ($coupon->limit != null) {
            $userUsed = CouponUser::where('coupon_id', $coupon->id)->where('user_id', Auth::user()->id)->count();

            if ($userUsed >= $coupon->limit){
                return $this->response->array([
                    'coupon_id' => null,
                    'amount' => 0,
                    'error' => true
                ]);
            }
        }
        if ($coupon->set_user_id != null && $coupon->set_user_id != Auth::user()->id) {
            return $this->response->array([
                'coupon_id' => $coupon->id,
                'amount' => 0,
                'error' => true
            ]);
        }

        $user_type = Auth::user()->is_verified == 1 ? config('gamehub.user_type.elite') : config('gamehub.user_type.rookie');

        if ($coupon->user_type != null && $coupon->user_type != $user_type) {
            logger('coupon in user type');
            return $this->response->array([
                'coupon_id' => $coupon->id,
                'amount' => 0,
                'error' => true
            ]);
        }
        $amount = $this->amountCalculation($coupon, $request);
        return $this->response->array([
            'coupon_id' => $coupon->id,
            'amount' => $amount,
            'error' => false
        ]);
    }

    /**
     * @param $coupon
     * @param $request
     * @return float|int
     */
    public function amountCalculation($coupon, $request)
    {
        $amount = 0;
        if ($coupon->amount_type == config('gamehub.amount_type.flat')) {
            $amount = $request->amount - $coupon->amount;
        } elseif ($coupon->amount_type == config('gamehub.amount_type.percentage')) {
            $amount = ceil($request->amount - (($request->amount*$coupon->amount)/100));
        }

        return $amount;
    }
}
