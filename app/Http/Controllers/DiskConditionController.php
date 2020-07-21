<?php

namespace App\Http\Controllers;

use App\Http\Requests\DiskConditionCreateRequest;
use App\Models\DiskCondition;
use App\Models\Platform;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class DiskConditionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $diskConditions = DiskCondition::all();
        return view('admin.disk-condition.index', compact('diskConditions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.disk-condition.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(DiskConditionCreateRequest $request)
    {
        $diskCondition = $request->only(['name', 'description', 'status']);
        $diskCondition['author_id'] = auth()->user()->id;
        DiskCondition::create($diskCondition);

        return redirect()->route('diskCondition.all')->with("status", 'Disk condition successfully created!');
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
        $diskCondition = DiskCondition::findOrFail($id);
        return view('admin.disk-condition.edit', compact('diskCondition'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $diskCondition = DiskCondition::find($request->id);
        if (!$diskCondition) {
            return false;
        }
        $data = $request->only(['name', 'description', 'status']);

        if (isset($data['name'])) {
            $diskCondition->name = $data['name'];
        }
        if (isset($data['description'])) {
            $diskCondition->description = $data['description'];
        }
        if (isset($data['status'])) {
            $diskCondition->status = $data['status'];
        }
        $diskCondition->save();
        return redirect()->route('diskCondition.all')->with('status', 'Disk condition successfully updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $diskCondition = DiskCondition::find($id);

        if ($diskCondition) {
            $diskCondition->delete();
            return back()->with('status', 'Disk Condition deleted successfully');
        }

        return false;
    }
}
