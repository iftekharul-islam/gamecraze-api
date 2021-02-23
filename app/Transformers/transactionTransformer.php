<?php


namespace App\Transformers;


use App\Models\TransactionHistory;
use Carbon\Carbon;
use League\Fractal\TransformerAbstract;

class transactionTransformer extends TransformerAbstract
{
    public function transform(TransactionHistory $transactions)
    {
        return [
            'id' => $transactions->id,
            'transaction_id' => $transactions->transaction_id,
            'amount' => $transactions->amount,
            'create' => Carbon::parse($transactions->created_at)->format('d-m-Y'),
            'payment_type' => $transactions->payment_type
        ];
    }
}
