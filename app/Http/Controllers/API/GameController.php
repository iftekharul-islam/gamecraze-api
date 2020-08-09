<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\GameUpdateRequest;
use App\Models\Game;
use App\Http\Controllers\BaseController;
use App\Http\Requests\GameCreateRequest;
use App\Repositories\GameRepository;
use App\Services\AssetService;
use App\Transformers\GameTransformer;
use Dingo\Api\Exception\DeleteResourceFailedException;
use Dingo\Api\Exception\StoreResourceFailedException;
use Dingo\Api\Exception\UpdateResourceFailedException;
use Illuminate\Http\Request;

class GameController extends BaseController
{
    /**
     * @var GameRepository
     */
    private $gameRepository;
    /**
     * @var AssetService
     */
    private $assetService;

    /**
     * GameController constructor.
     * @param GameRepository $gameRepository
     * @param AssetService $assetService
     */
    public function __construct(GameRepository $gameRepository, AssetService $assetService)
    {
        $this->gameRepository = $gameRepository;
        $this->assetService = $assetService;
    }

    /**
     * @return \Dingo\Api\Http\Response
     */
    public function index()
    {
        $games = $this->gameRepository->all();
        return $this->response->collection($games, new GameTransformer());
    }

	/**
	 * @param GameCreateRequest $request
	 *
	 * @return \Dingo\Api\Http\Response
	 */
    public function store(GameCreateRequest $request)
    {
        $game = $this->gameRepository->create($request);
        if (!$game) {
            throw new StoreResourceFailedException();
        }
        return $this->response->item($game, new GameTransformer());
    }

    /**
     * @param $id
     * @return \Dingo\Api\Http\Response
     */
    public function show($id)
    {
        $game = $this->gameRepository->findById($id);
        return $this->response->item($game, new GameTransformer());
    }

    /**
     * @param GameUpdateRequest $request
     * @return \Dingo\Api\Http\Response
     */
    public function update(Request $request, $id)
    {
        $game = $this->gameRepository->update($request, $id);
        if ($game === 0) {
            throw new UpdateResourceFailedException();
        }
        return $this->response->item($game, new GameTransformer());
    }

    /**
     * @param $id
     * @return mixed
     */
    public function destroy($id)
    {
        $status = $this->gameRepository->delete($id);

        if ($status == 0) {
            throw new DeleteResourceFailedException();
        }

        return $this->response->array([
            "status_code" => 200,
            "message" => "Resource has been deleted."
        ]);
    }

    /**
     * @return \Dingo\Api\Http\Response
     */
    public function latestGames() {
        $games = Game::latest('released')->take(5)->get();
        return $this->response->collection($games, new GameTransformer());
    }

    public function rentGames(Request $request) {
        $ids = explode(',', $request->ids);
        $games = $this->gameRepository->rentGames($ids);
        return $this->response->collection($games, new GameTransformer());
    }
}
