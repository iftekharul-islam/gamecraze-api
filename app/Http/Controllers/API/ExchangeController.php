<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\BaseController;
use App\Repositories\ExchangeRepository;
use App\Transformers\ExchangeTransformer;

class ExchangeController extends BaseController
{
    private $exchangeRepository;
    public function __construct(ExchangeRepository $exchangeRepository)
    {
        $this->exchangeRepository = $exchangeRepository;
    }
    public function getActiveExchange() {
        $exchanges = $this->exchangeRepository->getActiveExchange();
        return $this->response->collection($exchanges, new ExchangeTransformer());
    }
}
