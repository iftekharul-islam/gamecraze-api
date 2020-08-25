<?php

namespace App\Http\Controllers;

use App\Division;
use App\Repositories\Admin\DivisionRepository;
use Illuminate\Http\Request;

class DivisionController extends Controller
{
    private $divisionRepository;

    /**
     * PlatformController constructor.
     * @param PlatformRepository $platformRepository
     */
    public function __construct(DivisionRepository $divisionRepository)
    {
        $this->divisionRepository = $divisionRepository;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $divisions = $this->divisionRepository->all();
        return view('admin.division.index', compact('divisions'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('admin.division.create');
    }

    /**
     * @param PlatformCreateRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $this->divisionRepository->store($request);
        return redirect()->route('division.all')->with("status", 'Division successfully created');
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
        $division = $this->divisionRepository->edit($id);
        return view('admin.division.edit', compact('division'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request)
    {
        $this->divisionRepository->update($request);
        return redirect()->route('division.all')->with('status', 'Platform successfully updated!');
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $this->divisionRepository->delete($id);
        return back()->with('status', 'Platform deleted successfully');
    }
}
