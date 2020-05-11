<?php

namespace App\Http\Controllers\API;

use App\Asset;
use App\Game;
use App\Http\Controllers\BaseController;
use App\Http\Requests\GameCreateRequest;
use App\Repositories\AssetRepository;
use App\Repositories\GameRepository;
use App\Services\AssetService;
use App\Transformers\GameTransformer;
use http\Client\Curl\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Image;
use Illuminate\Support\Facades\Response;

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
        return $_FILES['images'];
    }

    public function show(Request $request)
    {
        $game = $this->gameRepository->findById($request->id);
        return $this->response->item($game, new GameTransformer);
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
}
