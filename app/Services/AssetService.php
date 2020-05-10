<?php

namespace App\Services;

use App\Repositories\AssetRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AssetService {
    private $assetRepository;
    public function __construct(AssetRepository $assetRepository)
    {
        $this->assetRepository = $assetRepository;
    }

    public function create(Request $request, $game_id) {
        if($request->hasfile('images'))
        {
            foreach($request->file('images') as $image)
            {
                $randomName = Str::random();
                $imageName = $randomName.'.'.$image->getClientOriginalExtension();
                $imagePath = $image->move(public_path().'/images/', $imageName);;

                $this->assetRepository->create($imageName, $imagePath, $game_id);
            }
        }
        return;
    }
}
