<?php


namespace App\Transformers;

use App\Models\FeaturedVideo;
use App\Models\VideoUrl;
use League\Fractal\TransformerAbstract;

class FeaturedVideoTransformer extends TransformerAbstract
{

    public function transform(FeaturedVideo $video)
    {
        return [
            'title' => $video->title,
            'url' => $video->video_url
        ];
    }
}
