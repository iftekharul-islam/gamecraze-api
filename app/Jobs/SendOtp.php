<?php

namespace App\Jobs;

use App\Models\OneTimePassword;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SendOtp implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    private $phone, $otp;

    /**
     * Create a new job instance.
     *
     * @param $phone
     * @param $otp
     */
    public function __construct($phone, $otp)
    {
        $this->phone = $phone;
        $this->otp = $otp;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $message = "Your GameHub OTP code is " . $this->otp;
        $phone_number = '88'. $this->phone;

        // datasoftbd sms

        $dataSoftSms = $this->sentSmsBydataSoft($phone_number, $message);
    }

    public function sentSmsBydataSoft($phone_number, $message)
    {
        $base_url_non_masking = config("otp.sms_base_url");
        $api_key = config("otp.sms_api_key");

        $url = $base_url_non_masking . "?api_key=" . $api_key . "&smsType=text&mobileNo=" . $phone_number . "&smsContent=" . $message;

        $client = new Client();
        logger('$url');
        logger($url);
        try {
            $request = $client->get($url);

        } catch (\Exception $exception) {
            logger($exception);
        }
    }

}
