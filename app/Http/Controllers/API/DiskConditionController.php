<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\DiskConditionCreateRequest;
use App\Http\Requests\DiskConditionUpdateRequest;
use App\Models\DiskCondition;
use App\Repositories\DiskConditionRepository;
use App\Http\Controllers\BaseController;
use App\Transformers\DiskConditionTransformer;

class DiskConditionController extends BaseController
{
    /**
     * @var DiskConditionRepository
     */
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
        $diskData = $this->diskconditonRepository->all();
        return $this->response->collection($diskData, new DiskConditionTransformer());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(DiskConditionCreateRequest $request)
    {
        $diskData = $this->diskconditonRepository->store($request);
        return $this->response->item($diskData, new DiskConditionTransformer());
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\DiskCondition  $diskCondition
     * @return \Illuminate\Http\Response
     */
    public function show(DiskCondition $diskCondition, $id)
    {
        $diskData = $this->diskconditonRepository->show($id);
        return $this->response->item($diskData, new DiskConditionTransformer());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\DiskCondition  $diskCondition
     * @return \Illuminate\Http\Response
     */
    public function update(DiskConditionUpdateRequest $request, DiskCondition $diskCondition)
    {
        $disk_condition = DiskCondition::find($request->id);
        if ($disk_condition){
            $diskData = $this->diskconditonRepository->update($disk_condition, $request);
            return $this->response->item($diskData, new DiskConditionTransformer());
        }
        return response()->json('ID not found');
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
