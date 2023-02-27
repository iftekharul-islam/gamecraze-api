<?php

namespace App\Transformers;

// We need to reference the Items Model
use App\Models\Genre;

// Dingo includes Fractal to help with transformations
use League\Fractal\TransformerAbstract;

class GenreTransformer extends TransformerAbstract
{
    protected $availableIncludes = ['games'];
    public function transform(Genre $genre)
    {
        // specify what elements are going to be visible to the API
        return [
            'id' => $genre->id,
            'name' => $genre->name,
            'slug' => $genre->slug,
        ];
    }

    public function includeGames(Genre $genre) {
        return $this->collection($genre->games, new GameTransformer());
    }

}
