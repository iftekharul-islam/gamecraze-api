<?php


namespace App\Transformers;


use App\Models\Area;
use App\Models\FeaturedVideo;
use League\Fractal\TransformerAbstract;

class VideoTransformer extends TransformerAbstract
{

    public function transform(FeaturedVideo $video)
    {
        return [
            'title' => $video->title,
            'url' => $video->video_url
        ];
    }
}
