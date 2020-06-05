<?php

namespace App\Transformers;

// We need to reference the Items Model
use App\Game;

// Dingo includes Fractal to help with transformations
use League\Fractal\TransformerAbstract;

class GameTransformer extends TransformerAbstract
{
    public function transform(Game $game)
    {
        // specify what elements are going to be visible to the API
        return [
            'id' => $game->id,
            'name' => $game->name,
            'genres' => $game->genres,
            'assets' => $game->assets,
            'platforms' => $game->platforms,
            'release_date' => $game->released,
            'game_mode' => $game->game_mode,
            'description' => $game->description,
            'rating' => $game->rating,
            'publisher' => $game->publisher,
        ];
    }

}
