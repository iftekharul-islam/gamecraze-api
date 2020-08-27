<?php


namespace App\Transformers;


use App\Models\Division;
use League\Fractal\TransformerAbstract;

class DivisionTransformer extends TransformerAbstract
{
    public function transform(Division $division)
    {
        // specify what elements are going to be visible to the API
        return [
            'id' => $division->id,
            'name' => $division->name,
            'status' => $division->status,
        ];
    }

}
