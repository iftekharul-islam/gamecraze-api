<?php

namespace App\Repositories;

use App\Models\Genre;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class GenreRepository {
    /**
     * @return Genre[]|\Illuminate\Database\Eloquent\Collection
     */
    public function all() {
        return Genre::all();
    }

    /**
     * @param $id
     * @return mixed
     */
    public function findById($id) {
        return Genre::findOrFail($id);
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function create(Request $request) {
        $data = $request->only([
            'name'
        ]);
        $data['author_id'] = auth()->user()->id;
        $data['slug'] = Str::slug($request->name);

        return Genre::create($data);
    }

    /**
     * @param $request
     * @return int
     */
    public function update($request) {

        $genre = Genre::find($request->id);
        if (!$genre) {
            return 0;
        };
        $data = $request->only([
            'name'
        ]);
        if (isset($data['name'])) {
            $genre->name = $data['name'];
            $genre->slug = Str::slug($data['name']);
        }

        $genre->save();
        return $genre;
    }

    /**
     * @param $id
     * @return int
     */
    public function delete($id) {
        $genre = Genre::find($id);
        if ($genre) {
            return $genre->delete();
        }

        return 0;
    }
}
