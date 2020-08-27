<?php


namespace App\Transformers;


use App\Models\Area;
use League\Fractal\TransformerAbstract;

class AreaTransformer extends TransformerAbstract
{
    protected $availableIncludes = [
        'thana'
    ];
    public function transform(Area $area)
    {
        // specify what elements are going to be visible to the API
        return [
            'name' => $area->name,
            'thana_id' => $area->thana_id,
            'status' => $area->status,
        ];
    }

    public function includeThana(Area $area) {
        return $this->item($area->thana, new ThanaTransformer());
    }

}
