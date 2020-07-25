<?php


namespace App\Repositories\Admin;


use App\Models\Genre;
use Illuminate\Support\Str;

class GenreRepository
{
    /**
     * @return Genre[]|\Illuminate\Database\Eloquent\Collection
     */
    public function all()
    {
        return $genres = Genre::all();
    }

    /**
     * @param $request
     * @return mixed
     */
    public function store($request) {
        $data = $request->only([
            'name'
        ]);
        $data['author_id'] = auth()->user()->id;
        $data['slug'] = Str::slug($request->name);
        return Genre::create($data);
    }

    /**
     * @param $id
     * @return mixed
     */
    public function edit($id) {
        return Genre::findOrFail($id);
    }

    /**
     * @param $request
     * @return bool
     */
    public function update($request) {
        $genre = Genre::find($request->id);
        if (!$genre) {
            return false;
        }
        $data = $request->only(['name']);

        if (isset($data['name'])) {
            $genre->name = $data['name'];
            $genre->slug = Str::slug($data['name']);
        }
        $genre->save();
        return $genre;
    }

    /**
     * @param $id
     * @return mixed
     */
    public function delete($id) {
        $genre = Genre::find($id);
        $genre->delete();
        return $genre;
    }

}
