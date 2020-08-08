<?php

namespace App\Http\Controllers;

use App\Repositories\Admin\GameModeRepository;
use Illuminate\Http\Request;

class GameModeController extends Controller
{
    private $gameModeRepository;

    /**
     * GameModeController constructor.
     * @param GameModeRepository $gameModeRepository
     */
    public function __construct(GameModeRepository $gameModeRepository)
    {
        $this->gameModeRepository = $gameModeRepository;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $gameModes = $this->gameModeRepository->all();
        return view('admin.game-mode.index', compact('gameModes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.game-mode.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->gameModeRepository->store($request);
        return redirect()->route('gameMode.all')->with("status", 'Game Mode successfully created');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\GameMode  $gameMode
     * @return \Illuminate\Http\Response
     */
    public function show(GameMode $gameMode)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\GameMode  $gameMode
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $gameMode = $this->gameModeRepository->edit($id);
        return view('admin.game-mode.edit', compact('gameMode'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\GameMode  $gameMode
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $this->gameModeRepository->update($request);
        return redirect()->route('gameMode.all')->with('status', 'Game Mode successfully updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\GameMode  $gameMode
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->gameModeRepository->delete($id);
        return back()->with('status', 'Game Mode deleted successfully');
    }
}
