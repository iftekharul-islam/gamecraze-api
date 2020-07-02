<?php
return [
    'sms_user' => env('SMS_USER', ''),
    'sms_pass'    => env('SMS_PASS', ''),
    'sms_sid'=> env('SMS_SID', ''),
    'lifetime' => env('OTP_LIFETIME', 5 * 60)
];
