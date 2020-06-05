<?php

namespace App\Repositories;

use App\Game;
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
        $game->released = $request->release_date;
        $game->rating = $request->rating;
        $game->publisher = $request->publisher;

        $game->save();

        $tags = explode(',', $request->tags);
        $game->tag($tags);



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
        $category = Game::findOrFail($id);
        $category->delete();
        return;
    }

    public function search($gameName) {
        return Game::where('name','like','%'.$gameName.'%')->orderBy('id','desc')->get();
    }
}
