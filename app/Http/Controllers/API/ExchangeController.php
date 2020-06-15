<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\BaseController;
use App\Repositories\ExchangeRepository;
use App\Transformers\ExchangeTransformer;
use Illuminate\Http\Request;

class ExchangeController extends BaseController
{
    private $exchangeRepository;
    public function __construct(ExchangeRepository $exchangeRepository)
    {
        $this->exchangeRepository = $exchangeRepository;
    }
    public function index() {
        $exchanges = $this->exchangeRepository->all();
        return $this->response->collection($exchanges, new ExchangeTransformer());
    }
}
