<?php

namespace App\Http\Controllers;

use App\Http\Requests\BasePriceCreateRequest;
use App\Http\Requests\BasePriceUpdateRequest;
use App\Models\BasePrice;
use App\Repositories\Admin\BasePriceRepository;

class BasePriceController extends Controller
{
    /**
     * @var basePriceRepository
     */
    private $basePriceRepository;
    /**
     * BasePriceController constructor.
     * @param basePriceRepository $basePriceRepository
     */
    public function __construct(BasePriceRepository $basePriceRepository)
    {
        $this->basePriceRepository = $basePriceRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $bases = $this->basePriceRepository->all();
        return view('admin.base-price.index', compact('bases'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.base-price.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BasePriceCreateRequest $request)
    {
        $start = $request->start;
        $end = $request->end;
        $error = [
            'start' => 'Given input is conflicting  with other price ranges'
        ];
        if ($this->validateStartPrice($start, $end))
        {
            return back()->withInput()->withErrors($error);
        }
        $this->basePriceRepository->store($request);
        return redirect()->route('basePrice.all')->with("status", 'Base price successfully created');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\BasePrice  $basePrice
     * @return \Illuminate\Http\Response
     */
    public function show(BasePrice $basePrice)
    {
        //
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $price = $this->basePriceRepository->edit($id);
        return view('admin.base-price.edit', compact('price'));
    }

    /**
     * @param BasePriceUpdateRequest $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(BasePriceUpdateRequest $request, $id)
    {
        return $request->all();
        $start = $request->start;
        $end = $request->end;
        $error = [
            'start' => 'Given input is conflicting  with price ranges'
        ];

        $price = $this->basePriceRepository->edit($id);

        if ($this->validateStartPrice($start, $end, $price->id) != 0)
        {
            return back()->withErrors($error);
        }
        $this->basePriceRepository->update($request);
        return redirect()->route('basePrice.all')->with('status', 'Base price successfully updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\BasePrice  $basePrice
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->basePriceRepository->delete($id);
        return back()->with('status', 'Base price deleted successfully');
    }

    /**
     * @param null $start
     * @param null $end
     * @param null $baseId
     * @return mixed
     */
    protected function validateStartPrice($start = null, $end = null, $baseId = null)
    {
        if ($baseId != null) {
            $basePrice = $this->basePriceRepository->validateStartPriceUpdate($start, $end, $baseId);
            return $basePrice;
        }
        $basePrice = $this->basePriceRepository->validateStartPriceCreate($start, $end);
        return $basePrice;
    }
}
