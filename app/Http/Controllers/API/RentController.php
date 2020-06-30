<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\BaseController;
use App\Models\Rent;
use App\Transformers\RentTransformer;
use App\Repositories\RentRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class RentController extends BaseController
{
    private $rentRepository;
    public function __construct(RentRepository $rentRepository)
    {
        $this->rentRepository = $rentRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $rents = $this->rentRepository->all();
        return $this->response->collection($rents, new RentTransformer());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $cover_image = $request->hasFile('cover_image') ? Storage::disk('public')->put('cover-' . \Auth::user()->school_id . '/' . date('Y'), $request->file('cover_image')) : null;
        $disk_image = $request->hasFile('disk_image') ? Storage::disk('public')->put('disk-' . \Auth::user()->school_id . '/' . date('Y'), $request->file('disk_image')) : null;
        $rent = $this->rentRepository->store($request,$cover_image,$disk_image);
        return response()->json(compact('rent'), 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\DiskCondition  $diskCondition
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $rent = Rent::findOrFail($id);
        return response()->json(compact('rent'), 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\DiskCondition  $diskCondition
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $rent = $this->rentRepository->update($request);
        return response()->json(compact('rent'), 200);
    }

    /**
     * Remove the specified resource from storage.$
     *
     * @param  \App\DiskCondition  $diskCondition
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->rentRepository->delete($id);
        return response()->json('Successfully deleted');
    }
}
