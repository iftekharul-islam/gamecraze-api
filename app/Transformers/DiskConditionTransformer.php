<?php


namespace App\Transformers;

use App\Models\DiskCondition;
use League\Fractal\TransformerAbstract;

class DiskConditionTransformer extends TransformerAbstract
{
    /**
     * @param DiskCondition $diskData
     * @return array
     */
    public function transform(DiskCondition $diskData){
        // specify what elements are going to be visible to the API
        return [
            'id' => $diskData->id,
            'Author_id' => $diskData->author_id,
            'name_of_type' =>  $diskData->name,
            'description' =>  $diskData->description,
            'status' => $diskData->status,
        ];
    }
}
