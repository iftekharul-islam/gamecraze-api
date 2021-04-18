<?php

namespace App\Http\Controllers;

use App\Models\GameOrder;

use App\Repositories\GameOrderRepository;
use Illuminate\Http\Request;

class GameOrderController extends Controller
{
    public $gameOrderRepository;

    public function __construct(GameOrderRepository $gameOrderRepository)
    {
        $this->gameOrderRepository = $gameOrderRepository;
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        $orders = $this->gameOrderRepository->all($request);
//        return $orders;

        return view('admin.order.index', compact('orders'));
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($id)
    {
        $order = $this->gameOrderRepository->show($id);
        return view('admin.order.show', compact('order'));
    }

    public function updateOrderStatus(Request $request, $status_type, $order_id) {

        $order = $this->gameOrderRepository->updateStatus($status_type, $order_id, $request->status);
        if ($order) {
            return back()->with('status', 'Status updated');
        }

        return back()->with('error', 'Failed to update status');
    }
}
