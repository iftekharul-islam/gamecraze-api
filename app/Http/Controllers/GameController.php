<?php

namespace App\Http\Controllers;

use App\Asset;
use App\Game;
use App\Http\Requests\GameCreateRequest;
use App\Transformers\GameTransformer;
use http\Client\Curl\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Intervention\Image\Image;
use Illuminate\Support\Facades\Response;

class GameController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $games = Game::all();
        return $this->response->collection($games, new GameTransformer());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param Request $request
     * @return void
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(GameCreateRequest $request)
    {
        $game = new Game();
        $game->name = $request->name;
        $game->release_date = $request->release_date;
        $game->no_of_players = $request->no_of_players;
        $game->description = $request->description;
        $game->price = $request->price;
        $game->user_id = $request->user_id;
        $game->genre_id = $request->genre_id;
        $game->category_id = $request->category_id;
        $game->publisher = $request->publisher;
        $game->series = $request->series;

        $game->save();

        $tags = explode(',', $request->tags);
        $game->tag($tags);

        if($request->hasfile('images'))
        {
            foreach($request->file('images') as $image)
            {
                $randomName = Str::random();
                $imageName = $randomName.'.'.$image->getClientOriginalExtension();
                $image->move(public_path().'/images/', $imageName);
                $asset = new Asset();
                $asset->name = $imageName;
                $asset->game_id = $game->id;
                $asset->save();
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param Request $request
     * @param \App\Game $game
     * @return void
     */
    public function show(Request $request, Game $game)
    {
        $game = Game::findOrFail($request->id);
        return $this->response->item($game, new GameTransformer);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Game  $game
     * @return \Illuminate\Http\Response
     */
    public function edit(Game $game)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Game  $game
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Game $game)
    {
        $game = Game::findOrFail($request->id);
        $game->name = $request->name;
        $game->genre = $request->genre;
        $game->game_type = $request->game_type;
        $game->release_date = $request->release_date;
        $game->no_of_players = $request->no_of_players;
        $game->user_id = $request->user_id;

        $game->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Request $request
     * @param \App\Game $game
     * @return void
     */
    public function destroy(Request $request, Game $game)
    {
        $game = Game::findOrFail($request->id);
        $game->delete();
    }
}
