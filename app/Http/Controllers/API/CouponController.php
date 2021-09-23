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
        logger($request->promo);
        $today = Carbon::today();
        $coupon = Coupon::where('code', $request->promo)->where('status', true)
                ->where('start_date', '<=', $today)->where('end_date', '>=', $today)
                ->first();
        logger($coupon);
        if (!$coupon){
            logger('coupon not found');
            return $this->response->array([
                'coupon_id' => null,
                'amount' => 0,
                'error' => true
            ]);
        }
        if ($coupon->limit != null) {
            logger('coupon in limit');
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
            logger('coupon in set user id');
            return $this->response->array([
                'coupon_id' => $coupon->id,
                'amount' => 0,
                'error' => true
            ]);
        }

        $user_type = Auth::user()->id_verified == 1 ? config('gamehub.user_type.elite') : config('gamehub.user_type.rookie');
        logger("user type");
        logger($user_type);

        if ($coupon->user_type != null && $coupon->user_type != $user_type) {
            logger('coupon in user type');
            return $this->response->array([
                'coupon_id' => $coupon->id,
                'amount' => 0,
                'error' => true
            ]);
        }

        logger('coupon in general');
        $amount = $this->amountCalculatuon($coupon, $request);
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
    public function amountCalculatuon($coupon, $request)
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