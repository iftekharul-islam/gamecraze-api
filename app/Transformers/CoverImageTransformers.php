<?php


namespace App\Transformers;


use App\Models\Area;
use App\Models\CoverImage;
use League\Fractal\TransformerAbstract;

class CoverImageTransformers extends TransformerAbstract
{
    public function transform(CoverImage $data)
    {
        // specify what elements are going to be visible to the API
        return [
            'id' => $data->id,
            'title' => $data->title,
            'url' => $data->url ? asset($data->url) : null,
        ];
    }
}
