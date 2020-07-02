<?php

namespace App\Repositories;

use App\Models\Rent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class RentRepository {
    public function all() {
        return Rent::all();
    }

    public function store(Request $request, $disk_image, $cover_image) {
//        return $disk_image;
        $rent = $request->only([
            'game_id', 'max_week', 'availability', 'platform_id', 'earning_amount',
            'disk_condition_id', 'rented_user_id', 'status'
        ]);
        $rent['user_id'] = auth()->user()->id;
        $rent['cover_image'] =  $cover_image ;
        $rent['disk_image'] =   $disk_image ;

        return Rent::create($rent);
    }

    public function show($id) {
        return Rent::findOrFail($id);
    }

    public function update($request) {
	    $rent = Rent::find($request->id);
	    
	    if (!$rent) {
	    	return false;
	    }
	    
        $rent_data = $request->only([
          'game_id', 'max_week', 'availability', 'platform_id', 'earning_amount',
          'disk_condition_id', 'rented_user_id', 'status', 'cover_image', 'disk_image'
        ]);

        if (isset($rent_data['cover_image'])){
            $rent->cover_image = Storage::disk('public')->put('rent-image/' , $request->file('cover_image'));
        }
        if (isset($rent_data['disk_image'])){
            $rent->cover_image = Storage::disk('public')->put('rent-image/' , $request->file('disk_image'));
        }
        if (isset($rent_data['game_id'])) {
            $rent->game_id= $rent_data['game_id'];
        }
        if (isset($rent_data['max_week'])) {
            $rent->max_week= $rent_data['max_week'];
        }
        if (isset($rent_data['availability'])) {
            $rent->availability= $rent_data['availability'];
        }
        if (isset($rent_data['platform_id'])) {
            $rent->platform_id= $rent_data['platform_id'];
        }
        if (isset($rent_data['earning_amount'])) {
            $rent->earning_amount= $rent_data['earning_amount'];
        }

        if (isset($rent_data['disk_condition_id'])) {
            $rent->disk_condition_id= $rent_data['disk_condition_id'];
        }

        if (isset($rent_data['rented_user_id'])) {
            $rent->rented_user_id= $rent_data['rented_user_id'];
        }
        if (isset($rent_data['status'])) {
            $rent->status= $rent_data['status'];
        }

        $rent->save();
        return $rent;

    }

    public function delete($id) {
        $rent = Rent::findOrFail($id);
        return $rent->delete();
    }
}
