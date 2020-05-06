<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\BaseController;
use App\Management;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ManagementController extends BaseController
{
    public function index() {
        $managements = Management::all();
        return response()->json(compact('managements'), 200);
    }

    public function show(Request $request) {
        $management = Management::findOrFail($request->id);
        return response()->json(compact('management'), 200);
    }

    public function store(Request $request) {
        $management = new Management();
        $user_id = Auth::user()->id;
        $management->user_id = $user_id;
        $management->delivery_type = $request->delivery_type;
        $management->delivery_amount = $request->delivery_amount;
        $management->delivery_commission = $request->delivery_commission;
        $management->save();
    }

    public function update(Request $request) {
        $management = Management::findOrFail($request->id);
        $management->delivery_type = $request->delivery_type;
        $management->delivery_amount = $request->delivery_amount;
        $management->delivery_commission = $request->delivery_commission;
        $management->save();
    }

    public function destroy(Request $request) {
        $management = Management::findOrFail($request->id);
        $management->delete();
    }
}
