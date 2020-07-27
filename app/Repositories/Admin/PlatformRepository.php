<?php


namespace App\Repositories\Admin;


use App\Models\Platform;
use Illuminate\Support\Str;

class PlatformRepository
{
    /**
     * @return Platform[]|\Illuminate\Database\Eloquent\Collection
     */
    public function all() {
        return Platform::all();
    }

    /**
     * @param $request
     * @return mixed
     */
    public function store($request) {
        $platform = $request->only(['name']);
        $platform['author_id'] = auth()->user()->id;
        $platform['slug'] = Str::slug($platform['name']);
        return Platform::create($platform);
    }

    /**
     * @param $id
     * @return mixed
     */
    public function edit($id) {
        return Platform::findOrFail($id);
    }

    /**
     * @param $request
     * @return bool
     */
    public function update($request) {
        $platform = Platform::find($request->id);
        if (!$platform) {
            return false;
        }
        $data = $request->only(['name']);

        if (isset($data['name'])) {
            $platform->name = $data['name'];
            $platform->slug = Str::slug($data['name']);
        }
        $platform->save();
        return $platform;
    }

    /**
     * @param $id
     * @return mixed
     */
    public function delete($id) {
        $platform = Platform::find($id);
        $platform->delete();
        return $platform;
    }
}
