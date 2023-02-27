<?php

namespace App\Repositories;


use App\Models\Rent;
use Illuminate\Http\Request;

class SearchRepository {
    public function search($gameName) {
//        return Rent::where('game.name','like', '%'.$gameName.'%')->orderBy('id','desc')->get();
         return Rent::all();
    }
}
