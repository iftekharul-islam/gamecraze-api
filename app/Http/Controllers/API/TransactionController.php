<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\BaseController;
use App\Http\Requests\TransactionCreateRequest;
use App\Models\Lender;
use App\Models\User;
use App\Repositories\TransactionRepository;
use App\Models\TransactionHistory;
use App\Transformers\transactionTransformer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransactionController extends BaseController
{
    private $transactionRepository;

    public function __construct(TransactionRepository $transactionRepository)
    {
        $this->transactionRepository = $transactionRepository;
    }

    public function index() {
        $transactions = $this->transactionRepository->all();
        return response()->json(compact('transactions'), 200);
    }

    public function show(Request $request) {
        $transaction = $this->transactionRepository->findById($request->id);
        return response()->json(compact('transaction'), 200);
    }

    public function store(TransactionCreateRequest $request) {
        $transaction = $this->transactionRepository->create($request);
        return response()->json(compact('transaction'), 200);
    }

    public function transactionById()
    {
        $id = Auth::user()->id;

        $user_transaction = TransactionHistory::where('user_id', $id)->first();
        $user_lends = Lender::where('renter_id', $id)->first();

        if (!empty($user_transaction) && !empty($user_lends)) {

            $total_earning = TransactionHistory::selectRaw('SUM(amount) as paid_amount, user_id')
                ->groupBy('user_id')
                ->where('user_id', $id)
                ->first();

            $lend = User::join('lenders', 'users.id', '=', 'lenders.renter_id')
                ->selectRaw('SUM(lend_cost) as amount, SUM(commission) as commission, renter_id, users.name')
                ->groupBy('lenders.renter_id')
                ->where('lenders.status', 1)
                ->where('lenders.renter_id', $id)
                ->first();

            $due = $lend['amount'] - $total_earning['paid_amount'] ;
        }

        $transactions_details = [
            'total_earning' => isset($total_earning) ? $total_earning['paid_amount'] : 0,
            'due' => $due ?? 0,
        ];

        return response()->json(compact('transactions_details'), 200);
    }

    public function paymentHistory()
    {
        $id = Auth::user()->id;
        $transactions = TransactionHistory::where('user_id', $id)->paginate(7);

        return $this->response->paginator($transactions, new transactionTransformer());
    }
}
