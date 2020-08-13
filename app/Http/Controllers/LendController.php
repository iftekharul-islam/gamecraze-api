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
        $lends = $this->lendRepository->history();
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
        $base = $lend->rent->game->basePrice->base;
        $sum = 0;
        if ( $lend->lend_week >= 1 ){
            $sum = $base;
        }
        if ( $lend->lend_week >= 2 ){
            $sum = $sum + ($base*.75);
        }
        if ( $lend->lend_week >= 3 ){
            $sum = $sum + ($base*.65);
        }
        if ( $lend->lend_week > 3 ){
            $total = $lend->lend_week - 3;
            $s = 0;
            for ($i = 1 ; $i <= $total; $i++){
                $s +=  ($base*.65);
            }
            $grandTotal = $s + $sum;
        }
        $lendDate = $lend->lend_date;
        $lendWeek = $lend->lend_week;
        $startDate = date("d F, Y", strtotime ($lendDate ."+1 day"));
        $endDate = date("d F, Y", strtotime ($startDate ."+" .+ $lendWeek . "week"));

        return view('admin.lend-history.show', compact('lend', 'endDate', 'startDate', 'grandTotal'));
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
