<?php

namespace App\Repositories;

use App\Jobs\SendReminder;
use App\Jobs\SentLendPostNotification;
use App\Jobs\SentRentPostNotification;
use App\Models\Game;
use App\Models\Rent;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use File;
use mysql_xdevapi\Collection;

class RentRepository {
    /**
     * @return \Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection
     */
    public function all() {
        return Rent::where( 'user_id', Auth::user()->id )->orderBy('created_at', 'DESC')->get();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection
     */
    public function allRent() {
        return Rent::where('status', 1)
            ->where('status_by_user', 1)
            ->get();
    }

    public function store(Request $request) {
        $rent = $request->only([
            'game_id', 'max_week', 'platform_id',
            'disk_condition_id', 'rented_user_id', 'checkpoint_id', 'disk_type', 'game_user_id', 'game_password'
        ]);

        $rent['availability']= Carbon::today();

        if (isset($request->checkpoint_id)) {
            $rent['checkpoint_id'] = $request->checkpoint_id ? $rent['checkpoint_id'] : '';
        }

        if (!File::isDirectory(storage_path('app/public/rent-image'))){
            File::makeDirectory(storage_path('app/public/rent-image'), 0777, true, true);
        }

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
        $post = Rent::create($rent);
        $admins = User::role('Admin')->get();
        foreach ($admins as $admin){
            SentLendPostNotification::dispatch($post, $admin);
        }

        return $post;
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
          'disk_condition_id', 'rented_user_id', 'cover_image', 'disk_image'
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

    public function cartItems($ids) {

        return Rent::whereIn('id', $ids)->get();
    }

    public function rentPostedUsers($slug) {

        $game = Game::where('slug', $slug)->first();

        return Rent::where('game_id', $game->id)
            ->where('status', 1)
            ->where('status_by_user', 1)
            ->get();
    }

    public function checkAvailableRent($request)
    {
        $game = Game::where('slug', $request->slug)->first();
        return Rent::where('game_id', $game->id)
            ->where('status', 1)
            ->where('rented_lend_id', null)
            ->where('rented_user_id', null)
            ->where('user_id', '!=', Auth::user()->id)
            ->count();
    }
}
