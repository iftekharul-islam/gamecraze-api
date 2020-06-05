<?php

namespace App\Http\Controllers\API;

use App\Game;
use App\Http\Controllers\BaseController;
use App\Http\Requests\GameCreateRequest;
use App\Repositories\GameRepository;
use App\Services\AssetService;
use App\Transformers\GameTransformer;
use Illuminate\Http\Request;

class GameController extends BaseController
{
    private $gameRepository;
    private $assetService;

    public function __construct(GameRepository $gameRepository, AssetService $assetService)
    {
        $this->gameRepository = $gameRepository;
        $this->assetService = $assetService;
    }

    public function index()
    {
        $games = $this->gameRepository->all();
        return $this->response->collection($games, new GameTransformer());
    }

    public function store(GameCreateRequest $request)
    {
        $game = $this->gameRepository->create($request);
        $this->assetService->create($request, $game->id);
        return $game;
    }

    public function show(Request $request)
    {
        $game = $this->gameRepository->findById($request->id);
        return $this->response->item($game, new GameTransformer());
    }

    public function update(Request $request)
    {
        $game = $this->gameRepository->update($request);
        return $this->response->item($game, new GameTransformer);
    }

    public function destroy(Request $request)
    {
        $this->gameRepository->delete($request->id);
    }

    public function latestGames() {
//        return Game::latest('release_date')->paginate(2);
        $games = Game::latest('released')->take(5)->get();
        return $this->response->collection($games, new GameTransformer());
    }

    public function search(Request $request) {
        $gameName = $request->name;
        if ($gameName != '') {
            $games = $this->gameRepository->search($gameName);
            return $this->response->collection($games, new GameTransformer());
        }
        else {
            return response()->json('Empty');
        }

    }
}
