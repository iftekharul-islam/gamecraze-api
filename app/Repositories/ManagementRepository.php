<?php

namespace App\Repositories;

use App\Models\Management;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ManagementRepository {
    public function all() {
        return Management::all();
    }

    public function findById($id) {
        return Management::findOrFail($id);
    }

    public function create(Request $request) {
        $management = new Management();
        $user_id = Auth::user()->id;
        $management->user_id = $user_id;
        $management->delivery_type = $request->delivery_type;
        $management->delivery_amount = $request->delivery_amount;
        $management->delivery_commission = $request->delivery_commission;
        $management->save();

        return $management;
    }

    public function update(Request $request) {
        $management = Management::findOrFail($request->id);
        $management->delivery_type = $request->delivery_type;
        $management->delivery_amount = $request->delivery_amount;
        $management->delivery_commission = $request->delivery_commission;
        $management->save();

        return $management;
    }

    public function delete($id) {
        $management = Management::find($id);
        if ($management) {
            return $management->delete();
        }

        return 0;
    }
}
