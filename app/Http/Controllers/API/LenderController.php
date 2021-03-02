<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\LenderRepository;

class LenderController extends Controller
{
    private $lenderRepository;
    public function __construct(LenderRepository $lenderRepository)
    {
        $this->lenderRepository = $lenderRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->lenderRepository->all();
    }

    /**
     * @return mixed
     */
    public function myLends()
    {
        $lends =  $this->lenderRepository->myLends();
        return response()->json(compact('lends'), 200);
    }

    /**x
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return $this->lenderRepository->create($request);
    }

    public function myLendCount()
    {
        return $this->lenderRepository->all();
    }
}
