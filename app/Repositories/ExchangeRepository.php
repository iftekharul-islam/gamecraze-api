<?php

namespace App\Repositories;

use App\Models\Exchange;
use Illuminate\Http\Request;

class ExchangeRepository {
    public function all() {
        return Exchange::where('status',0)->get();
    }
}
