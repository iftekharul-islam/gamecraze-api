<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\DiskConditionCreateRequest;
use App\Http\Requests\DiskConditionUpdateRequest;
use App\Models\DiskCondition;
use App\Repositories\DiskConditionRepository;
use App\Http\Controllers\BaseController;
use App\Transformers\DiskConditionTransformer;
use Dingo\Api\Exception\DeleteResourceFailedException;
use Dingo\Api\Exception\UpdateResourceFailedException;

class DiskConditionController extends BaseController
{
    /**
     * @var DiskConditionRepository
     */
    private $diskConditionRepository;

    public function __construct(DiskConditionRepository $diskConditionRepository)
    {
        $this->diskConditionRepository = $diskConditionRepository;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $diskData = $this->diskConditionRepository->all();
        return $this->response->collection($diskData, new DiskConditionTransformer());
    }

    /**
     * @param DiskConditionCreateRequest $request
     * @return \Dingo\Api\Http\Response
     */
    public function store(DiskConditionCreateRequest $request)
    {
        $diskData = $this->diskConditionRepository->store($request);
        return $this->response->item($diskData, new DiskConditionTransformer());
    }

    /**
     * Display the specified resource.
     *
     * @param DiskCondition $diskCondition
     * @param $id
     * @return \Dingo\Api\Http\Response
     */
    public function show(DiskCondition $diskCondition, $id)
    {
        $diskData = $this->diskConditionRepository->show($id);
        return $this->response->item($diskData, new DiskConditionTransformer());
    }

    /**
     * @param DiskConditionUpdateRequest $request
     * @param DiskCondition $diskCondition
     * @return \Dingo\Api\Http\Response
     */
    public function update(DiskConditionUpdateRequest $request, DiskCondition $diskCondition)
    {
        $disk_condition = DiskCondition::find($request->id);
        if ($disk_condition){
            $diskData = $this->diskConditionRepository->update($disk_condition, $request);
            return $this->response->item($diskData, new DiskConditionTransformer());
        }

        throw new UpdateResourceFailedException();
    }

    /**
     * Remove the specified resource from storage.$
     *
     * @param $id
     * @return array
     */
    public function destroy($id)
    {
        $status = $this->diskConditionRepository->delete($id);
        if ($status == 0) {
            throw new DeleteResourceFailedException();
        }

        return $this->response->array([
            "status_code" => 200,
            "message" => "Resource has been deleted."
        ]);
    }
}
