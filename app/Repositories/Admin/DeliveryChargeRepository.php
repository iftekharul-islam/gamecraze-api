<?php


namespace App\Repositories\Admin;


use App\Models\DeliveryCharge;
use App\Models\Genre;
use Illuminate\Support\Str;

class DeliveryChargeRepository
{
    /**
     * @return mixed
     */
    public function all()
    {
        return $charges = DeliveryCharge::orderBy('name', 'ASC')->get();
    }

    /**
     * @param $request
     * @return mixed
     */
    public function store($request) {
        $data = $request->only([
            'name', 'charge'
        ]);

        return DeliveryCharge::create($data);
    }

    /**
     * @param $id
     * @return mixed
     */
    public function edit($id) {
        return DeliveryCharge::findOrFail($id);
    }

    /**
     * @param $request
     * @return bool
     */
    public function update($request) {
        $charge = DeliveryCharge::find($request->id);
        if (!$charge) {
            return false;
        }
        $data = $request->only(['name', 'charge']);

        if (isset($data['name'])) {
            $charge->name = $data['name'];
        }
        if (isset($data['charge'])) {
            $charge->charge = $data['charge'];
        }
        $charge->save();
        return $charge;
    }

    /**
     * @param $id
     * @return mixed
     */
    public function delete($id) {
        $charge = DeliveryCharge::find($id);
        $charge->delete();
        return $charge;
    }

    public function getCharge() {
        return DeliveryCharge::orderBy('created_at', 'desc')->first();
    }

}
