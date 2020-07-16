<?php

namespace App\Http\Controllers;

use App\Models\Asset;
use App\Models\Game;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
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
        return view('admin.game.all-games', compact('games'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.game.add-game');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
//        return $request->all();
        $game_data = $request->only(['name', 'game_mode', 'rating', 'description', 'released']);
        $game_data['author_id'] = auth()->user()->id;
        $game_data['slug'] = Str::slug($game_data['name']);
        $game_data['publisher'] = 'Testing';
        $game_data['description'] = $game_data['description'] ? $game_data['description'] : 'Testing description';
        $game = Game::create($game_data);


//        if (isset($request->game_image))
//        {
//            $image = $request->game_image;
//            $image_name = 'game_' . time() . '_' .$game->id . '.' . explode('/', explode(':', substr($image, 0, strpos($image, ';')))[1])[1];
//            $path = Storage::disk('public')->put('game-image', $request->file('game_image'));
//            \Image::make($image)->save(storage_path('app/public/game-image/') . $image_name);
//            $rent['cover_image'] =  $image_name ;
//            $request->url = 'game-image'. $image_name;
//            Asset::create([
//                'game_id' => $game->id,
//                'name' => $image_name,
//                'url' => $path,
//            ]);
//        }

        return redirect()->route('all-game')->with('success', 'Game successfully stored');
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
        //
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
        $game = Game::find($id);

        if ($game) {
            $game->delete();
            return redirect()->back();
        }

        return false;
    }
}
