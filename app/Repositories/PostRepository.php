<?php

namespace App\Repositories;

use App\Exchange;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostRepository {
    public function all() {
        return Exchange::all();
    }

    public function findById($id) {
        return Exchange::findOrFail($id);
    }

    public function create(Request $request) {
        $user = Auth::user();
        $exchange = new Exchange();
        $exchange->lender_id = $user->id;
        $exchange->game_id = $request->game_id;
        $exchange->no_of_days = $request->no_of_days;
        $exchange->condition = $request->condition;
        $exchange->disk_health = $request->disk_health;
        $exchange->save();

        return $exchange;
    }

    public function update(Request $request) {
        $exchange = Exchange::findOrFail($request->id);
        if (Auth::user()->id == $exchange->lender_id) {
            $exchange->game_id = $request->game_id;
            $exchange->no_of_days = $request->no_of_days;
            $exchange->condition = $request->condition;
            $exchange->disk_health = $request->disk_health;
            $exchange->save();

            return $exchange;
        }
        else
        {
            return 'You can not update this post';
        }
    }

    public function delete($id) {
        $exchange = Exchange::findOrFail($id);
        $roles = Auth::user()->getRoleNames();
        if (Auth::user()->id == $exchange->lender_id or $roles->contains('admin')) {
            $exchange->delete();
            return 'Post deleted';
        }
        else {
            return 'You can not delete this post';
        }
    }

    public function updateBorrower(Request $request) {
        $post = Exchange::findOrFail($request->post_id);
        $post->borrower_id = $request->user_id;
        $post->save();
    }
}
