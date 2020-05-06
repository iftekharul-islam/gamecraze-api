<?php

namespace App\Http\Controllers\API;

use App\Genre;
use App\Http\Controllers\BaseController;
use Illuminate\Http\Request;

class GenreController extends BaseController
{
    public function index() {
        $genres = Genre::all();
        return response()->json(compact('genres'), 200);
    }

    public function show(Request $request) {
        $genre = Genre::findOrFail($request->id);
        return response()->json(compact('genre'), 200);
    }

    public function store(Request $request) {
        $genre = new Genre();
        $genre->name = $request->name;
        $genre->slug = $request->slug;
        $genre->save();
    }

    public function update(Request $request) {
        $genre = Genre::findOrFail($request->id);
        $genre->name = $request->name;
        $genre->slug = $request->slug;
        $genre->save();
    }

    public function destroy(Request $request) {
        $genre = Genre::findOrFail($request->id);
        $genre->delete();
    }
}
