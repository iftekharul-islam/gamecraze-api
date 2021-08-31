<?php


namespace App\Repositories\Admin;


use App\Models\Division;
use Illuminate\Support\Str;

class DivisionRepository
{
    /**
     * @return Platform[]|\Illuminate\Database\Eloquent\Collection
     */
    public function all() {
        return Division::orderBy('name', 'ASC')->get();
    }

    /**
     * @param $request
     * @return mixed
     */
    public function store($request) {
        $division = $request->only(['name', 'status', 'bn_name']);
        $division['author_id'] = auth()->user()->id;
        $division['slug'] = Str::slug($division['name']);
        return Division::create($division);
    }

    /**
     * @param $id
     * @return mixed
     */
    public function edit($id) {
        return Division::findOrFail($id);
    }

    /**
     * @param $request
     * @return bool
     */
    public function update($request) {
        $division = Division::findOrFail($request->id);
        $data = $request->only(['name', 'status']);

        if (isset($data['name'])) {
            $division->name = $data['name'];
            $division->slug = Str::slug($data['name']);
        }
        if (isset($data['status'])) {
            $division->status = $data['status'];
        }
        $division->save();
        return $division;
    }

    /**
     * @param $id
     * @return mixed
     */
    public function delete($id) {
        $platform = Division::find($id);
        $platform->delete();
        return $platform;
    }

}
