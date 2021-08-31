<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\District;
use App\Models\Division;
use App\Models\Thana;
use App\Transformers\DistrictTransformer;
use App\Transformers\DivisionTransformer;
use App\Transformers\ThanaTransformer;
use Illuminate\Http\Request;

class LocationController extends Controller
{
    /**
     * @return \Dingo\Api\Http\Response
     */
    public function divisions()
    {
        $data = Division::all();

        return $this->response()->collection($data, new DivisionTransformer());
    }

    /**
     * @return \Dingo\Api\Http\Response
     */
    public function districts()
    {
        $data = District::all();

        return $this->response()->collection($data, new DistrictTransformer());
    }

    /**
     * @return \Dingo\Api\Http\Response
     */
    public function thanas()
    {
        $data = Thana::all();

        return $this->response()->collection($data, new ThanaTransformer());
    }

}
