<?php


namespace App\Repositories\Admin;

use App\Models\Area;
use App\models\Checkpiont;
use App\Models\User;

class CheckpointRepository
{
    /**
     * @return mixed
     */
    public function all() {
        return Checkpiont::orderBy('created_at', 'ASC')->get();
    }

    /**
     * @return mixed
     */
    public function allUser() {
        return User::orderBy('created_at', 'ASC')->get();
    }

    /**
     * @return mixed
     */
    public function allArea() {
            return Area::orderBy('created_at', 'ASC')->get();
    }

    /**
     * @param $request
     * @return mixed
     */
    public function store($request) {
        $checkpoint = $request->only([ 'name', 'user_id', 'flat_no', 'house_no', 'road_no', 'block_no', 'area_id',
            'availability_start_time', 'availability_end_time', 'holiday', 'status', 'comment']);
        $checkpoint['author_id'] = auth()->user()->id;
        return Checkpiont::create($checkpoint);
    }

    /**
     * @param $id
     * @return mixed
     */
    public function edit($id) {
        return Checkpiont::findOrFail($id);
    }

    /**
     * @param $id
     * @return mixed
     */
    public function show($id) {
        return Checkpiont::with('user', 'area', 'area.thana', 'area.thana.district', 'area.thana.district.division')->findOrFail($id);
    }

    /**
     * @param $request
     * @return mixed
     */
    public function update($request) {
        $checkpoint = Checkpiont::findOrFail($request->id);
        $data = $request->only(['name', 'user_id', 'flat_no', 'house_no', 'road_no', 'block_no', 'area_id',
            'availability_start_time', 'availability_end_time', 'holiday', 'status', 'comment']);

        if (isset($data['name'])) {
            $checkpoint->name = $data['name'];
        }
        if (isset($data['user_id'])) {
            $checkpoint->user_id = $data['user_id'];
        }
        if (isset($data['flat_no'])) {
            $checkpoint->flat_no = $data['flat_no'];
        }
        if (isset($data['house_no'])) {
            $checkpoint->house_no = $data['house_no'];
        }
        if (isset($data['road_no'])) {
            $checkpoint->road_no = $data['road_no'];
        }
        if (isset($data['flat_no'])) {
            $checkpoint->flat_no = $data['flat_no'];
        }
        if (isset($data['block_no'])) {
            $checkpoint->block_no = $data['block_no'];
        }
        if (isset($data['area_id'])) {
            $checkpoint->area_id = $data['area_id'];
        }
        if (isset($data['availability_start_time'])) {
            $checkpoint->availability_start_time = $data['availability_start_time'];
        }
        if (isset($data['availability_end_time'])) {
            $checkpoint->availability_end_time = $data['availability_end_time'];
        }
        if (isset($data['holiday'])) {
            $checkpoint->holiday = $data['holiday'];
        }
        if (isset($data['status'])) {
            $checkpoint->status = $data['status'];
        }
        if (isset($data['comment'])) {
            $checkpoint->comment = $data['comment'];
        }
        $checkpoint->save();
        return $checkpoint;
    }

}
