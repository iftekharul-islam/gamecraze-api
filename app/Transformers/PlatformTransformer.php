<?php

namespace App\Transformers;

// We need to reference the Items Model
use App\Models\Platform;

// Dingo includes Fractal to help with transformations
use League\Fractal\TransformerAbstract;

class PlatformTransformer extends TransformerAbstract
{
    protected $availableIncludes = ['games'];
    public function transform(Platform $platform)
    {
        // specify what elements are going to be visible to the API
        return [
            'id' => $platform->id,
            'name' => $platform->name,
            'slug' => $platform->slug,
        ];
    }

    public function includeGames(Platform $platform) {
        return $this->collection($platform->games, new GameTransformer());
    }
}
