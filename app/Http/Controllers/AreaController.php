<?php

namespace App\Http\Controllers;

use App\Repositories\Admin\AreaRepository;
use Illuminate\Http\Request;

class AreaController extends Controller
{
    private $areaRepository;

    /**
     * AreaController constructor.
     * @param AreaRepository $areaRepository
     */
    public function __construct(AreaRepository $areaRepository)
    {
        $this->areaRepository = $areaRepository;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $areas = $this->areaRepository->all();
        return view('admin.area.index', compact('areas'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $thanas = $this->areaRepository->allthana();
        return view('admin.area.create', compact('thanas'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $this->areaRepository->store($request);
        return redirect()->route('area.all')->with("status", 'Area successfully created');
    }

    /**
     * @param $id
     */
    public function show($id)
    {
        //
    }

    /**]
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $area = $this->areaRepository->edit($id);
        $thanas = $this->areaRepository->allThana();
        return view('admin.area.edit', compact('thanas', 'area'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request)
    {
        $this->areaRepository->update($request);
        return redirect()->route('area.all')->with('status', 'Thana successfully updated!');
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $this->areaRepository->delete($id);
        return back()->with('status', 'area deleted successfully');
    }
}
