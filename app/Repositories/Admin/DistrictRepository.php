<?php


namespace App\Repositories\Admin;


use App\Models\District;
use App\Models\Division;
use Illuminate\Support\Str;

class DistrictRepository
{
    /**
     * @return Platform[]|\Illuminate\Database\Eloquent\Collection
     */
    public function all() {
        return District::orderBy('name', 'ASC')->get();
    }

    public function allDivision() {
        return Division::orderBy('name', 'ASC')->get();
    }
    /**
     * @param $request
     * @return mixed
     */
    public function store($request) {
        $district = $request->only(['name', 'division_id', 'status', 'bn_name']);
        $district['slug'] = Str::slug($district['name']);
        return District::create($district);
    }

    /**
     * @param $id
     * @return mixed
     */
    public function edit($id) {
        return District::findOrFail($id);
    }

    /**
     * @param $request
     * @return bool
     */
    public function update($request) {
        $district = District::findOrFail($request->id);
        $data = $request->only(['name', 'status', 'division_id', 'bn_name']);

        if (isset($data['name'])) {
            $district->name = $data['name'];
            $district->slug = Str::slug($data['name']);
        }
        if (isset($data['division_id'])){
            $district->division_id = $data['division_id'];
        }
        if (isset($data['status'])) {
            $district->status = $data['status'];
        }
        $district->save();
        return $district;
    }

    /**
     * @param $id
     * @return mixed
     */
    public function delete($id) {
        $district = District::find($id);
        $district->delete();
        return $district;
    }
}
