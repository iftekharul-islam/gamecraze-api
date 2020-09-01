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
        for ($i = 0; $i < count($request->postId); $i++) {
            $data = [
                'lender_id' => auth()->user()->id,
                'rent_id' => $request->postId[$i],
                'lend_week' => $request->week[$i],
                'checkpoint_id' => $request->checkpointId[$i] == 'u'  ? null :  $request->checkpointId[$i],
                'lend_cost' => 500,
                'lend_date' => Carbon::now(),
                'payment_method' => $request->paymentMethod,
                'status' => 0
            ];
            $lend = Lender::create($data);
            if (!$lend) {
                return [
                    'error' => true,
                    'message' => "Something went wrong"
                ];
            }
            $renter = User::find(Rent::find($request->postId[$i])->user_id);
            SendEmailToRenter::dispatch($renter);
        }
        $lender = auth()->user();
        SendEmailToLender::dispatch($lender);
        return [
            'error' => false,
            'message' => "Store Successful"
        ];
    }
}
