<?php

namespace App\Http\Controllers;

use App\Exchange;
use App\Transformers\ExchangeTransformer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends BaseController
{
    public function index() {
        $exchanges = Exchange::all();
        return $this->response->collection($exchanges, new ExchangeTransformer);
    }

    public function show(Request $request) {
        $exchange = Exchange::findOrFail($request->id);
        return $this->response->item($exchange, new ExchangeTransformer);
    }

    public function store(Request $request) {
        $user = Auth::user();
        $exchange = new Exchange();

        $exchange->lender_id = $user->id;
        $exchange->game_id = $request->game_id;
        $exchange->no_of_days = $request->no_of_days;
        $exchange->condition = $request->condition;
        $exchange->disk_health = $request->disk_health;
        $exchange->save();

        return response()->json('Exchange data added successfully.');
    }

    public function update(Request $request)
    {
        $exchange = Exchange::findOrFail($request->id);
        if (Auth::user()->id == $exchange->lender_id) {
            $exchange->game_id = $request->game_id;
            $exchange->no_of_days = $request->no_of_days;
            $exchange->condition = $request->condition;
            $exchange->disk_health = $request->disk_health;

            $exchange->save();
        }
        else
        {
            return response()->json('You can not update this post');
        }

    }

    public function destroy(Request $request)
    {
        $exchange = Exchange::findOrFail($request->id);
        if (Auth::user()->id == $exchange->lender_id) {
            $exchange->delete();
        }
        else {
            return response()->json('You can not delete this post');
        }

    }
}
