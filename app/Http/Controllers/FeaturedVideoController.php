<?php

namespace App\Http\Controllers;

use App\Http\Requests\VideoCreateRequest;
use App\Http\Requests\VideoUpdateRequest;
use App\Models\FeaturedVideo;
use App\Repositories\FeaturedVideoRepository;
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
    public function index()
    {
        $videos = $this->featuredVideoRepo->all(20);
        return view('admin.featured-video.index', compact('videos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.featured-video.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(VideoCreateRequest $request)
    {
        $video = $this->featuredVideoRepo->create($request->title, $request->video_url, $request->is_featured);
        $status = 'status';
        $message = 'Video added successfully';
        if ( !$video ) {
            $status = 'error';
            $message  = 'Could not add video..';
        }
        return redirect()->route('video.all')->with($status, $message);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\FeaturedVideo  $featuredVideo
     * @return \Illuminate\Http\Response
     */
    public function show(FeaturedVideo $featuredVideo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\FeaturedVideo  $featuredVideo
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $video = $this->featuredVideoRepo->show($id);
        return view('admin.featured-video.edit', compact('video'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\FeaturedVideo  $featuredVideo
     * @return \Illuminate\Http\Response
     */
    public function update(VideoUpdateRequest $request, $id)
    {
        $video = $this->featuredVideoRepo->update($id, $request->title, $request->video_url, $request->is_featured);
        $status = 'status';
        $message = 'Video updated successfully';
        if ( !$video ) {
            $status = 'error';
            $message  = 'Could not update video..';
        }
        return redirect()->route('video.all')->with($status, $message);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\FeaturedVideo  $featuredVideo
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $video = $this->featuredVideoRepo->delete($id);
        $status = 'status';
        $message = 'Video deleted successfully';
        if ( !$video ) {
            $status = 'error';
            $message  = 'Could not delete video..';
        }
        return redirect()->route('video.all')->with($status, $message);
    }
}
