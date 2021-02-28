<?php

namespace App\Repositories;

use App\Models\Game;
use App\Models\Rent;
use Carbon\Carbon;
use Illuminate\Http\Request;

class GameRepository
{

    /**
     * @return Game[]|\Illuminate\Database\Eloquent\Collection
     */
    public function all()
    {
        return Game::all();
    }

    /**
     * @param $id
     * @return mixed
     */
    public function findById($id)
    {
        return Game::findOrFail($id);
    }

    public function findBySlug($slug)
    {
        return Game::where('slug', $slug)->first();
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function create(Request $request)
    {
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
    public function update($request, $id)
    {
        $game = Game::find($id);
        if (!$game) {
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
            $game->description = $data['description'];
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
    public function delete($id)
    {
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
    public function search($gameName)
    {
        return Game::where('name', 'like', '%' . $gameName . '%')->orderBy('id', 'desc')->get();
    }

    /**
     * @return mixed
     */
    public function upcomingGames()
    {
        return Game::where('released', '>', Carbon::today()->format('Y-m-d'))->get();
    }

    public function releasedGames()
    {
        return Game::where('released', '<', Carbon::today()->format('Y-m-d'))->get();
    }

    /**
     * @return mixed
     */
    public function trending($numberOfPost = 10)
    {
        return Rent::whereHas('game', function ($q) {
            $q->where('is_trending', 1);
        })
        ->where('status', 1)
        ->select('game_id')
        ->groupBy('game_id')
        ->take($numberOfPost)
        ->get();
    }

    public function popularGames($numberOfPost = 10)
    {
        return Rent::where('status', 1)
            ->take($numberOfPost)
            ->get();
    }

    /**
     * @param $ids
     * @return mixed
     */
    public function rentGames($ids)
    {
        return Game::whereIn('id', $ids)->get();
    }

    public function filterGames($ids, $categories, $platforms, $search)
    {
        if (empty($categories) && empty($platforms) && $search == '') {
            return Game::whereIn('id', $ids)->get();
        }

        return Game::whereIn('id', $ids)
            ->when($categories, function ($q) use ($categories) {
                $q->with('genres')->whereHas('genres', function($query2) use ($categories){
                    $query2->whereIn('slug', $categories);
                });
            })
            ->when($platforms, function ($q) use ($platforms) {
                $q->with('platforms')->whereHas('platforms', function($query2) use ($platforms){
                    $query2->whereIn('slug', $platforms);
                });
            })
            ->when($search, function ($q) use ($search) {
                return $q->where('name', 'like', '%' . $search . '%');
            })
            ->get();
    }

    public function relatedGames($genres) {
        return Rent::with('game')->whereHas('game', function($query) use ($genres){
                $query->with('genres')->whereHas('genres', function($query1) use ($genres) {
                    $query1->whereIn('slug', $genres);
                });
            })
            ->select('game_id')
            ->where('status', 1)
            ->groupBy('game_id')
            ->get();
    }
}
