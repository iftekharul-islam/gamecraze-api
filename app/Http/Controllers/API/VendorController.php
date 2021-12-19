<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\UserVendor;
use App\Models\Vendor;
use App\Transformers\UserTransformer;
use App\Transformers\VendorTransformer;
use Illuminate\Http\Request;

class VendorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user  = User::where('id', auth()->user()->id)->first();

        return $this->response->item($user, new UserTransformer());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        logger('file update log');
        logger($request->all());
        $vendor = Vendor::find($request->id);
        if(!$vendor){
            return response([
               'message'=> 'No vendor found'
            ]);
        }

        if ($request->profile_photo) {
            $image = $request->profile_photo;
            $extension = explode('/', explode(':', substr($image, 0, strpos($image, ';')))[1])[1];
            $profile_image = $vendor['shop_name'] . '-profile-' . time() . '_' .$vendor['id'] . '.' . $extension;
            \Image::make($image)->save(storage_path('app/public/vendor-image/') . $profile_image);
            $vendor['profile_photo'] =  'storage/vendor-image/'.$profile_image ;
        }
        if ($request->cover_photo) {
            $image = $request->cover_photo;
            $extension = explode('/', explode(':', substr($image, 0, strpos($image, ';')))[1])[1];
            $cover_image = $vendor['shop_name'] . '-cover-' . time() . '_' .$vendor['id'] . '.' . $extension;
            \Image::make($image)->save(storage_path('app/public/vendor-image/') . $cover_image);
            $vendor['cover_photo'] =  'storage/vendor-image/'.$cover_image ;
        }
        $vendor->save();

        return $this->response()->item($vendor, new VendorTransformer());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
