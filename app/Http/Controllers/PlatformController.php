<?php

namespace App\Http\Controllers;

use App\Http\Requests\PlatformCreateRequest;
use App\Models\Platform;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class PlatformController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $platforms = Platform::all();
        return view('admin.platform.index', compact('platforms'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.platform.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PlatformCreateRequest $request)
    {
        $platform = $request->only(['name']);
        $platform['author_id'] = auth()->user()->id;
        $platform['slug'] = Str::slug($platform['name']);
        Platform::create($platform);

        return redirect()->route('all-platform')->with("status", 'Platform successfully created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $platform = Platform::findOrFail($id);
        return view('admin.platform.edit', compact('platform'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $platform = Platform::find($request->id);
        if (!$platform) {
            return false;
        }
        $data = $request->only(['name']);

        if (isset($data['name'])) {
            $platform->name = $data['name'];
            $platform->slug = Str::slug($data['name']);
        }
        $platform->save();
        return redirect()->route('all-platform')->with('status', 'Platform successfully updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $platform = Platform::find($id);
        $platform->delete();
        return back()->with('status', 'Platform deleted successfully');
    }
}
