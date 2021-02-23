<?php


namespace App\Transformers;


use App\Models\Notice;
use League\Fractal\TransformerAbstract;

class NoticeTransformer extends TransformerAbstract
{
    public function transform(Notice $data)
    {
        return [
          'id' => $data->id,
          'title' => $data->title,
          'description' => $data->description,
        ];
    }
}
