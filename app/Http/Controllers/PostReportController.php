<?php

namespace App\Http\Controllers;

use App\Models\PostReport;

class PostReportController extends Controller
{
    public function index()
    {
        $data = PostReport::orderBy('created_at', 'desc')->get();

        return view('admin.post_report.index', compact('data'));
    }

    public function show($id)
    {
        $data = PostReport::findOrFail($id);

        return view('admin.post_report.show', compact('data'));
    }

    public function approve($id)
    {
        $data = PostReport::findOrFail($id);
        $data->status = true;
        $data->save();

        return back()->with('status', 'Extend Request Approved successfully !!');
    }

    public function reject($id)
    {
        $data = PostReport::findOrFail($id);
        $data->status = false;
        $data->save();

        return back()->with('status', 'Extend Request Rejected !!');
    }
}
