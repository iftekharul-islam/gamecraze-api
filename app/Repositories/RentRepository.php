<?php

namespace App\Repositories;

use App\Models\Rent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class RentRepository {
    public function all() {
        return Rent::with('game', 'user', 'platform', 'diskCondition')
            ->where(auth()->user()->id, 'user_id')->get();
    }

    public function store(Request $request) {
        $rent = $request->only([
            'game_id', 'max_week', 'availability', 'platform_id',
            'disk_condition_id', 'rented_user_id', 'status'
        ]);
        if (isset($request->cover_image))
        {
            $image = $request->cover_image;
            $cover_image = 'cover_' . time() . '_' .$rent['game_id'] . '.' . explode('/', explode(':', substr($image, 0, strpos($image, ';')))[1])[1];
            \Image::make($image)->save(storage_path('app/public/rent-image/') . $cover_image);
            $rent['cover_image'] =  $cover_image ;
        }
        if (isset($request->disk_image))
        {
            $image = $request->disk_image;
            $disk_image = 'disk_' . time() . '_' .$rent['game_id'] . '.' . explode('/', explode(':', substr($image, 0, strpos($image, ';')))[1])[1];
            \Image::make($image)->save(storage_path('app/public/rent-image/').$disk_image);
            $rent['disk_image'] =   $disk_image ;
        }
        $rent['user_id'] = auth()->user()->id;

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
        $rent = Rent::find($id);
        if ($rent) {
            return $rent->delete();
        }
        return 0;
    }
}
