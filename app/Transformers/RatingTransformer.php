<?php


namespace App\Transformers;

use App\Models\Rating;
use League\Fractal\TransformerAbstract;

class RatingTransformer extends TransformerAbstract
{
    protected $availableIncludes = [
        'lend', 'lender', 'renter'
    ];
    public function transform(Rating $rating)
    {
        // specify what elements are going to be visible to the API
        return [
            'id' => $rating->id,
            'lend_id' => $rating->lend_id,
            'lender_id' => $rating->lender_id,
            'renter_id' => $rating->renter_id,
            'lender_rating' => ceil($rating->lender_rating),
            'renter_rating' => ceil($rating->renter_rating),
            'lender_comment' => $rating->lender_comment,
            'renter_comment' => $rating->renter_comment,
            'notify_lender' => $rating->notify_lender,
            'notify_renter' => $rating->notify_renter,
        ];
    }

    public function includeLend(Rating $rating) {
        return $this->item($rating->lend, new LendTransformers());
    }

    public function includeLender(Rating $rating) {
        return $this->item($rating->lender, new UserTransformer());
    }

    public function includeRenter(Rating $rating) {
        return $this->item($rating->renter, new UserTransformer());
    }

}
