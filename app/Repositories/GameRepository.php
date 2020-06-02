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
        $game->genre_id = $request->genre_id;
        $game->category_id = $request->category_id;
        $game->name = $request->name;
        $game->team_type = $request->team_type;
        $game->description = $request->description;
        $game->release_date = $request->release_date;
        $game->rating = $request->rating;
        $game->publisher = $request->publisher;
        $game->series = $request->series;
        $game->platform = $request->platform;

        $game->save();

        $tags = explode(',', $request->tags);
        $game->tag($tags);



        return $game;
    }

    public function update(Request $request) {
        $game = Game::findOrFail($request->id);
        $game->genre_id = $request->genre_id;
        $game->category_id = $request->category_id;
        $game->name = $request->name;
        $game->team_type = $request->team_type;
        $game->description = $request->description;
        $game->release_date = $request->release_date;
        $game->rating = $request->rating;
        $game->publisher = $request->publisher;
        $game->series = $request->series;
        $game->platform = $request->platform;
        $game->save();

        return $game;
    }

    public function delete($id) {
        $category = Game::findOrFail($id);
        $category->delete();
        return;
    }
}
