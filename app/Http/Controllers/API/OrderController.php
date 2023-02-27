<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Repositories\GameOrderRepository;
use App\Transformers\GameOrderTransformers;

class OrderController extends Controller
{
    private $gameOrderRepository;

    public function __construct(GameOrderRepository $gameOrderRepository)
    {
        $this->gameOrderRepository = $gameOrderRepository;
    }

    public function index()
    {
        $data = $this->gameOrderRepository->index();

        return $this->response->collection($data, new GameOrderTransformers());
    }

    public function showById($id)
    {
        $data = $this->gameOrderRepository->getById($id);

        return $this->response->item($data, new GameOrderTransformers());
    }
}
