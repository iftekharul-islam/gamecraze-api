<?php

namespace App\Http\Controllers\API;

use App\Models\DiskCondition;
use App\Repositories\DiskConditionRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\BaseController;

class DiskConditionController extends BaseController
{
    private $diskconditonRepository;

    public function __construct(DiskConditionRepository $diskconditonRepository)
    {
        $this->diskconditonRepository = $diskconditonRepository;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $disk_condition = $this->diskconditonRepository->all();
        return response()->json(compact('disk_condition'), 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $disk_condition = $this->diskconditonRepository->store($request);
        return response()->json(compact('disk_condition'), 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\DiskCondition  $diskCondition
     * @return \Illuminate\Http\Response
     */
    public function show(DiskCondition $diskCondition, $id)
    {
        $disk_condition = $this->diskconditonRepository->show($id);
        return response()->json(compact('disk_condition'), 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\DiskCondition  $diskCondition
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, DiskCondition $diskCondition, $id)
    {
        $disk_condition = $this->diskconditonRepository->update($request);
        return response()->json(compact('disk_condition'), 200);
    }

    /**
     * Remove the specified resource from storage.$
     *
     * @param  \App\DiskCondition  $diskCondition
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->diskconditonRepository->delete($id);
        return response()->json('Successfully deleted');
    }
}
