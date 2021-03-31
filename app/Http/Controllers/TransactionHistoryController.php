<?php

namespace App\Http\Controllers;

use App\Models\Lender;
use App\Models\TransactionHistory;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransactionHistoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $data = User::join('lenders', 'users.id', '=', 'lenders.renter_id')
            ->selectRaw('SUM(lend_cost) as amount, SUM(commission) as commission, renter_id, users.name, users.id')
            ->groupBy('lenders.renter_id')
            ->where('lenders.status', 1)
            ->get();
        $total_amount= 0;
        $customer_amount= 0;
        $gamehub_amount= 0;
        foreach ($data as $item) {
            $total_amount += $item->amount + $item->commission;
            $customer_amount += $item->amount;
            $gamehub_amount += $item->commission;
        }
        $paid_amount = TransactionHistory::selectRaw('SUM(amount) as paid_amount, user_id')->groupBy('user_id')->get();

        return view('admin.transaction_history.index', compact('data', 'paid_amount', 'total_amount', 'customer_amount', 'gamehub_amount'));
    }

    public function payAmount($id)
    {
        $data = TransactionHistory::with('author')
            ->where('user_id', $id)
            ->get();

        return view('admin.transaction_history.pay_amount', compact('data'));
    }

    public function myLendPost($id)
    {
        $data = Lender::with('lender', 'rent.game')->where('renter_id', $id)->where('status', 1)->get();

        return view('admin.transaction_history.lend_list', compact('data'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    public function payment(Request $request, $id)
    {
        $data = $request->only(['amount', 'description', 'payment_type', 'transaction_id', 'user_id', 'author_id']);

        $data['description'] = 'Test description';

        $data['user_id'] = $id;

        $data['author_id'] = Auth::user()->id;

        TransactionHistory::create($data);

        return redirect()->back()->with('status', 'Payment successfully completed');

    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
