<?php


namespace App\Repositories\Admin;


use App\Models\DiskCondition;
use PhpParser\Node\Stmt\Return_;

class DiskCondtionRepository
{
    /**
     * @return DiskCondition[]|\Illuminate\Database\Eloquent\Collection
     */
    public function all() {
        Return DiskCondition::all();
    }

    /**
     * @param $request
     * @return mixed
     */
    public function store($request) {

        $diskCondition = $request->only(['name', 'description', 'status']);
        $diskCondition['author_id'] = auth()->user()->id;
        Return DiskCondition::create($diskCondition);
    }

    /**
     * @param $id
     * @return mixed
     */
    public function edit($id) {
        return DiskCondition::findOrFail($id);
    }

    /**
     * @param $request
     * @return bool
     */
    public function update($request) {

        $diskCondition = DiskCondition::find($request->id);
        if (!$diskCondition) {
            return false;
        }
        $data = $request->only(['name', 'description', 'status']);

        if (isset($data['name'])) {
            $diskCondition->name = $data['name'];
        }
        if (isset($data['description'])) {
            $diskCondition->description = $data['description'];
        }
        if (isset($data['status'])) {
            $diskCondition->status = $data['status'];
        }
        $diskCondition->save();
        return $diskCondition;
    }

    /**
     * @param $id
     * @return mixed
     */
    public function delete($id) {

        $diskCondition = DiskCondition::findOrFail($id);
        $diskCondition->delete();
        return $diskCondition;
    }
}
