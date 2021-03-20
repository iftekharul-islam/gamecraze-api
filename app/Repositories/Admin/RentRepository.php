<?php


namespace App\Repositories\Admin;

use App\Jobs\AcceptEmailToRenter;
use App\Jobs\RejectEmailToRenter;
use App\Jobs\SendEmailToRenter;
use App\Jobs\SendReminder;
use App\Models\Rent;
use App\Models\User;
use App\Notifications\RenterNotification;

class RentRepository
{
    /**
     * @return \Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection
     */
    public function all() {
        return Rent::with('game', 'user', 'platform', 'diskCondition')->orderBy('created_at','DESC')->get();
    }

    /**
     * @param $id
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Model|object|null
     */
    public function details($id) {
        return Rent::with('game', 'user', 'platform', 'diskCondition', 'game.basePrice', 'checkpoint', 'checkpoint.area')
            ->where('id', $id)
            ->first();
    }

    /**
     * @param $id
     * @return mixed
     */
    public function approve($id) {

        $rent = Rent::with('game')->findOrFail($id);
        $userId = $rent->user_id;

        $rent->status = 1;
        $rent->save();

        $renter = User::where('id', $userId)->first();
        AcceptEmailToRenter::dispatch($renter, $rent->game->name);

        $game_in_rent = Rent::where('game_id', $rent->game_id)->where('status', 1)->count();

        if ($game_in_rent < 2) {
            logger("in sent reminder section");
            SendReminder::dispatch($rent->game_id);
        }
        return $rent;
    }

    /**
     * @param $request
     * @param $id
     * @return mixed
     */
    public function reject($request, $id) {

        $rent = Rent::findOrFail($id);
        $userId = $rent->user_id;
        $rent->status = 2;
        $rent->reason = $request->reason;
        $rent->save();
        $renter = User::where('id', $userId)->first();
        RejectEmailToRenter::dispatch($renter, $rent);
        return $rent;
    }

    /**
     * @param $id
     * @return mixed
     */
    public function delete($id) {

        $rent = Rent::findOrfail($id);
        $rent->delete();
        return $rent;
    }
}
