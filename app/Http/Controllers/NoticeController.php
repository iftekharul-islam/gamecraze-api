<?php

namespace App\Http\Controllers;

use App\Jobs\SentNoticeEmail;
use App\Models\Notice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NoticeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Notice::all();

        return view('admin.notice.index',compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->only(['title', 'description', 'status', 'author_id']);

        $data['author_id'] = Auth::user()->id;

        $notice = Notice::create($data);

        SentNoticeEmail::dispatch($notice);

        return redirect()->back()->with('status', 'Notice successfully created');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Notice  $notice
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Notice::findOrFail($id);

        return view('admin.notice.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Notice  $notice
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $notice = Notice::findOrFail($id);

        if (!$notice){
            return redirect()->back()->with('error', 'Notice cannot updated');
        }

        $data = $request->only(['title', 'description', 'status']);

        if (isset($data['title'])) {
            $notice->title = $data['title'];
        };
        if (isset($data['description'])) {
            $notice->description = $data['description'];
        };
        if (isset($data['status'])) {
            $notice->status = $data['status'];
        };

        $notice->save();

        return redirect()->route('notice')->with('status', 'Notice successfully updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Notice  $notice
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $notice = Notice::findOrFail($id);

        $notice->delete();

        return redirect()->back()->with('status', 'Notice successfully Deleted');

    }
}
