<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateCommissionRequest;
use App\Models\Commission;
use App\Repositories\Admin\CommissionRepository;
use Illuminate\Http\Request;

class CommissionController extends Controller
{

    private $commissionRepository;

    public function __construct(CommissionRepository $commissionRepository)
    {
        $this->commissionRepository = $commissionRepository;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = $this->commissionRepository->index();

        return view('admin.commission.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.commission.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateCommissionRequest $request)
    {
        $data = $this->commissionRepository->store($request);

        return redirect()->route('commission')->with("status", 'Base price successfully created');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Commission  $commission
     * @return \Illuminate\Http\Response
     */
    public function show(Commission $commission)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Commission  $commission
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = $this->commissionRepository->edit($id);

        return view('admin.commission.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Commission  $commission
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Commission $commission)
    {
        $data = $this->commissionRepository->update($request);

        if ($data == false){
            return redirect()->route('basePrice.all')->with('error', 'Base price not updated');
        }

        return redirect()->route('commission')->with('status', 'Base price successfully updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Commission  $commission
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = $this->commissionRepository->delete($id);
        if ($data == false){
            return redirect()->route('commission')->with('error', 'Base price failed to delete');
        }

        return back()->with('status', 'Base price deleted successfully');
    }
}
