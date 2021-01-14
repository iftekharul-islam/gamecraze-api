<?php

namespace App\Services;

use Illuminate\Http\Request;
use Newsletter;

class SubscriptionService {

    public function addSubscriber($email) {
        logger('form servcie: ' . $email);
        if ( ! Newsletter::isSubscribed($email) ) {
            $response = Newsletter::subscribe($email);
            logger('res: ', $response);
            return responseData('Suscribed Sucessfylly', 200);
        }

        return responseData('Already Subscribed', 200);
    }
}
