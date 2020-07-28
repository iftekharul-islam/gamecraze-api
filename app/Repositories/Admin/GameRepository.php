<?php


namespace App\Repositories\Admin;


use App\Models\Asset;
use App\Models\Game;
use App\Models\Genre;
use Illuminate\Support\Str;

class GameRepository
{
    /**
     * @return Game[]|\Illuminate\Database\Eloquent\Collection
     */
    public function allGame() {
        return Game::all();
    }

    /**
     * @return Game[]|\Illuminate\Database\Eloquent\Collection
     */
    public function allGenre () {
        return Genre::all();
    }

    /**
     *
     */
    public function show ($id) {
        return Game::with('assets')->findOrFail($id);
    }
    /**
     * @param $request
     * @return mixed
     */
    public function store($request) {

        $game_data = $request->only(['name', 'game_mode', 'rating', 'description', 'released']);
        $game_data['author_id'] = auth()->user()->id;
        $game_data['slug'] = Str::slug($game_data['name']);
        $game_data['publisher'] = 'Testing';
        $game_data['description'] = $game_data['description'] ? $game_data['description'] : 'Testing description';
        $game = Game::create($game_data);

        $game->genres()->sync($request->genres, false);

        if ($request->hasFile('game_image')) {
            $image = $request->file('game_image');
            $image_name = 'game-'. auth()->user()->id. '-' .$image->getClientOriginalName();
            $path = "game-image/". $image_name;
            $image->storeAs('game-image' , $image_name);

            Asset::create([
                'game_id' => $game->id,
                'name' => $image_name,
                'url' => 'storage/'. $path,
            ]);
        }
        return $game;
    }

    /**
     * @param $id
     */
    public function editGame($id) {
        return Game::findOrFail($id);
    }

    /**
     * @param $id
     * @return mixed
     */
    public function editAsset($id) {
        return Asset::findOrFail($id);
    }
    /**
     * @param $id
     * @return mixed
     */
    public function delete($id) {
        $game = Game::findOrFail($id);
        $game->delete();
        return $game;
    }
}
