<?php

namespace App\Repositories;

use App\Asset;

class AssetRepository {
    public function create($imageName, $imagePath, $game_id) {
        $asset = new Asset();
        $asset->name = $imageName;
        $asset->url = $imagePath;
        $asset->game_id = $game_id;
        $asset->save();

        return;
    }
}
