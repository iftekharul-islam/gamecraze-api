<?php

namespace App\Repositories;

use App\Models\Asset;

class AssetRepository {
    public function create($imageName, $game_id) {
        $asset = new Asset();
        $asset->name = $imageName;
        $asset->game_id = $game_id;
        $asset->save();
    }
}
