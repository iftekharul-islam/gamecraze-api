<?php

namespace App\Repositories;

use App\Models\Management;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ManagementRepository {
    /**
     * @return Management[]|\Illuminate\Database\Eloquent\Collection
     */
    public function all() {
        return Management::all();
    }

    /**
     * @param $id
     * @return mixed
     */
    public function findById($id) {
        return Management::findOrFail($id);
    }

    /**
     * @param Request $request
     * @return array
     */
    public function create($request) {
        $management = $request->only([
            'delivery_type', 'delivery_amount', 'delivery_commission'
        ]);
        $management['user_id'] = Auth::user()->id;

        return Management::create($management);
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function update($request) {

        $management = Management::find($request->id);

        if (!$management) {
            return 0;
        }
        $data = $request->only([
           'delivery_type', 'delivery_amount', 'delivery_commission'
        ]);
        if (isset($data['delivery_type'])) {
            $management->delivery_type = $data['delivery_type'];
        }
        if (isset($data['delivery_amount'])) {
            $management->delivery_amount = $data['delivery_amount'];
        }
        if (isset($data['delivery_commission'])) {
            $management->delivery_commission = $data['delivery_commission'];
        }
        $management->save();
        return $management;
    }

    /**
     * @param $id
     * @return int
     */
    public function delete($id) {
        $management = Management::find($id);
        if ($management) {
            return $management->delete();
        }

        return 0;
    }
}
