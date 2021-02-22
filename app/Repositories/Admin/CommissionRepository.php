<?php


namespace App\Repositories\Admin;


use App\Models\BasePrice;
use App\Models\Commission;

class CommissionRepository
{
    /**
     * @return Commission[]|\Illuminate\Database\Eloquent\Collection
     */
    public function index(){
        return Commission::all();
    }

    /**
     * @param $request
     * @return mixed
     */
    public function store($request){
        $data = $request->only(['amount', 'author_id']);
        $data['author_id'] = auth()->user()->id;

        return Commission::create($data);
    }

    /**
     * @param $id
     * @return mixed
     */
    public function edit($id) {
        return Commission::findOrFail($id);
    }

    /**
     * @param $id
     * @return bool
     */
    public function delete($id) {
        $commission = Commission::find($id);

        if (!$commission) {
            return false;
        }
        $commission->delete();
        return true;
    }

    /**
     * @param $request
     * @return mixed
     */
    public function update($request) {
        $commission = Commission::findOrFail($request->id);

        if (!$commission) {
            return false;
        }
        $data = $request->only(['amount', 'status', 'author_id']);


        if (isset($data['amount'])) {
            $commission->amount = $data['amount'];
        }
        if (isset($data['status'])) {
            $commission->status = $data['status'];
        }
        $commission->author_id = auth()->user()->id;

        $commission->save();

        return $commission;
    }
}
