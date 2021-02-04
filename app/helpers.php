<?php

use App\Models\GameOrder;
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

/**
 * generate order number
 * @param id int
 */
if (!function_exists("generateOrderNo")){ 
    function generateOrderNo()
    {
        $latestOrder = GameOrder::orderBy('id', 'desc')->first();
        if ($latestOrder) {
            return $latestOrder->order_no + 1;
        } 
  
        return 0001;
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