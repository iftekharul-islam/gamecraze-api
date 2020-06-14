<?php

namespace App\Repositories;

use App\Models\Game;
use Illuminate\Http\Request;

class SearchRepository {
    public function search($gameName) {
        return Game::where('name','like','%'.$gameName.'%')->orderBy('id','desc')->get();
    }
}
