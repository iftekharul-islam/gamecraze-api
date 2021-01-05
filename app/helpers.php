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