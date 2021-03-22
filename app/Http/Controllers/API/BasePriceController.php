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
        $basePrice = $gamePrice->basePrice;
        $prices = [
            1 => $basePrice->base,
            2 => $basePrice->base * $basePrice->second_week,
            3 => $basePrice->base * $basePrice->third_week,
        ];
        return response($prices);
    }

    /***
     * @param $gameId
     * @param $lendWeek
     * @param $diskType
     * @return array|\Illuminate\Http\JsonResponse|void
     */
    public function gameCalculate ($gameId, $lendWeek, $diskType) {
        $price = $this->basePriceRepository->gamePriceCalculation($gameId, $lendWeek, $diskType);

        return response()->json(compact('price'), 200);
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
}
