<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\BaseController;
use App\Transformers\GameTransformer;
use App\Repositories\SearchRepository;
use App\Transformers\RentTransformer;
use Illuminate\Http\Request;

class SearchController extends BaseController
{
    private $searchRepository;

    public function __construct(SearchRepository $searchRepository) {
        $this->searchRepository = $searchRepository;
    }

    public function search($name) {
        if ($name != '') {
            $rents = $this->searchRepository->search($name);
            return $this->response->collection($rents, new RentTransformer());
        }
        else {
            return response()->json('Empty');
        }

    }
}
