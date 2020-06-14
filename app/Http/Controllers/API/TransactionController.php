<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\BaseController;
use App\Http\Requests\TransactionCreateRequest;
use App\Repositories\TransactionRepository;
use App\Models\TransactionHistory;
use Illuminate\Http\Request;

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
}
