<?php

namespace App\Http\Controllers;

use App\Http\Requests\DiskConditionCreateRequest;
use Illuminate\Http\Request;
use App\Repositories\Admin\DiskCondtionRepository;

class DiskConditionController extends Controller
{
    /**
     * @var DiskCondtionRepository
     */
    private $diskConditionRepository;

    /**
     * DiskConditionController constructor.
     * @param DiskCondtionRepository $diskConditionRepository
     */
    public function __construct(DiskCondtionRepository $diskConditionRepository)
    {
        $this->diskConditionRepository = $diskConditionRepository;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $diskConditions = $this->diskConditionRepository->all();
        return view('admin.disk-condition.index', compact('diskConditions'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('admin.disk-condition.create');
    }

    /**
     * @param DiskConditionCreateRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(DiskConditionCreateRequest $request)
    {
        $this->diskConditionRepository->store($request);
        return redirect()->route('diskCondition.all')->with("status", 'Disk condition successfully created!');
    }

    /**
     * @param $id
     */
    public function show($id)
    {
        //
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $diskCondition = $this->diskConditionRepository->edit($id);
        return view('admin.disk-condition.edit', compact('diskCondition'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request)
    {
        $this->diskConditionRepository->update($request);
        return redirect()->route('diskCondition.all')->with('status', 'Disk condition successfully updated!');
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $this->diskConditionRepository->delete($id);
        return back()->with('status', 'Disk Condition deleted successfully');
    }
}
