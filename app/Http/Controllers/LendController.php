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
    public function index(Request $request)
    {
        $lends = $this->lendRepository->history($request);
        return view('admin.lend-history.index', compact('lends'));
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
        $basePrice = $lend->rent->game->basePrice;
        $second_week = $basePrice->second_week;
        $third_week = $basePrice->third_week;
        $sum = 0;
        $mapping = [
            1 => 1,
            2 => $second_week,
            3 => $third_week,
        ];
        for ($i = 1; $i <= $lend->lend_week; $i++) {
            $sum += isset($mapping[$i]) ? $basePrice->base * $mapping[$i] : $basePrice->base * last($mapping);
        }
        $lendDate = $lend->lend_date;
        $lendWeek = $lend->lend_week;
        $startDate = date("d F, Y", strtotime ($lendDate ."+1 day"));
        $endDate = date("d F, Y", strtotime ($startDate ."+" .+ $lendWeek . "week"));

        return view('admin.lend-history.show', compact('lend', 'endDate', 'startDate', 'sum'));
    }

    /**
     * @param Request $request
     * @param $lend_id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateStatus(Request $request, $lend_id) {
       
        $status = $this->lendRepository->updateStatus($lend_id, $request->status);
        if ($status) {
            return back()->with('status', 'Disk delivery updated');
        }
        return back()->with('error', 'Could not update status');
    }
}
