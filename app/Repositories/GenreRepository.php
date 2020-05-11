<?php

namespace App\Repositories;

use App\Genre;
use Illuminate\Http\Request;

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
        $genre->slug = $request->slug;
        $genre->save();

        return $genre;
    }

    public function update(Request $request) {
        $genre = Genre::findOrFail($request->id);
        $genre->name = $request->name;
        $genre->slug = $request->slug;
        $genre->save();

        return $genre;
    }

    public function delete($id) {
        $genre = Genre::findOrFail($id);
        $genre->delete();
        return;
    }
}
