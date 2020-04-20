<?php

namespace App\Transformers;

// We need to reference the Items Model
use App\Game;

// Dingo includes Fractal to help with transformations
use League\Fractal\TransformerAbstract;

class GameTransformer extends TransformerAbstract
{
    protected $availableIncludes=['user'];

    public function transform(Game $game)
    {
        // specify what elements are going to be visible to the API
        return [
            'id' => $game->id,
            'name' => $game->name,
            'genre' => $game->genre,
            'game_type' => $game->game_type,
            'release_date' => $game->release_date,
            'no_of_players' => $game->no_of_players,
            'owner_id' => $game->user_id,
            'approve_status' => $game->approve_status,
        ];
    }

    public function includeUser(Game $game) {
        return $this->item($game->user, new UserTransformer());
    }
}
