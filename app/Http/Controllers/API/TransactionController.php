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
        $user = Auth::user();

        $user_transaction = TransactionHistory::where('user_id', $user->id)->first();
        $user_lends = Lender::where('renter_id', $user->id)->where('status', 1)->first();

        $total_paid_amount = 0;

        if (!empty($user_transaction)) {

            $total_earning = TransactionHistory::selectRaw('SUM(amount) as paid_amount, user_id')
                ->groupBy('user_id')
                ->where('user_id', $user->id)
                ->firstOrFail();

            $total_paid_amount = $total_earning['paid_amount'];
        }

        $total_lend_amount = 0;

        if (!empty($user_lends)){

            $lend = Lender::selectRaw('SUM(lend_cost) as amount, SUM(commission) as commission, renter_id')
                ->groupBy('renter_id')
                ->where('status', 1)
                ->where('renter_id', $user->id)
                ->firstOrFail();

            $total_lend_amount = $lend['amount'];

        }
        $due = $total_lend_amount - $total_paid_amount;

        $transactions_details = [
            'total_earning' => ceil($total_paid_amount + $user->wallet),
            'due' => $due,
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
