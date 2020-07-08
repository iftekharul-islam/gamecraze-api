<?php

namespace App\Repositories;

use App\Models\Platform;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PlatformRepository {
    /**
     * @return Platform[]|\Illuminate\Database\Eloquent\Collection
     */
    public function all() {
        return Platform::all();
    }

    /**
     * @param $id
     * @return mixed
     */
    public function findById($id) {
        return Platform::findOrFail($id);
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function create(Request $request) {
        $platform = $request->only(['name']);
        $platform['author_id'] = auth()->user()->id;
        $platform['slug'] = Str::slug($platform['name']);
        return Platform::create($platform);
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function update(Request $request) {

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
     * @return int
     */
    public function delete($id) {
        $platform = Platform::find($id);

        if ($platform) {
            return $platform->delete();
        }

        return 0;
    }
}
