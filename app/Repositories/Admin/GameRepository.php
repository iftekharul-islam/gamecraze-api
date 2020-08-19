<?php


namespace App\Repositories\Admin;


use App\Models\Asset;
use App\Models\BasePrice;
use App\Models\Game;
use App\Models\Genre;
use App\Models\Platform;
use Illuminate\Support\Str;

class GameRepository
{
    /**
     * @return Game[]|\Illuminate\Database\Eloquent\Collection
     */
    public function allGame() {
        return Game::orderBy('name', 'ASC')->get();
    }

    /**
     * @return Game[]|\Illuminate\Database\Eloquent\Collection
     */
    public function allGenre () {
        return Genre::all();
    }

    /**
     * @return Genre[]|\Illuminate\Database\Eloquent\Collection
     */
    public function allPlatform () {
        return Platform::all();
    }

    public function basePrice () {
        return BasePrice::all();
    }

    /**
     *
     */
    public function show ($id) {
        return Game::with('assets', 'platforms', 'genres', 'basePrice')->findOrFail($id);
    }
    /**
     * @param $request
     * @return mixed
     */
    public function store($request) {

        $game_data = $request->only(['name', 'rating', 'description', 'released', 'is_trending', 'base_price_id', 'publisher', 'developer']);
        $game_data['author_id'] = auth()->user()->id;
        $game_data['slug'] = Str::slug($game_data['name']);
        $game_data['publisher'] = 'Testing';
        $game_data['description'] = $game_data['description'] ? $game_data['description'] : 'Testing description';
        $game = Game::create($game_data);

        $game->genres()->sync($request->genres, false);
        $game->platforms()->sync($request->platforms, false);

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
     * @return mixed
     */
    public function update($request, $id) {

        $game = Game::findOrFail($id);
        $data = $request->only(['name', 'released', 'rating', 'description', 'is_trending', 'publisher', 'developer']);

        if (isset($data['name'])) {
            $game->name = $data['name'];
        }
        if (isset($data['released'])) {
            $game->released = $data['released'];
        }
        if (isset($data['rating'])) {
            $game->rating = $data['rating'];
        }
        if (isset($data['description'])) {
            $game->description = $data['description'];
        }
        if (isset($data['publisher'])) {
            $game->publisher = $data['publisher'];
        }
        if (isset($data['developer'])) {
            $game->developer = $data['developer'];
        }
        if (isset($data['is_trending'])) {
            $game->is_trending = $data['is_trending'];
        }
        $game->save();

        $game->genres()->sync($request->genres);
        $game->platforms()->sync($request->platforms);

        if ($request->hasFile('game_image')) {
            $image = $request->file('game_image');
            $image_name = 'game-'. auth()->user()->id. '-' .$image->getClientOriginalName();
            $path = "game-image/". $image_name;
            $image->storeAs('game-image' , $image_name);

            if (isset($game->assets[0]) && $game->assets[0] != null){
                $oldImg = $game->assets[0]->url;
                unlink($oldImg);

                $img = Asset::find($game->assets[0]->id);
                $img->name = $image_name;
                $img->url = 'storage/'. $path;
                $img->save();
            } else {
                Asset::create([
                    'game_id' => $game->id,
                    'name' => $image_name,
                    'url' => 'storage/'. $path,
                ]);
            }
        }
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