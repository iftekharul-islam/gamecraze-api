<?php

namespace App\Http\Controllers;

use App\Models\BasePrice;
use App\Models\Platform;
use App\Models\Rent;
use Illuminate\Http\Request;
use App\Repositories\Admin\RentRepository;

class RentController extends Controller
{
    /**
     * @var RentRepository
     */
    private $rentRepository;
    /**
     * RentController constructor.
     * @param RentRepository $rentRepository
     */
    public function __construct(RentRepository $rentRepository)
    {
        $this->rentRepository = $rentRepository;
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        $rents = $this->rentRepository->all($request);

        return view('admin.rent-post.index', compact('rents'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        $rent = $this->rentRepository->details($id);
        return view('admin.rent-post.show', compact('rent'));
    }

    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function approve(Request $request, $id)
    {
        $this->rentRepository->approve($id);

        return back()->with('status', 'Rent post Approved successfully!!');
    }

    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function reject(Request $request, $id)
    {
        $this->rentRepository->reject($request, $id);
        return back()->with('status', 'Rent post Rejected!!');
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = $this->rentRepository->details($id);
        $platforms = Platform::all();
        return view('admin.rent-post.edit', compact('data', 'platforms'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $post = Rent::find($id);
        $data = $request->only('max_week', 'cover_image', 'disk_image');
        if (isset($data['max_week'])) {
            $post->max_week = $data['max_week'];
        }
        if ($request->file('cover_image')) {
            $image = $request->file('cover_image');
            $image_name = 'cover_' . time() . '_' .$post['game_id'] . '.' . $image->getClientOriginalExtension();
            $image->storeAs('rent-image', $image_name);
            $data['cover_image'] = $image_name;
            $post['cover_image'] = $data['cover_image'];
        }
        if ($request->file('disk_image')) {
            $image = $request->file('disk_image');
            $image_name = 'disk_' . time() . '_' .$post['game_id'] . '.' . $image->getClientOriginalExtension();
            $image->storeAs('rent-image', $image_name);
            $data['disk_image'] = $image_name;
            $post['disk_image'] = $data['disk_image'];
        }
        $post->save();

        return redirect()->route('rentPost.all')->with('status', 'Lend post updated successfully');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->rentRepository->delete($id);
        return back()->with('status', 'Disk Condition deleted successfully');

    }
}
