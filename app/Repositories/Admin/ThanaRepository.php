<?php


namespace App\Repositories\Admin;


use App\Models\District;
use App\Models\Thana;
use Illuminate\Support\Str;

class ThanaRepository
{
    /**
     * @return Platform[]|\Illuminate\Database\Eloquent\Collection
     */
    public function all() {
        return Thana::orderBy('name', 'ASC')->get();
    }

    /**
     * @param $request
     * @return mixed
     */
    public function store($request) {
        $thana = $request->only(['name', 'district_id', 'status', 'bn_name']);
        $thana['author_id'] = auth()->user()->id;
        $thana['slug'] = Str::slug($thana['name']);
        return Thana::create($thana);
    }

    /**
     * @param $id
     * @return mixed
     */
    public function edit($id) {
        return Thana::findOrFail($id);
    }

    /**
     * @return District[]|\Illuminate\Database\Eloquent\Collection
     */
    public function allDistrict() {
            return District::all();
    }

    /**
     * @param $request
     * @return bool
     */
    public function update($request) {
        $thana = Thana::findOrFail($request->id);
        $data = $request->only(['name', 'district_id', 'status', 'bn_name']);

        if (isset($data['name'])) {
            $thana->name = $data['name'];
            $thana->slug = Str::slug($data['name']);
        }
        if (isset($data['district_id'])) {
            $thana->district_id = $data['district_id'];
        }
        if (isset($data['status'])) {
            $thana->status = $data['status'];
        }
        $thana->save();
        return $thana;
    }

    /**
     * @param $id
     * @return mixed
     */
    public function delete($id) {
        $thana = Thana::find($id);
        $thana->delete();
        return $thana;
    }
}
