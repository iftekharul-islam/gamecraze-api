<?php

namespace App\Http\Controllers;

use App\Jobs\SentExtendEmailToCustomer;
use App\Models\ExtendLend;
use App\Models\GameOrder;
use App\Models\Lender;
use App\Repositories\Admin\basePriceRepository;
use Carbon\Carbon;

class ExtendLendController extends Controller
{
    private $basePriceRepository;

    /**
     * ExtendLendController constructor.
     * @param basePriceRepository $basePriceRepository
     */
    public function __construct(BasePriceRepository $basePriceRepository)
    {
        $this->basePriceRepository = $basePriceRepository;
    }

    public function index()
    {
        $data = ExtendLend::with('user', 'lend')->get();

        return view('admin.extend_lend.index', compact('data'));
    }

    public function approve($id)
    {
        $data = ExtendLend::findOrFail($id);

        $lend_data = Lender::with('rent')->where('id', $data->lend_id)->first();

        if (!$lend_data) {
            return back()->with('error', 'Unable to approve this request !!');
        }

        $price = $this->basePriceRepository->gamePriceCalculation($lend_data->rent->game_id, $data->week, $lend_data->rent->disk_type);

        $lend_order = Lender::create([
            'lender_id' => $lend_data->lender_id,
            'rent_id' => $lend_data->rent_id,
            'lend_week' => $data->week,
            'checkpoint_id' => $lend_data->checkpoint_id,
            'lend_cost' => config('gamehub.discount_on_commission') == true ? $price['discount_price'] : $price['regular_price'],
            'commission' => config('gamehub.discount_on_commission') == true ? $price['discount_commission'] : $price['regular_commission'],
            'original_commission' => $price['regular_commission'],
            'renter_id' => $lend_data->renter_id,
            'lend_date' => Carbon::now(),
            'payment_method' => $lend_data->payment_method,
            'status' => 0,
            'game_order_id' => $lend_data->game_order_id,
            'discount_amount' => config('gamehub.discount_on_commission') == true ? ($price['regular_price'] + $price['regular_commission']) - ($price['discount_price'] + $price['discount_commission']) : 0,
            'reference' => config('gamehub.discount_on_commission') == true ? config('gamehub.offer_reference') : '',
        ]);

        $order_data = GameOrder::findOrFail($lend_data->game_order_id);
        $order_data->amount = $order_data->amount + ($lend_order->lend_cost + $lend_order->commission);
        $order_data->commission = $order_data->commission + $data->commission;
        $order_data->save();

        $lend_data->status = 1;
        $lend_data->save();

        $data->status = true;
        $data->save();

        SentExtendEmailToCustomer::dispatch($lend_data->lender_id, $lend_data->rent_id);

        return back()->with('status', 'Extend Request Approved successfully !!');
    }

    public function reject($id)
    {
        $data = ExtendLend::findOrFail($id);

        $data->status = false;
        $data->save();
        return back()->with('status', 'Extend Request Rejected !!');
    }
}
