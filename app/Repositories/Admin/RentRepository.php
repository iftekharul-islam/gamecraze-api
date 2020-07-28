<?php


namespace App\Repositories\Admin;

use App\Jobs\SendEmailToRenter;
use App\Models\Rent;
use App\Notifications\RenterNotification;

class RentRepository
{
    /**
     * @return \Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection
     */
    public function all() {
        return Rent::with('game', 'user', 'platform', 'diskCondition')->get();
    }

    /**
     * @param $id
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Model|object|null
     */
    public function details($id) {
        return Rent::with('game', 'user', 'platform', 'diskCondition')
            ->where('id', $id)
            ->first();
    }

    /**
     * @param $id
     * @return mixed
     */
    public function approve($id) {

        $rent = Rent::findOrFail($id);
        $rent->status = 1;
        $rent->save();
        return $rent;
    }

    /**
     * @param $request
     * @param $id
     * @return mixed
     */
    public function reject($request, $id) {

        $rent = Rent::findOrFail($id);
        $rent->status = 0;
        $rent->reason = $request->reason;
        $rent->save();
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
