<?php

namespace App\Http\Controllers\API;

use App\Exchange;
use App\Http\Controllers\BaseController;
use App\TransactionHistory;
use Illuminate\Http\Request;

class TransactionController extends BaseController
{
    public function index() {
        $transactions = TransactionHistory::all();
        return response()->json(compact('transactions'), 200);
    }

    public function show(Request $request) {
        $transaction = TransactionHistory::findOrFail($request->id);
        return response()->json(compact('transaction'), 200);
    }

    public function store(Request $request) {
        $transaction = new TransactionHistory();
        $transaction->user_id = $request->user_id;
        $transaction->post_id = $request->post_id;
        $transaction->amount = $request->amount;
        $transaction->description = $request->description;
        $transaction->save();

        $post = Exchange::findOrFail($request->post_id);
        $post->borrower_id = $request->user_id;
        $post->save();
    }
}
