<?php


namespace App\Repositories;

use App\Models\DiskCondition;
use Illuminate\Http\Request;

class DiskConditionRepository
{
    public function all() {
        return DiskCondition::all();
    }

    public function store($request) {
        return $disk_condition = DiskCondition::create([
            'name' => $request->name,
            'description' =>  $request->description,
            'status' => $request->status,
        ]);
    }

    public function show($id) {
        return $disk_condition = DiskCondition::findOrFail($id);
    }

    public function update($request) {
        $disk_condition = DiskCondition::findOrFail($request->id);
        $disk_condition->name = $request->name;
        $disk_condition->description = $request->description;
        $disk_condition->status = $request->status;
        $disk_condition->save();

        return $disk_condition;
    }

    public function delete($id) {
        $disk_condition = DiskCondition::findOrFail($id);
        $disk_condition->delete();
    }

}
