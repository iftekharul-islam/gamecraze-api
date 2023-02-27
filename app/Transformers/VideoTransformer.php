<?php


namespace App\Transformers;

use App\Models\FeaturedVideo;
use App\Models\VideoUrl;
use League\Fractal\TransformerAbstract;

class VideoTransformer extends TransformerAbstract
{

    public function transform(VideoUrl $video)
    {
        return [
            'title' => $video->name,
            'url' => $video->url
        ];
    }
}
