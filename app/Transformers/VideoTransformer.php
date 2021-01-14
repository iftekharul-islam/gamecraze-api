<?php


namespace App\Transformers;


use App\Models\Area;
use App\Models\FeaturedVideo;
use League\Fractal\TransformerAbstract;

class VideoTransformer extends TransformerAbstract
{

    public function transform(FeaturedVideo $video)
    {
        // specify what elements are going to be visible to the API
        return [
            'title' => $video->title,
            'url' => $video->video_url
        ];
    }
}
