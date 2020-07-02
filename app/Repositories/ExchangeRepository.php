<?php

namespace App\Repositories;

use App\Models\Exchange;
use Illuminate\Http\Request;

class ExchangeRepository {
    public function getActiveExchange() {
        return Exchange::where('status', 0)->get();
    }
}
