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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = $this->gameOrderRepository->all(20);
        return view('admin.order.index', compact('orders'));
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
     * @param  \App\GameOrder  $gameOrder
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $order = $this->gameOrderRepository->show($id);
        return view('admin.order.show', compact('order'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\GameOrder  $gameOrder
     * @return \Illuminate\Http\Response
     */
    public function edit(GameOrder $gameOrder)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\GameOrder  $gameOrder
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, GameOrder $gameOrder)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\GameOrder  $gameOrder
     * @return \Illuminate\Http\Response
     */
    public function destroy(GameOrder $gameOrder)
    {
        //
    }

    public function updateOrderStatus(Request $request, $status_type, $order_id) {
        $order = $this->gameOrderRepository->updateStatus($status_type, $order_id, $request->status);
        if ($order) {
            return back()->with('status', 'Status updated');
        }

        return back()->with('error', 'Failed to update status');
    }
}
