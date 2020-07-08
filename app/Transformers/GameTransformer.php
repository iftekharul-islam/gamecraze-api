<?php

namespace App\Transformers;

// We need to reference the Items Model
use App\Models\Game;

// Dingo includes Fractal to help with transformations
use League\Fractal\TransformerAbstract;

class GameTransformer extends TransformerAbstract
{
    protected $availableIncludes = [
        'genres', 'assets', 'platforms', 'rents'
    ];
    public function transform(Game $game)
    {
        // specify what elements are going to be visible to the API
        return [
            'id' => $game->id,
            'name' => $game->name,
            'release_date' => $game->released,
            'game_mode' => $game->game_mode,
            'description' => $game->description,
            'rating' => $game->rating,
            'publisher' => $game->publisher,
        ];
    }

    public function includeGenres(Game $game) {
        return $this->collection($game->genres, new GenreTransformer());
    }

    public function includeAssets(Game $game) {
        return $this->collection($game->assets, new AssetTransformer());
    }

    public function includePlatforms(Game $game) {
        return $this->collection($game->platforms, new PlatformTransformer());
    }
    public function includeRents(Game $game) {
        return $this->collection($game->rents, new RentTransformer());
    }

}
