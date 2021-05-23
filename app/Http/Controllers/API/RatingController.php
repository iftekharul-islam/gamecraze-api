<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Rating;
use App\Transformers\RatingTransformer;
use App\Transformers\RentTransformer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RatingController extends Controller
{
    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function renterRating(Request $request)
    {
        $rating = Rating::where('lend_id', $request->lend_id)->first();

        if($rating){
            $rating->renter_id = $request->renter_id;
            $rating->renter_rating = $request->renter_rating;
            $rating->renter_comment = $request->renter_comment;
            $rating->save();

            return response()->json(compact('rating'), 200);
        }

        $rating = new Rating();
        $rating->lend_id = $request->lend_id;
        $rating->renter_id = $request->renter_id;
        $rating->renter_rating = $request->renter_rating;
        $rating->renter_comment = $request->renter_comment;
        $rating->save();

        return response()->json(compact('rating'), 200);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function lenderRating(Request $request)
    {
        $rating = Rating::where('lend_id', $request->lend_id)->first();

        if($rating){
            $rating->lender_id = $request->lender_id;
            $rating->lender_rating = $request->lender_rating;
            $rating->lender_comment = $request->lender_comment;
            $rating->save();

            return response()->json(compact('rating'), 200);
        }

        $rating = new Rating();
        $rating->lend_id = $request->lend_id;
        $rating->lender_id = $request->lender_id;
        $rating->lender_rating = $request->lender_rating;
        $rating->lender_comment = $request->lender_comment;
        $rating->save();

        return response()->json(compact('rating'), 200);
    }

    /**
     * @return array
     */
    public function ratingCheck()
    {
        $pendingRating = Rating::where('lender_id', Auth::user()->id)
            ->where('notify_lender', null)
            ->orWhere(function ($q) {
                $q->where('renter_id', Auth::user()->id)
                    ->where('notify_renter', null);
            })
            ->count();

        if ($pendingRating > 0){
            $ratingCheck =[
                'pending' => true,
                'error' => false,
            ];
            return response()->json(compact('ratingCheck'), 200);
        }
        $ratingCheck =[
            'pending' => false,
            'error' => true,
        ];
        return response()->json(compact('ratingCheck'), 200);
    }

    /**
     * @return \Dingo\Api\Http\Response
     */
    public function lenderRatingList()
    {
        $rating = Rating::where('lender_id', Auth::user()->id)->where('notify_lender', null)->get();

        return $this->response->collection($rating, new RatingTransformer());
    }

    /**
     * @return \Dingo\Api\Http\Response
     */
    public function renterRatingList()
    {
        $rating = Rating::where('renter_id', Auth::user()->id)->where('notify_renter', null)->get();

        return $this->response->collection($rating, new RatingTransformer());
    }
}
