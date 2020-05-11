<?php

namespace App\Repositories;

use App\TransactionHistory;
use Illuminate\Http\Request;

class TransactionRepository {
    private $postRepository;
    public function __construct(PostRepository $postRepository)
    {
        $this->postRepository = $postRepository;
    }

    public function all() {
        return TransactionHistory::all();
    }

    public function findById($id) {
        return TransactionHistory::findOrFail($id);
    }

    public function create(Request $request) {
        $transaction = new TransactionHistory();
        $transaction->user_id = $request->user_id;
        $transaction->post_id = $request->post_id;
        $transaction->amount = $request->amount;
        $transaction->description = $request->description;
        $transaction->save();

        $this->postRepository->updateBorrower($request);

        return $transaction;
    }
}
