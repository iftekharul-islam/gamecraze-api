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
            'genre' => $game->genre,
            'categories' => $game->category,
            'release_date' => $game->release_date,
            'team_type' => $game->team_type,
            'description' => $game->description,
            'rating' => $game->rating,
            'publisher' => $game->publisher,
            'series' => $game->series,
            'platform' => $game->platform
        ];
    }
}
