<?php


namespace App\Repositories\Admin;


use App\Models\GameMode;
use Illuminate\Support\Str;

class GameModeRepository
{
    /**
     * @return GameMode[]|\Illuminate\Database\Eloquent\Collection
     */
    public function all() {
        return GameMode::orderBy('name', 'ASC')->get();
    }

    /**
     * @param $request
     * @return mixed
     */
    public function store($request) {
        $gameMode = $request->only(['name', 'status']);
        $gameMode['author_id'] = auth()->user()->id;
        $gameMode['slug'] = Str::slug($gameMode['name']);
        return GameMode::create($gameMode);
    }

    /**
     * @param $id
     * @return mixed
     */
    public function edit($id) {
        return GameMode::findOrFail($id);
    }

    /**
     * @param $request
     * @return bool
     */
    public function update($request) {
        $gameMode = GameMode::findOrFail($request->id);
        $data = $request->only(['name', 'status']);

        if (isset($data['name'])) {
            $gameMode->name = $data['name'];
            $gameMode->slug = Str::slug($data['name']);
        }
        if (isset($data['status'])) {
            $gameMode->status = $data['status'];
        }
        $gameMode->save();
    }

    /**
     * @param $id
     * @return mixed
     */
    public function delete($id) {
        $gameMode = GameMode::find($id);
        $gameMode->delete();
        return $gameMode;
    }
}
