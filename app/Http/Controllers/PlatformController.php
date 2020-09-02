<?php

namespace App\Http\Controllers;

use App\Http\Requests\PlatformCreateRequest;
use App\Models\Platform;
use App\Repositories\Admin\PlatformRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class PlatformController extends Controller
{
    /**
     * @var PlatformRepository
     */
    private $platformRepository;

    /**
     * PlatformController constructor.
     * @param PlatformRepository $platformRepository
     */
    public function __construct(PlatformRepository $platformRepository)
    {
        $this->platformRepository = $platformRepository;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {

        $platforms = $this->platformRepository->all();
        return view('admin.platform.index', compact('platforms'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('admin.platform.create');
    }

    /**
     * @param PlatformCreateRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(PlatformCreateRequest $request)
    {
        $this->platformRepository->store($request);
        return redirect()->route('all-platform')->with("status", 'Platform successfully created');
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
        $platform = $this->platformRepository->edit($id);
        return view('admin.platform.edit', compact('platform'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request)
    {
        $this->platformRepository->update($request);
        return redirect()->route('all-platform')->with('status', 'Platform successfully updated!');
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $this->platformRepository->delete($id);
        return back()->with('status', 'Platform deleted successfully');
    }
}
