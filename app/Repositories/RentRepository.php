<?php

namespace App\Repositories;

use App\Models\Rent;
use Illuminate\Http\Request;

class RentRepository {
    public function all() {
        return Rent::all();
    }

    public function store(Request $request, $disk_image, $cover_image) {
        return $rent = Rent::create([
            'user_id' => auth()->user()->id,
            'game_id' =>  $request->game_id,
            'max_week' =>  $request->max_week,
            'availability' =>  $request->availability,
            'platform_id' =>  $request->platform_id,
            'earning_amount' =>  $request->earning_amount,
            'disk_condition_id' =>  $request->disk_condition_id,
            'cover_image' =>  $request->$disk_image ? 'storage/' . $disk_image : '',
            'disk_image' =>  $request->$cover_image ? 'storage/' . $cover_image : '',
            'rented_user_id' =>  $request->disk_condition_id,
            'status' => $request->status,
        ]);
    }

    public function update($request) {
        $rent = Rent::findOrFail($request->id);
        $rent->game_id = $request->game_id;
        $rent->max_week = $request->max_week;
        $rent->availability = $request->availability;
        $rent->platform_id = $request->platform_id;
        $rent->earning_amount = $request->earning_amount;
        $rent->cover_image = $request->cover_image;
        $rent->disk_image = $request->disk_image;
        $rent->rented_user_id = $request->rented_user_id;
        $rent->status = $request->status;
        $rent->save();

        return $rent;
    }

    public function delete($id) {
        $rent = Rent::findOrFail($id);
        $rent->delete();
    }
}
