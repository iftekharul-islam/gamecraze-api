<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\GameUpdateRequest;
use App\Models\Game;
use App\Http\Controllers\BaseController;
use App\Http\Requests\GameCreateRequest;
use App\Repositories\GameRepository;
use App\Services\AssetService;
use App\Transformers\GameTransformer;
use App\Transformers\RentTransformer;
use Dingo\Api\Exception\DeleteResourceFailedException;
use Dingo\Api\Exception\StoreResourceFailedException;
use Dingo\Api\Exception\UpdateResourceFailedException;
use Dingo\Api\Http\Response;
use Illuminate\Http\Request;
use function Composer\Autoload\includeFile;

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
     * @return Response
     */
    public function index()
    {
        $games = $this->gameRepository->all();

        return $this->response->collection($games, new GameTransformer());
    }

    /**
     * @return Response
     */
    public function allRentPosts()
    {
        $rents = $this->gameRepository->allRentPosts();
        return $this->response->collection($rents, new RentTransformer());
    }

    /**
     * @param GameCreateRequest $request
     *
     * @return Response
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
     * @return Response
     */
    public function show($id)
    {
        $game = $this->gameRepository->findById($id);
        return $this->response->item($game, new GameTransformer());
    }

    public function showBySlug($slug)
    {
        $game = $this->gameRepository->findBySlug($slug);
        return $this->response->item($game, new GameTransformer());
    }

    /**
     * @param GameUpdateRequest $request
     * @return Response
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
     * @return Response
     */
    public function upcomingGames()
    {
        $games = $this->gameRepository->upcomingGames();
        return $this->response->collection($games, new GameTransformer());
    }

    public function releasedGames()
    {
        $games = $this->gameRepository->releasedGames();
        return $this->response->collection($games, new GameTransformer());
    }

    /**
     * @return Response
     */
    public function trendingGames()
    {
        $games = $this->gameRepository->trending(8);
        return $this->response->collection($games, new RentTransformer());
    }

    public function popularGames()
    {
        $rents = $this->gameRepository->popularGames(10);
        return $this->response->collection($rents, new RentTransformer());
    }
    /**
     * @param Request $request
     * @return Response
     */
    public function rentGames(Request $request)
    {
        $ids = explode(',', $request->ids);
        $games = $this->gameRepository->rentGames($ids);
        return $this->response->collection($games, new GameTransformer());
    }

    public function filterGames(Request $request)
    {
        $ids = explode(',', $request->input('ids'));



        if ($request->input('search')) {
            $search = $request->input('search');
        }
        else {
            $search = "";
        }


        if ($request->input('categories')) {
            $categories = explode(',', $request->input('categories'));
        }
        else {
            $categories = [];
        }
        if ($request->input('platforms')) {
            $platforms = explode(',', $request->input('platforms'));
        }
        else {
            $platforms = [];
        }
        if ($request->input('diskType')) {
            $arrayItem = explode(',', $request->input('diskType'));
            $data = config('gamehub.disk_type');
            foreach ($arrayItem as $item) {
                 if (in_array($item, $data)){
                     $diskType[] = $data[$item];
                 }
            }
        }
        else {
            $diskType = [];
        }

        $filteredGames = $this->gameRepository->filterGames($ids, $categories, $platforms, $diskType, $search);

        return $this->response->collection($filteredGames, new RentTransformer());
    }

    public function relatedGames(Request $request, $genres) {
        if ($genres) {
            $genres = explode(',', $genres);
        }
        else {
            $genres = [];
        }
        $games = $this->gameRepository->relatedGames($genres);
        return $this->response->collection($games, new RentTransformer());
    }
}
