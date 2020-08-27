<?php


namespace App\Transformers;


use App\Models\Area;
use App\models\Checkpiont;
use League\Fractal\TransformerAbstract;

class CheckpointTransformer extends TransformerAbstract
{
    protected $availableIncludes = [
        'area'
    ];
    public function transform(Checkpiont $checkpiont)
    {
        // specify what elements are going to be visible to the API
        return [
            'id' => $checkpiont->id,
            'user_id' => $checkpiont->user_id,
            'name' => $checkpiont->name,
            'flat_no' => $checkpiont->flat_no,
            'house_no' => $checkpiont->house_no,
            'road_no' => $checkpiont->road_no,
            'block_no' => $checkpiont->block_no,
            'area_id' => $checkpiont->area_id,
            'availability_start_time' => $checkpiont->availability_start_time,
            'availability_end_time' => $checkpiont->availability_end_time,
            'holiday' => $checkpiont->holiday,
            'comment' => $checkpiont->comment,
        ];
    }

    public function includeArea(Checkpiont $checkpiont) {
        return $this->item($checkpiont->area, new AreaTransformer());
    }

}
