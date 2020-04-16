<?php

namespace App\Http\Controllers;

use App\Game;
use Illuminate\Http\Request;

class GameController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $games = Game::all();
        return response()->json(compact('games'), 200);
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
    public function store(Request $request)
    {
        $game = new Game();
        $game->name = $request->name;
        $game->genre = $request->genre;
        $game->game_type = $request->game_type;
        $game->release_date = $request->release_date;

        $game->save();
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
        return response()->json(compact('game'), 200);
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
