<?php


namespace App\Repositories;


use App\Models\Commission;

class CommissionRepository
{
    public function index()
    {
        return Commission::first();
    }
}
