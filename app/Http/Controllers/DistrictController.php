<?php

namespace App\Http\Controllers;

use App\District;
use App\Repositories\Admin\DistrictRepository;
use Illuminate\Http\Request;

class DistrictController extends Controller
{
    private $districtRepository;

    /**
     * PlatformController constructor.
     * @param PlatformRepository $platformRepository
     */
    public function __construct(DistrictRepository $districtRepository)
    {
        $this->districtRepository = $districtRepository;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $districts = $this->districtRepository->all();
        return view('admin.district.index', compact('districts'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $divisions = $this->districtRepository->allDivision();
        return view('admin.district.create', compact('divisions'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $this->districtRepository->store($request);
        return redirect()->route('district.all')->with("status", 'District successfully created');
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
        $district = $this->districtRepository->edit($id);
        $divisions = $this->districtRepository->allDivision();
        return view('admin.district.edit', compact('district', 'divisions'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request)
    {
        $this->districtRepository->update($request);
        return redirect()->route('district.all')->with('status', 'District successfully updated!');
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $this->districtRepository->delete($id);
        return back()->with('status', 'District deleted successfully');
    }
}
