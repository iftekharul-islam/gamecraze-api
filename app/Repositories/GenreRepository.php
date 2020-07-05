<?php

namespace App\Repositories;

use App\Models\Genre;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class GenreRepository {
    public function all() {
        return Genre::all();
    }

    public function findById($id) {
        return Genre::findOrFail($id);
    }

    public function create(Request $request) {
        $genre = new Genre();
        $genre->name = $request->name;
        $genre->slug = Str::slug($request->name);
        $genre->save();

        return $genre;
    }

    public function update(Request $request) {
        $genre = Genre::findOrFail($request->id);
        $genre->name = $request->name;
        $genre->slug = Str::slug($request->name);
        $genre->save();

        return $genre;
    }

    public function delete($id) {
        $genre = Genre::find($id);
        if ($genre) {
            return $genre->delete();
        }

        return 0;
    }
}
