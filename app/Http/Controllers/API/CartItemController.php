<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\BaseController;
use App\Models\CartItem;
use App\Repositories\Admin\basePriceRepository;
use App\Transformers\CartItemTransformer;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;

class CartItemController extends BaseController
{
    /**
     * @var
     */
    private $basePriceRepository;

    /**
     * BasePriceController constructor.
     * @param BasePriceRepository $basePriceRepository
     */
    public function __construct(BasePriceRepository $basePriceRepository)
    {
        $this->basePriceRepository = $basePriceRepository;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = CartItem::with('rent.game')->where('user_id', Auth::user()->id)->get();
        $achievedDiscount = Auth::user()->achieve_discount;
        if ($items) {

            $totalRegularPrice = 0;
            $totalRegularCommission = 0;
            $totalDiscountPrice = 0;
            $totalDiscountCommission = 0;
            $deliveryCharge = 0;

            $cartItems = new Collection();
            foreach ($items as $item) {
                if ($item->rent){
                    $price = $this->basePriceRepository->gamePriceCalculation($item->rent->game_id, $item->rent_week, $item->rent->disk_type, $achievedDiscount);
                    $cartItems->push((object)[
                        'id' => $item->id,
                        'rent_id' => $item->rent_id,
                        'user_id' => $item->user_id,
                        'rent_week' => $item->rent_week,
                        'address' => $item->address,
                        'status' => $item->status,
                        'regular_price' => $price['regular_price'],
                        'regular_commission' => $price['regular_commission'],
                        'discount_price' => $price['discount_price'],
                        'discount_commission' => $price['discount_commission'],
                        'game_name' => $item->rent->game->name,
                        'renter_id' => $item->rent->user_id,
                        'disk_type' => $item->rent->disk_type,
                    ]);

                    $totalRegularPrice += $price['regular_price'];
                    $totalRegularCommission += $price['regular_commission'];
                    $totalDiscountPrice += $price['discount_price'];
                    $totalDiscountCommission += $price['discount_commission'];

                    if ($item->rent->disk_type == 1) {
                        $deliveryCharge = config('gamehub.delivery_charge');
                    }
                }
            }

            $data = [
                'cartItems' => $cartItems,
                'totalRegularPrice' => $totalRegularPrice + $totalRegularCommission,
                'totalRegularCommission' => $totalRegularCommission,
                'totalDiscountPrice' => $totalDiscountPrice + $totalDiscountCommission,
                'totalDiscountCommission' => $totalDiscountCommission,
                'deliveryCharge' => $deliveryCharge,
            ];

            return response()->json(compact('data'), 200);
        }

        return responseData('No cart items found', 404);
    }

    /**
     * @param Request $request
     * @return array
     */
    public function store(Request $request)
    {
        $itemExist = CartItem::where('rent_id', $request->rent_id)->where('user_id', Auth::user()->id)->first();
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
