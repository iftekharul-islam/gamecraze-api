<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\CoverImage;
use App\Transformers\CoverImageTransformers;
use Illuminate\Http\Request;

class CoverImageController extends Controller
{
    /**
     * @return \Dingo\Api\Http\Response
     */
    public function index()
    {
        $data = CoverImage::all();
        return $this->response->collection($data, new CoverImageTransformers());
    }
}
