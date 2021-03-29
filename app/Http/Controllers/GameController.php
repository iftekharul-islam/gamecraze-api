<?php

namespace App\Http\Controllers;

use App\Http\Requests\GameCreateRequest;
use App\Repositories\Admin\GameRepository;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

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
     * @return Response
     */
    public function index()
    {

        $games = $this->gameRepository->allGame();
        return view('admin.game.index', compact('games'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $genres = $this->gameRepository->allGenre();
        $platforms = $this->gameRepository->allPlatform();
        $basePrices = $this->gameRepository->basePrice();
        return view('admin.game.create', compact('genres', 'platforms', 'basePrices'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(GameCreateRequest $request)
    {
        $data = $this->gameRepository->store($request);

        return redirect()->route('all-game')->with('status', 'Game successfully stored');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
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
     * @return Response
     */
    public function edit($id)
    {
        $game = $this->gameRepository->show($id);
        $platforms = $this->gameRepository->allPlatform();
        $genres = $this->gameRepository->allGenre();
        $basePrices = $this->gameRepository->basePrice();
        return view('admin.game.edit', compact('game', 'genres', 'platforms', 'basePrices'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param  int  $id
     * @return Response
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
     * @return Response
     */
    public function destroy($id)
    {
        $data = $this->gameRepository->delete($id);
        if ($data === true){
            return back()->with('status', 'Game successfully deleted');
        }
        return back()->with('error', 'Game delete not successful');
    }

    public function videoDestroy($id)
    {
        $data = $this->gameRepository->videoDestroy($id);
        if ($data == true) {
            return back()->with('status', 'Game successfully deleted');
        }
        return back()->with('failed', 'Game successfully deleted');
    }

    public function screenshotsDestroy($id)
    {
        $data = $this->gameRepository->screenshotsDestroy($id);
        if ($data == true) {
            return back()->with('status', 'Screenshots successfully deleted');
        }
        return back()->with('error', 'Could not delete screenshot');
    }
}
