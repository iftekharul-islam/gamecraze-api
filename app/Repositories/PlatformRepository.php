<?php

namespace App\Repositories;

use App\Models\Platform;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PlatformRepository {
    public function all() {
        return Platform::all();
    }

    public function findById($id) {
        return Platform::findOrFail($id);
    }

    public function create(Request $request) {
        $platform = new Platform();
        $platform->name = $request->name;
        $platform->slug = Str::slug($request->name);
        $platform->save();

        return $platform;
    }

    public function update(Request $request) {
        $platform = Platform::findOrFail($request->id);
        $platform->name = $request->name;
        $platform->slug = Str::slug($request->name);
        $platform->save();

        return $platform;
    }

    public function delete($id) {
        $platform = Platform::findOrFail($id);
        $platform->delete();
        return;
    }
}
