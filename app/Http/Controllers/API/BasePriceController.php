<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Game;
use App\Repositories\Admin\BasePriceRepository;
use App\Transformers\BasePriceTransformer;
use Illuminate\Http\Request;

class BasePriceController extends Controller
{
    /**
     * @var
     */
    private $basePriceRepository;

    /**
     * BasePriceController constructor.
     * @param BasePriceRepository $basePriceRepository
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
        $priceData = $this->basePriceRepository->all();
        return $this->response->collection($priceData, new BasePriceTransformer());
    }

    public function calculate($id) {
        $gamePrice = Game::with('basePrice')->findOrFail($id);
        $basePrice = $gamePrice->basePrice->base;
        $prices = [
            1 => $basePrice,
            2 => $basePrice * .75,
            3 => $basePrice * .65,
        ];
        return response($prices);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $basePrice = $this->basePriceRepository->show($id);
        return $this->response->item($basePrice, new BasePriceTransformer());
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
