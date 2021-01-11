<?php

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