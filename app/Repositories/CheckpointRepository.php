<?php


namespace App\Repositories;

use App\Models\Checkpiont;

class CheckpointRepository
{
    public function all() {
        return Checkpiont::all();
    }

}
