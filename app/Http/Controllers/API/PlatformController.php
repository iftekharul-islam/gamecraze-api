<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\BaseController;
use App\Game;
use App\Transformers\GameTransformer;
use Illuminate\Http\Request;

class PlatformController extends BaseController
{
    public function index() {
        $games = Game::all();
        return $this->response->collection($games, new GameTransformer());
    }
}
