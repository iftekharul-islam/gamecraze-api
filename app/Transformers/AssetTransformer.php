<?php

namespace App\Transformers;

// We need to reference the Items Model
use App\Models\Asset;

// Dingo includes Fractal to help with transformations
use Illuminate\Support\Facades\Storage;
use League\Fractal\TransformerAbstract;

class AssetTransformer extends TransformerAbstract
{
    public function transform(Asset $asset)
    {
        // specify what elements are going to be visible to the API
        return [
            'id' => $asset->id,
            'name' => $asset->name,
            'url' => asset('/storage/game-image/' . $asset->name),
        ];
    }
}
