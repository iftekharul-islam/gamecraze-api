<?php

namespace App\Http\Controllers;

use App\Models\CoverImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CoverImageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = CoverImage::all();
        return view('admin.cover_image.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.cover_image.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->only(['title', 'url', 'author_id']);
        $data['author_id'] = Auth::user()->id;

        if ($request->hasFile('url')) {
            $image = $request->file('url');
            $image_name = 'cover-image-' . auth()->user()->id . '-' . time() . '.' . $image->getClientOriginalExtension();
            $path = "cover-image/" . $image_name;
            $image->storeAs('cover-image', $image_name);
            $data['url'] = 'storage/' . $path;
        }

        $data_store = CoverImage::create($data);
        if ($data_store) {
            return redirect()->route('cover.all')->with('status', 'Cover image successfully stored');
        }

        return redirect()->route('cover.all')->with('error', 'Cover image failed to store');
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $data = CoverImage::findOrFail($id)->delete();
        if ($data) {
            return redirect()->back()->with('status', 'Cover image successfully deleted');
        }

        return redirect()->back()->with('error', 'Cover image failed to delete');
    }
}
