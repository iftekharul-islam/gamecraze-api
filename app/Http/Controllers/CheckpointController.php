<?php

namespace App\Http\Controllers;

use App\Http\Requests\CheckpointCreateRequest;
use App\models\Checkpiont;
use App\Repositories\Admin\CheckpointRepository;
use Illuminate\Http\Request;

class CheckpointController extends Controller
{
    private $checkpointRepository;

    function __construct(CheckpointRepository $checkpointRepository)
    {
        $this->checkpointRepository = $checkpointRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $checkpoints = $this->checkpointRepository->all();
        return view('admin.checkpoint.index', compact('checkpoints'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = $this->checkpointRepository->allUser();
        $areas = $this->checkpointRepository->allArea();
        return view('admin.checkpoint.create', compact('users', 'areas'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CheckpointCreateRequest $request)
    {
        $this->checkpointRepository->store($request);
        return redirect()->route('checkpoint.all')->with("status", 'Checkpoint successfully created');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Checkpiont  $checkpiont
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $checkpiont = $this->checkpointRepository->show($id);
            return response()->json(['msg' => 'Checkpoint details', 'success' => true, 'data' => $checkpiont], 200);

        } catch (Throwable $e) {
            report($e);
            return response()->json(['msg' => 'Data Not Found', 'error' => report($e)], 404);
        }

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Checkpiont  $checkpiont
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $checkpoint = $this->checkpointRepository->edit($id);
        $users = $this->checkpointRepository->allUser();
        $areas = $this->checkpointRepository->allArea();
        return view('admin.checkpoint.edit', compact('checkpoint', 'users', 'areas'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Checkpiont  $checkpiont
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $this->checkpointRepository->update($request);
        return redirect()->route('checkpoint.all')->with('status', 'Checkpoint successfully updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Checkpiont  $checkpiont
     * @return \Illuminate\Http\Response
     */
    public function destroy(Checkpiont $checkpiont)
    {
        //
    }
}
