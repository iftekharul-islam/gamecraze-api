<?php

namespace App\Repositories;

use App\Models\Game;
use App\Models\Genre;
use App\Models\Platform;
use Illuminate\Http\Request;

class GameRepository {
    public function all() {
        return Game::all();
    }

    public function findById($id) {
        return Game::findOrFail($id);
    }

    public function create(Request $request) {
        $game = new Game();
        $game->name = $request->name;
        $game->game_mode = $request->game_mode;
        $game->description = $request->description;
        $game->released = $request->released;
        $game->rating = $request->rating;
        $game->publisher = $request->publisher;

        $game->save();

        if ($request->has('tags')) {
	        $tags = explode(',', $request->tags);
	        $game->tag($tags);
        }


//        $genres_id = Genre::whereIn('name', $request->genres)->get(['id']);
//        $game->genres()->attach($genres_id);
//
//        $platforms_id = Platform::whereIn('name', $request->platforms)->get(['id']);
//        $game->platforms()->attach($platforms_id);
        return $game;
    }

    public function update(Request $request) {
        $game = Game::findOrFail($request->id);
        $game->name = $request->name;
        $game->game_mode = $request->game_mode;
        $game->description = $request->description;
        $game->released = $request->release_date;
        $game->rating = $request->rating;
        $game->publisher = $request->publisher;
        $game->save();

        return $game;
    }

    public function delete($id) {
        $game = Game::find($id);

        if ($game) {
	        return $game->delete();
        }

        return 0;
    }

    public function search($gameName) {
        return Game::where('name','like','%'.$gameName.'%')->orderBy('id','desc')->get();
    }
}
