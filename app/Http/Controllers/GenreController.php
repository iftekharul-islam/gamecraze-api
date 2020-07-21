<?php

namespace App\Http\Controllers;

use App\Http\Requests\GenreCreateRequest;
use App\Models\Genre;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class GenreController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $genres = Genre::all();
        return view('admin.genre.index', compact('genres'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.genre.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(GenreCreateRequest $request)
    {
        $data = $request->only([
            'name'
        ]);
        $data['author_id'] = auth()->user()->id;
        $data['slug'] = Str::slug($request->name);

        Genre::create($data);

        return redirect()->route('all-genre')->with('status', 'Genre successfully Created');
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
        $genre = Genre::findOrFail($id);
        return view('admin.genre.edit', compact('genre'));
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
        $genre = Genre::find($request->id);
        if (!$genre) {
            return false;
        }
        $data = $request->only(['name']);

        if (isset($data['name'])) {
            $genre->name = $data['name'];
            $genre->slug = Str::slug($data['name']);
        }
        $genre->save();
        return redirect()->route('all-genre')->with('status', 'Genre successfully updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $genre = Genre::find($id);
        if ($genre) {
            $genre->delete();
            return back()->with('status', 'Platform successfully Deleted!');
        }

        return false;
    }
}
