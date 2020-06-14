<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\BaseController;
use App\Transformers\GameTransformer;
use App\Repositories\SearchRepository;
use Illuminate\Http\Request;

class SearchController extends BaseController
{
    private $searchRepository;

    public function __construct(SearchRepository $searchRepository) {
        $this->searchRepository = $searchRepository;
    }

    public function search($name) {
        if ($name != '') {
            $games = $this->searchRepository->search($name);
            return $this->response->collection($games, new GameTransformer());
        }
        else {
            return response()->json('Empty');
        }

    }
}
