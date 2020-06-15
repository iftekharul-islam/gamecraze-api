<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\BaseController;
use App\Transformers\RentTransformer;
use App\Repositories\RentRepository;
use Illuminate\Http\Request;

class RentController extends BaseController
{
    private $rentRepository;
    public function __construct(RentRepository $rentRepository)
    {
        $this->rentRepository = $rentRepository;
    }

    public function index() {
        $rents = $this->rentRepository->all();
        return $this->response->collection($rents, new RentTransformer());
    }
}
