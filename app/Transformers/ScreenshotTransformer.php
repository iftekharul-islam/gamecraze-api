<?php

namespace App\Transformers;

// We need to reference the Items Model
use App\Models\Platform;

// Dingo includes Fractal to help with transformations
use App\Models\Screenshots;
use League\Fractal\TransformerAbstract;

class ScreenshotTransformer extends TransformerAbstract
{
    protected $availableIncludes = ['game'];
    public function transform(Screenshots $screenshots)
    {
        // specify what elements are going to be visible to the API
        return [
            'id' => $screenshots->id,
            'name' => $screenshots->name,
            'url' => asset($screenshots->url)
        ];
    }

    public function includeGame(Screenshots $screenshots) {
        return $this->item($screenshots->game, new GameTransformer());
    }
}
