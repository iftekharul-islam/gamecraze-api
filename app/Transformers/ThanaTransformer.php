<?php


namespace App\Transformers;


use App\Models\Thana;
use League\Fractal\TransformerAbstract;

class ThanaTransformer extends TransformerAbstract
{
    protected $availableIncludes = [
        'district'
    ];
    public function transform(Thana $thana)
    {
        // specify what elements are going to be visible to the API
        return [
            'id' => $thana->id,
            'name' => $thana->name,
            'district_id' => $thana->district_id,
            'status' => $thana->status,
        ];
    }

    public function includeDistrict(Thana $thana) {
        return $this->item($thana->district, new DistrictTransformer());
    }
}
