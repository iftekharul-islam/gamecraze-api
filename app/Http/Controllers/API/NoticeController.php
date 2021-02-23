<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Notice;
use App\Transformers\NoticeTransformer;
use Illuminate\Http\Request;

class NoticeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Notice::where('status', 1)->get();

        return $this->response->collection($data, new NoticeTransformer());
    }
}
