<?php

namespace App\Http\Controllers;

use App\Models\Coupon;
use App\Models\User;
use Illuminate\Http\Request;

class CouponController extends Controller
{
    public function index()
    {
        $data = Coupon::all();

        return view('admin.coupon.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = User::with('roles')->whereHas('roles', function ($query) {
                    $query->where('name', '!=', 'admin');
                })->orderBy('created_at', 'DESC')->get();

        return view('admin.coupon.create', compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->only(['name', 'code', 'amount', 'amount_type', 'user_type', 'set_user_id', 'limit',
                                'start_date', 'end_date', 'status', 'author_id']);
        $data['author_id'] = auth()->user()->id;
        Coupon::create($data);

        return redirect()->route('coupon')->with("status", 'New discount type successfully created');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Discount  $discount
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = Coupon::with('user')->findOrFail($id);

        return view('admin.coupon.show', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Discount  $discount
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Coupon::find($id);

        return view('admin.coupon.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Discount  $discount
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $discount = Coupon::findOrFail($request->id);

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
        return redirect()->route('coupon')->with('status', 'Discount successfully updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Discount  $discount
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Coupon::findOrfail($id);
        $data->delete();
        return back()->with('status', 'Coupon deleted successfully');
    }
}
