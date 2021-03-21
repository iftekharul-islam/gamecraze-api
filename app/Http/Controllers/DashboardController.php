<?php

namespace App\Http\Controllers;

use App\Models\Game;
use App\Models\Lender;
use App\Models\Rent;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $games = Game::all()->count();
        $rents = Rent::all()->count();
        $users = User::with('roles')->whereHas('roles', function ($query) {
            return $query->where('name', '!=', 'admin');
        })->count();

        $lends = Lender::all()->count();

        $elite = User::with('roles')->whereHas('roles', function ($query) {
            return $query->where('name', '!=', 'admin');
        })->where('is_verified', 1)->count();

        $rookie = User::with('roles')->whereHas('roles', function ($query) {
            return $query->where('name', '!=', 'admin');
        })->where('is_verified', 0)->count();

        return view('admin.dashboard', compact('games', 'rents', 'users', 'lends', 'elite', 'rookie'));
    }

}
