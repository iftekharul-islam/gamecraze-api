<?php


namespace App\Transformers;


use App\Models\District;
use League\Fractal\TransformerAbstract;

class DistrictTransformer extends TransformerAbstract
{
    protected $availableIncludes = [
        'division'
    ];
    public function transform(District $district)
    {
        // specify what elements are going to be visible to the API
        return [
            'id' => $district->id,
            'name' => $district->name,
            'bn_name' => $district->bn_name,
            'division_id' => $district->division_id,
            'status' => $district->status,
        ];
    }

    public function includeDivision(District $district) {
        return $this->item($district->division, new DivisionTransformer());
    }
}
