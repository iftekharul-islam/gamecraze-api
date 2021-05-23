<?php

namespace App\Http\Controllers;

use App\Models\Discount;
use Illuminate\Http\Request;

class DiscountController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Discount::all();

        return view('admin.discount.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.discount.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->only(['type', 'code', 'amount', 'author_id', 'status']);
        $data['author_id'] = auth()->user()->id;
        Discount::create($data);
        return redirect()->route('discount')->with("status", 'New discount type successfully created');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Discount  $discount
     * @return \Illuminate\Http\Response
     */
    public function show(Discount $discount)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Discount  $discount
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Discount::find($id);

        return view('admin.discount.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Discount  $discount
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Discount $discount)
    {
        $discount = Discount::findOrFail($request->id);

        if (!$discount) {
            return redirect()->route('discount')->with('error', 'Discount not updated');
        }
        $data = $request->only(['amount', 'status', 'author_id']);

        if (isset($data['type'])) {
            $discount->type = $data['type'];
        }
        if (isset($data['code'])) {
            $discount->code = $data['code'];
        }
        if (isset($data['amount'])) {
            $discount->amount = $data['amount'];
        }
        if (isset($data['status'])) {
            $discount->status = $data['status'];
        }
        $discount->author_id = auth()->user()->id;

        $discount->save();
        return redirect()->route('discount')->with('status', 'Discount successfully updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Discount  $discount
     * @return \Illuminate\Http\Response
     */
    public function destroy(Discount $discount)
    {
        //
    }
}
