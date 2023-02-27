<?php

namespace App\Services;

use App\Repositories\AssetRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
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
                $image->storeAs('games', $imageName);
//                $imagePath = Storage::disk('public')->put('games', $imageName);

                $this->assetRepository->create($imageName, $game_id);
            }
        }
        return;
    }
}
