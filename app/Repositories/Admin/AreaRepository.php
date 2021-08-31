<?php


namespace App\Repositories\Admin;


use App\Models\Area;
use App\Models\Thana;
use Illuminate\Support\Str;

class AreaRepository
{
    /**
     * @return Platform[]|\Illuminate\Database\Eloquent\Collection
     */
    public function all() {
        return Area::orderBy('name', 'ASC')->get();
    }

    /**
     * @param $request
     * @return mixed
     */
    public function store($request) {
        $area = $request->only(['name', 'thana_id', 'status', 'bn_name']);
        $area['author_id'] = auth()->user()->id;
        $area['slug'] = Str::slug($area['name']);
        return Area::create($area);
    }

    /**
     * @return mixed
     */
    public function allthana() {
        return Thana::orderBy('name', 'ASC')->get();
    }

    /**
     * @param $id
     * @return mixed
     */
    public function edit($id) {
        return Area::findOrFail($id);
    }

    /**
     * @param $request
     * @return bool
     */
    public function update($request) {
            $area = Area::findOrFail($request->id);
            $data = $request->only(['name', 'thana_id', 'status', 'bn_name']);

            if (isset($data['name'])) {
                $area->name = $data['name'];
                $area->slug = Str::slug($data['name']);
            }
            if (isset($data['thana_id'])) {
                $area->thana_id = $data['thana_id'];
            }
            if (isset($data['status'])) {
                $area->status = $data['status'];
            }
            $area->save();
            return $area;
    }

    /**
     * @param $id
     * @return mixed
     */
    public function delete($id) {
        $area = Area::find($id);
        $area->delete();
        return $area;
    }
}
