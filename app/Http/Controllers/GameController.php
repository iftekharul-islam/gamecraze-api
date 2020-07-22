<?php

namespace App\Http\Controllers;

use App\Http\Requests\GameCreateRequest;
use App\Models\Asset;
use App\Models\Game;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

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
        return view('admin.game.index', compact('games'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.game.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(GameCreateRequest $request)
    {
        $game_data = $request->only(['name', 'game_mode', 'rating', 'description', 'released']);
        $game_data['author_id'] = auth()->user()->id;
        $game_data['slug'] = Str::slug($game_data['name']);
        $game_data['publisher'] = 'Testing';
        $game_data['description'] = $game_data['description'] ? $game_data['description'] : 'Testing description';
        $game = Game::create($game_data);

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
        return redirect()->route('all-game')->with('status', 'Game successfully stored');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $game = Game::findOrFail($id);
        $asset = Asset::findOrFail($id);
        return view('admin.game.edit', compact('game', 'asset'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $game = Game::findOrFail($id);
        $game->delete();
        return back()->with('status', 'Game successfully deleted');
    }
}
