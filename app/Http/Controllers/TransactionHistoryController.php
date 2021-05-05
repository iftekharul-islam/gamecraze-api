<?php

namespace App\Http\Controllers;

use App\Exports\TransactionsExport;
use App\Models\Lender;
use App\Models\TransactionHistory;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TransactionHistoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
         if ($request->search){
            $value = User::where(DB::raw("CONCAT(`name`, ' ', `last_name`)"), 'LIKE', "%".$request->search."%")
                ->join('lenders', 'users.id', '=', 'lenders.renter_id')
                    ->selectRaw('SUM(lend_cost) as amount, SUM(discount_amount) as discount_amount,
                            SUM(commission) as commission, SUM(original_commission) as original_commission,
                            SUM(lend_cost+commission+discount_amount) as total_amount,
                            SUM(lend_cost+commission+discount_amount-original_commission) as seller_amount,
                            SUM(original_commission) as gamehub_amount,
                            renter_id, users.name, users.last_name, users.id')
                    ->groupBy('lenders.renter_id')
                    ->where('lenders.status', 1)
                    ->where('lenders.deleted_at', null)
                    ->get();
        } else {
            $value = User::join('lenders', 'users.id', '=', 'lenders.renter_id')
                ->selectRaw('SUM(lend_cost) as amount, SUM(discount_amount) as discount_amount, 
                            SUM(commission) as commission, SUM(original_commission) as original_commission, 
                            SUM(lend_cost+commission+discount_amount) as total_amount,
                            SUM(lend_cost+commission+discount_amount-original_commission) as seller_amount, 
                            SUM(original_commission) as gamehub_amount, 
                            renter_id, users.name, users.last_name, users.id')
                ->groupBy('lenders.renter_id')
                ->where('lenders.status', 1)
                ->where('lenders.deleted_at', null)
                ->get();
        }

        $paid_amount = TransactionHistory::selectRaw('SUM(amount) as paid_amount, user_id as id')->groupBy('user_id')->get();

        $data = $value->map(function ($row) use ($paid_amount) {
            $paid = $paid_amount->where('id', $row->id)->pluck('paid_amount')->first();
            return collect($row)->put('due', $row->seller_amount - $paid);
        });

//        return gettype($data);
//        if ($request->seller_type == 1) {
//            $data = $data->where('due', '!=', '')->get();
//        }
//        return $data;

        $total_amount= 0;
        $seller_amount= 0;
        $gamehub_amount= 0;
        foreach ($data as $item) {
            $total_amount += $item['total_amount'];
            $seller_amount += $item['seller_amount'];
            $gamehub_amount += $item['gamehub_amount'];
        }

        return view('admin.transaction_history.index', compact('data', 'paid_amount', 'total_amount', 'seller_amount', 'gamehub_amount'));
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

    public function transactionExport()
    {
        $date = Carbon::now()->format('d-m-Y');
        ob_end_clean();
        ob_start();
        return (new TransactionsExport())->download('transaction-'.  time() . '-' . $date  . '.xls');
    }
}
