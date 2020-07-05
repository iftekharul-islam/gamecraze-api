<?php

namespace App\Repositories;

use App\Models\Game;
use Illuminate\Http\Request;

class GameRepository {

    /**
     * @return Game[]|\Illuminate\Database\Eloquent\Collection
     */
    public function all() {
        return Game::all();
    }

    /**
     * @param $id
     * @return mixed
     */
    public function findById($id) {
        return Game::findOrFail($id);
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function create(Request $request) {
        $data = $request->only([
            'name', 'game_mode', 'description', 'released', 'rating', 'publisher'
        ]);
        $data['author_id'] = auth()->user()->id;
        $game = Game::create($data);

        if ($request->has('tags')) {
	        $tags = explode(',', $request->tags);
	        $game->tag($tags);
        }
        return $game;
    }

    /**
     * @param $request
     * @param $id
     * @return int
     */
    public function update($request, $id) {
        $game = Game::find($id);
        if (!$game)
        {
            return 0;
        }

        $data = $request->only([
            'name', 'game_mode', 'description', 'release_date', 'rating', 'publisher'
        ]);

        if (isset($data['name'])) {
            $game->name = $data['name'];
        };
        if (isset($data['game_mode'])) {
            $game->game_mode = $data['game_mode'];
        };
        if (isset($data['description'])) {
            $game->description= $data['description'];
        };
        if (isset($data['released'])) {
            $game->released = $data['released'];
        };
        if (isset($data['rating'])) {
            $game->rating = $data['rating'];
        };
        if (isset($data['publisher'])) {
            $game->publisher = $data['publisher'];
        };

        $game->save();
        return $game;
    }

    /**]
     * @param $id
     * @return int
     */
    public function delete($id) {
        $game = Game::find($id);

        if ($game) {
	        return $game->delete();
        }

        return 0;
    }

    /**
     * @param $gameName
     * @return mixed
     */
    public function search($gameName) {
        return Game::where('name','like','%'.$gameName.'%')->orderBy('id','desc')->get();
    }
}
