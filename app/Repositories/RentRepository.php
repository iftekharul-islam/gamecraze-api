<?php

namespace App\Repositories;

use App\Models\Rent;
use Illuminate\Http\Request;

class RentRepository {
    public function all() {
        return Rent::where('status',0)->get();
    }
}
