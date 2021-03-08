<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\BaseController;
use App\Models\CartItem;
use App\Transformers\CartItemTransformer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartItemController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = CartItem::where('user_id', Auth::user()->id)->get();
        if ($data) {
            return $this->response->collection($data, new CartItemTransformer());
        }

        return responseData('No cart items found', 404);
    }

    /**
     * @param Request $request
     * @return array
     */
    public function store(Request $request)
    {
        $itemExist = CartItem::where('rent_id', $request->rent_id)->first();
        if ($itemExist) {
            return [
                'error' => true,
                'message' => "Item already in cart"
            ];
        }
        $data = $request->only('rent_id', 'user_id', 'rent_week', 'address');
        $data['user_id'] = Auth::user()->id;
        CartItem::create($data);

        return [
            'error' => false,
            'message' => "Cart item store Successful"
        ];
    }

    /**
     * @param Request $request
     * @return array
     */
    public function destroy(Request $request)
    {
        logger($request->id);
        $data = CartItem::where('id', $request->id)->where('user_id', auth()->user()->id)->first();
        if ($data){
            $data->delete();
            return [
                'error' => false,
                'message' => "Cart item deleted Successful"
            ];
        }
        return [
            'error' => true,
            'message' => "Cart item not deleted"
        ];
    }

}
