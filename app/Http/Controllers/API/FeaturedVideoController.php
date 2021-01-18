<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Repositories\FeaturedVideoRepository;
use App\Transformers\FeaturedVideoTransformer;
use Illuminate\Http\Request;

class FeaturedVideoController extends Controller
{
    public $featuredVideoRepo;
    
    public function __construct(FeaturedVideoRepository $featuredVideoRepo)
    {
        $this->featuredVideoRepo = $featuredVideoRepo;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $numberOfVideo = $request->number ?? 5;
        $videos = $this->featuredVideoRepo->featuredVideos($numberOfVideo);
        return $this->response->collection($videos, new FeaturedVideoTransformer());
    }
}
