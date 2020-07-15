<?php

namespace App\Repositories;

use App\models\Lender;
use Carbon\Carbon;
use Illuminate\Http\Request;

class LenderRepository {
    /**
     * @param Request $request
     * @return array
     */
    public function create(Request $request) {
        for ($i = 0; $i < count($request->postId); $i++) {
            $data = [
                'lender_id' => auth()->user()->id,
                'rent_post_id' => $request->postId[$i],
                'lend_week' => $request->week[$i],
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
        }
        return [
            'error' => false,
            'message' => "Store Successful"
        ];
    }
}
