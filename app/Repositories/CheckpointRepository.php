<?php


namespace App\Repositories;


use App\models\Checkpiont;

class CheckpointRepository
{
    public function all() {
        return Checkpiont::all();
    }

}
