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
    public function userRating(Request $request)
    {
        logger($request->all());
        logger(Auth::user()->id);

        $renter = Rating::where('renter_id', Auth::user()->id)->where('id', $request->id)->first();

        if($renter){
            $renter->renter_rating = $request->rating;
            $renter->renter_comment = $request->comment;
            $renter->notify_renter = true;
            $renter->save();

            return responseData('Renter rating successfully updated');
        }

        $lender = Rating::where('lender_id', Auth::user()->id)->where('id', $request->id)->first();

        if($lender){
            $lender->lender_rating = $request->rating;
            $lender->lender_comment = $request->comment;
            $lender->notify_lender = true;
            $lender->save();

            return responseData('Lender rating successfully updated');
        }

        return responseData('Rating id not found');
    }

    /**
     * @return \Dingo\Api\Http\Response
     */
    public function ratingCheck()
    {
        $rating = Rating::where('lender_id', Auth::user()->id)
            ->where('notify_lender', null)
            ->orWhere(function ($q) {
                $q->where('renter_id', Auth::user()->id)
                    ->where('notify_renter', null);
            })->get();

        return $this->response->collection($rating, new RatingTransformer());
    }

    /**
     * @return \Dingo\Api\Http\Response
     */
    public function lenderRatingList()
    {
        $rating = Rating::where('lender_id', Auth::user()->id)
            ->where(function ($query) {
                $query->where('notify_lender', '!=', null)
                    ->orWhere('notify_renter', '!=', null);
                    })->get();

        return $this->response->collection($rating, new RatingTransformer());
    }

    /**
     * @return \Dingo\Api\Http\Response
     */
    public function renterRatingList()
    {
        $rating = Rating::where('renter_id', Auth::user()->id)
            ->where(function ($query) {
                $query->where('notify_renter', '!=', null)
                    ->orWhere('notify_lender', '!=', null);
            })->get();

        return $this->response->collection($rating, new RatingTransformer());
    }

    public function avgLenderRatingForMe()
    {
        $total = Rating::where('lender_id', Auth::user()->id)->where('notify_renter', '!=', null)->sum('renter_rating');
        $collection = Rating::where('lender_id', Auth::user()->id)->count();
        $avg_value = 0;
        if ($total > 0){
            $avg_value = $total / $collection;
        }
        return $this->response->array([
            'avg' => ceil($avg_value),
            'error' => false
        ]);
    }

    public function avgRenterRatingForMe()
    {
        $total = Rating::where('renter_id', Auth::user()->id)->where('notify_lender', '!=', null)->sum('lender_rating');
        $collection = Rating::where('renter_id', Auth::user()->id)->count();
        $avg_value = 0;
        if ($total > 0){
            $avg_value = $total / $collection;
        }
        return $this->response->array([
            'avg' => ceil($avg_value),
            'error' => false
        ]);
    }
}
