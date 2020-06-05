<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\BaseController;
use App\Rent;
use Illuminate\Http\Request;

class RentController extends BaseController
{
    public function index() {
        return Rent::with('game.assets')->where('status',0)->get();
    }
}
