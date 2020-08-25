<?php

namespace App\Http\Controllers;

use App\Repositories\Admin\ThanaRepository;
use Illuminate\Http\Request;

class ThanaController extends Controller
{
    /**
     * @var ThanaRepository
     */
    private $thanaRepository;

    /**
     * ThanaController constructor.
     * @param ThanaRepository $thanaRepository
     */
    public function __construct(ThanaRepository $thanaRepository)
    {
        $this->thanaRepository = $thanaRepository;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $thanas = $this->thanaRepository->all();
        return view('admin.thana.index', compact('thanas'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $districts = $this->thanaRepository->allDistrict();
        return view('admin.thana.create', compact('districts'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $this->thanaRepository->store($request);
        return redirect()->route('thana.all')->with("status", 'Thana successfully created');
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
        $thana = $this->thanaRepository->edit($id);
        $districts = $this->thanaRepository->allDistrict();
        return view('admin.thana.edit', compact('districts', 'thana'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request)
    {
        $this->thanaRepository->update($request);
        return redirect()->route('thana.all')->with('status', 'Thana successfully updated!');
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $this->thanaRepository->delete($id);
        return back()->with('status', 'Thana deleted successfully');
    }
}
