<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Jobs\SentExtendEmailToAdmin;
use App\Models\ExtendLend;
use App\Models\Lender;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ExtendLendController extends Controller
{
    public function store(Request $request)
    {
        $lend = Lender::with('lender', 'order')->where('id', $request->id)->first();

        if ($lend){
            $extend = new ExtendLend();
            $extend->lend_id = $request->id;
            $extend->user_id = Auth::user()->id;
            $extend->week = $request->week;
            $extend->amount = $request->amount;
            $extend->commission = $request->commission;
            $extend->save();

            SentExtendEmailToAdmin::dispatch($lend);
            return $this->response->array([
                'error' => false,
                'message' => 'Extend request successfully created'
            ]);
        }

        return $this->response->array([
            'error' => true,
            'message' => 'Extend request failed to created'
        ]);
    }
}
