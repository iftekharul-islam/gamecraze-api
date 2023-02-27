<?php

namespace App\Http\Controllers;

use App\Jobs\SentWithdrawRequestApprovedEmailToCustomer;
use App\Jobs\SentWithdrawRequestRejectedEmailToCustomer;
use App\Jobs\SentWithdrawRequestToAdmin;
use App\Models\WithdrawRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WithdrawRequestController extends Controller
{

    public function index()
    {
        $data = WithdrawRequest::with('user')->orderBy('created_at', 'DESC')->paginate(20);

        return view('admin.withdraw_request.index', compact('data'));
    }

    public function approve($id)
    {
        $withdraw = WithdrawRequest::findOrFail($id);
        $withdraw->status = 1;
        $withdraw->save();

        SentWithdrawRequestApprovedEmailToCustomer::dispatch($withdraw);

        return back()->with('status', 'Withdraw Request Approved successfully !!');
    }

    public function reject($id)
    {
        $withdraw = WithdrawRequest::findOrFail($id);
        $withdraw->status = 2;
        $withdraw->save();

        SentWithdrawRequestRejectedEmailToCustomer::dispatch($withdraw);

        return back()->with('status', 'Withdraw Request Rejected !!');
    }

    public function store(Request $request)
    {
        $withdraw = new WithdrawRequest();
        $withdraw->user_id = Auth::user()->id;
        $withdraw->amount = $request->amount;
        $withdraw->save();

        SentWithdrawRequestToAdmin::dispatch($withdraw);

        return $this->response->array([
            'error' => false,
            'message' => 'Withdraw request successfully created'
        ]);
    }
}
