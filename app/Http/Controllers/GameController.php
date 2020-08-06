<?php

namespace App\Http\Controllers;

use App\Http\Requests\GameCreateRequest;
use App\Repositories\Admin\GameRepository;
use Illuminate\Http\Request;

class GameController extends Controller
{
    /**
     * @var GameRepository
     */
    private $gameRepository;

    /**
     * GameController constructor.
     * @param GameRepository $gameRepository
     */
    public function __construct(GameRepository $gameRepository)
    {
        $this->gameRepository = $gameRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $games = $this->gameRepository->allGame();
        return view('admin.game.index', compact('games'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $genres = $this->gameRepository->allGenre();
        $platforms = $this->gameRepository->allPlatform();
        return view('admin.game.create', compact('genres', 'platforms'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(GameCreateRequest $request)
    {
        $this->gameRepository->store($request);
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
        $game = $this->gameRepository->show($id);
        return view('admin.game.show', compact('game'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $game = $this->gameRepository->show($id);
        $genres = $this->gameRepository->allGenre();
        $platforms = $this->gameRepository->allPlatform();
        return view('admin.game.edit', compact('game', 'genres', 'platforms'));
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
        $this->gameRepository->update($request, $id);
        return redirect()->route('all-game')->with('status', 'Game updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->gameRepository->delete($id);
        return back()->with('status', 'Game successfully deleted');
    }
}
