<?php

namespace App\Repositories;

use App\Jobs\SendEmailToLender;
use App\Jobs\SendEmailToRenter;
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
        for ($i = 0; $i < count($cartItems); $i++) {
            $data = [
                'lender_id' => $lender->id,
                'rent_id' => $cartItems[$i]['rent']['id'],
                'lend_week' => $cartItems[$i]['lend_week'],
                'checkpoint_id' => $cartItems[$i]['delivery_type'] == 'u'  ? null :  $cartItems[$i]['delivery_type'],
                'lend_cost' =>$cartItems[$i]['price'],
                'lend_date' => Carbon::now(),
                'payment_method' => $request->get('paymentMethod'),
                'address' => $request->get('address') ? $request->get('address') : null,
                'status' => 0
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
}
