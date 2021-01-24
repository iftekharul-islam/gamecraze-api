<?php

namespace App\Http\Controllers;

use App\Http\Requests\DeliveryChargeCreateRequest;
use App\Repositories\Admin\DeliveryChargeRepository;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class DeliveryChargeController extends Controller
{
    /**
     * @var
     */
    private $chargeRepository;

    /**
     * GenreController constructor.
     * @param DeliveryChargeRepository $chargeRepository
     */
    public function __construct(DeliveryChargeRepository $chargeRepository)
    {
        $this->chargeRepository = $chargeRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $charges = $this->chargeRepository->all();
        return view('admin.delivery-charges.index', compact('charges'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin.delivery-charges.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param DeliveryChargeCreateRequest $request
     * @return Response
     */
    public function store(DeliveryChargeCreateRequest $request)
    {
        $this->chargeRepository->store($request);
        return redirect()->route('deliveryCharge.all')->with('status', 'Delivery Charge successfully Created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $charge = $this->chargeRepository->edit($id);
        return view('admin.delivery-charges.edit', compact('charge'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request)
    {
        $this->chargeRepository->update($request);
        return redirect()->route('deliveryCharge.all')->with('status', 'Delivery Charge successfully updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        $this->chargeRepository->delete($id);
        return back()->with('status', 'Delivery Charge successfully Deleted!');
    }
}
