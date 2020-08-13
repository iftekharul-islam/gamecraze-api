<?php


namespace App\Repositories;

use App\Models\DiskCondition;
use Illuminate\Http\Request;

class DiskConditionRepository
{
    /**
     * @return DiskCondition[]|\Illuminate\Database\Eloquent\Collection
     */
    public function all() {
        return DiskCondition::orderBy('name', 'ASC')->get();
    }

    /**
     * @param $request
     * @return mixed
     */
    public function store($request) {
        $disk_condition = $request->only(['name', 'description', 'status']);
        $disk_condition['author_id'] = auth()->user()->id;
        return DiskCondition::create($disk_condition);
    }

    /**
     * @param $id
     * @return mixed
     */
    public function show($id) {
        return DiskCondition::findOrFail($id);
    }

    /**
     * @param $request
     * @return mixed
     */
    public function update($request) {
        $disk_condition = DiskCondition::find($request->id);

        if (!$disk_condition) {
            return false;
        }
        $disk_data = $request->only(['name', 'description', 'status']);

        if (isset($disk_data['name'])) {
            $disk_condition->name = $disk_data['name'];
        }
        if (isset($disk_data['description'])) {
            $disk_condition->description = $disk_data['description'];
        }
        if (isset($disk_data['status'])) {
            $disk_condition->status = $disk_data['status'];
        }
        $disk_condition->save();
        return $disk_condition;
    }

    /**
     * @param $id
     * @return int
     */
    public function delete($id) {
        $disk_condition = DiskCondition::find($id);
        if ($disk_condition) {
            return $disk_condition->delete();
        }
        return 0;
    }

}
