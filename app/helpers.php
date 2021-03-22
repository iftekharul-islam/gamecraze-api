<?php

use App\Models\GameOrder;
use Carbon\Carbon;
use Illuminate\Support\Facades\File;

if (! function_exists('deleteFile')) {
    function deleteFile($urls = []) {
        if (is_array($urls)) {
            foreach ($urls as $url) {
                if (file_exists($url)) {
                    File::delete($url);
                }
            }
            return true;
        }

        return false;
    }
}

//prepare response & return
if (!function_exists('responseData')) {
    function responseData($message, $code = 200)
    {
        $response = [
            'message' => $message,
            'status_code' => $code
        ];

        return response()->json($response, $code); 
    }
}


if (!function_exists("generateUniqueOrderNo")){
    function generateUniqueOrderNo()
    {
        $latestOrder = GameOrder::orderBy('id', 'desc')->first();
        if ($latestOrder) {
            $latestOrder = $latestOrder->order_no + 1;
        }

        return 'GH'.str_pad($latestOrder, 6, time(), STR_PAD_RIGHT);
    }
}

/**
 * generate order status
 * @param status int
 */
if (!function_exists("getOrderDeliveryStatus")){ 
    function getOrderDeliveryStatus($status)
    {
        $orderStatus = config('gamehub.order_delivery_status');
        if ( isset($orderStatus[$status]) ) {
            return $orderStatus[$status];
        }
        return null;
    }
}

/**
 * generate order status
 * @param status int
 */
if (!function_exists("getDiskDeliveryStatus")){ 
    function getDiskDeliveryStatus($status)
    {
        $diskStatus = config('gamehub.disk_delivery_status');
        if ( isset($diskStatus[$status]) ) {
            return $diskStatus[$status];
        }
        return null;
    }
}

/**
 * Format date
 * @param date valid date
 */
if (!function_exists("gameHubDateFormat")){ 
    function gameHubDateFormat($date, $fromFormat = 'Y-m-d')
    {
        $d = DateTime::createFromFormat($fromFormat, $date);
        // The Y ( 4 digits year ) returns TRUE for any integer with any number of digits so changing the comparison from == to === fixes the issue.
        if ($d->format($fromFormat) === $date) {
            return $d->format(config('gamehub.date_format'));
        }

        return null;
    }
}

if (!function_exists("gameHubDateFormat")) {
    function new_time_date_format($date)
    {
        return Carbon::parse($date)->format(config('gamehub.date_format'));
    }
}
