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

        $rent_data = Rent::all();
        $rents = $rent_data->count();
        $approved_post = $rent_data->where('status', 1)->count();
        $reject_post = $rent_data->where('status', 2)->count();
        $pending_post = $rent_data->where('status', 0)->count();

        $users = User::with('roles')->whereHas('roles', function ($query) {
            return $query->where('name', '!=', 'admin');
        })->count();

        $lend_data = Lender::all();
        $lends = $lend_data->count();
        $pending_rent = $lend_data->where('status', 0)->count();
        $processing_rent = $lend_data->where('status', 5)->count();
        $delivered_rent = $lend_data->where('status', 3)->count();
        $rejected_rent = $lend_data->where('status', 4)->count();
        $completed_rent = $lend_data->where('status', 1)->count();

        $elite = User::with('roles')->whereHas('roles', function ($query) {
            return $query->where('name', '!=', 'admin');
        })->where('is_verified', 1)->count();

        $rookie = User::with('roles')->whereHas('roles', function ($query) {
            return $query->where('name', '!=', 'admin');
        })->where('is_verified', 0)->count();

        return view('admin.dashboard', compact('games', 'rents', 'approved_post', 'pending_post', 'reject_post', 'users', 'lends', 'pending_rent', 'delivered_rent', 'processing_rent', 'rejected_rent', 'completed_rent', 'elite', 'rookie'));
    }

}
