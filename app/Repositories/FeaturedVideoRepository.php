<?php

namespace App\Repositories;

use App\Models\Asset;
use App\Models\FeaturedVideo;

class FeaturedVideoRepository {

    public function all($numberOfVideo) {
        return FeaturedVideo::latest()->paginate($numberOfVideo);
    }

    public function create($title, $url, $featured) {
        $video = new FeaturedVideo();
        $video->title = $title;
        $video->video_url = $url;
        $video->is_featured = $featured;
        $video->save();
        if ( $video ) { 
            return true;
        }
        return false;
    }

    public function update($id, $title, $url, $featured) {
        $video = FeaturedVideo::findOrFail($id);
        $video->title = $title;
        $video->video_url = $url;
        $video->is_featured = $featured;
        $video->save();
        if ( $video ) { 
            return true;
        }
        return false;
    }

    public function show($id) {
        return FeaturedVideo::findOrFail($id);
    }

    public function delete($id) {
        return FeaturedVideo::findOrFail($id)->delete();
    }

    public function featuredVideos($numberOfVideo) {
        return FeaturedVideo::where('is_featured', 1)
            ->orderBy('created_at', 'DESC')
            ->take($numberOfVideo)
            ->get();
    }
}
