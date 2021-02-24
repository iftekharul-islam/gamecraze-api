<?php

namespace App\Http\Controllers;

use App\Models\Meta;
use App\Models\Notice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MetaController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $data = Meta::all();

        return view('admin.meta.index',compact('data'));
    }


    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $data = $request->only(['name', 'content', 'author_id']);

        $data['author_id'] = Auth::user()->id;

        Meta::create($data);

        return redirect()->back()->with('status', 'Meta successfully created');
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $data = Meta::findOrFail($id);

        return view('admin.meta.edit', compact('data'));
    }

    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request,$id)
    {
        $meta = Meta::findOrFail($id);

        if (!$meta){
            return redirect()->back()->with('error', 'Meta cannot updated');
        }

        $data = $request->only(['name', 'content']);

        if (isset($data['name'])) {
            $meta->name = $data['name'];
        };
        if (isset($data['content'])) {
            $meta->content = $data['content'];
        };

        $meta->save();

        return redirect()->route('meta')->with('status', 'Meta successfully updated');
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $meta = Meta::findOrFail($id);

        $meta->delete();

        return redirect()->back()->with('status', 'Meta successfully Deleted');
    }
}
