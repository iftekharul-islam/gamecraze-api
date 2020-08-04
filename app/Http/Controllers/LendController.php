<?php

namespace App\Http\Controllers;

use App\Models\Lender;
use App\Repositories\Admin\LendRepository;
use Carbon\Carbon;
use Illuminate\Http\Request;

class LendController extends Controller
{
    private $lendRepository;

    public function __construct(LendRepository $lendRepository)
    {
        $this->lendRepository = $lendRepository;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // TODO Need to check
        $lends = $this->lendRepository->history();
//        return $lends;
        return view('admin.lend-history.index', compact('lends'));
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
    public function show($id)
    {
        $lend = $this->lendRepository->details($id);
        $data = Lender::all()->first();
        $lendDate = $data->lend_date;
        $lendWeek = $data->lend_week;
        $startDate = date("d F, Y", strtotime ($lendDate ."+1 day"));
        $endDate = date("d F, Y", strtotime ($startDate ."+" .+ $lendWeek . "week"));

        return view('admin.lend-history.show', compact('lend', 'endDate', 'startDate'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
