<?php

namespace App\Services;

use Illuminate\Http\Request;
use Newsletter;

class SubscriptionService {

    public function addSubscriber($email) {
        if ( ! Newsletter::isSubscribed($email) ) {
            Newsletter::subscribe($email);
            return responseData('Suscribed Sucessfully', 200);
        }

        return responseData('Already Subscribed', 200);
    }
}
