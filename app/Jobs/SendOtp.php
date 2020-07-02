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
        $message = "Your OTP code is " . $this->otp;
        $user = config("otp.sms_user");
        $pass = config("otp.sms_pass");
        $sid = config("otp.sms_sid");
        $url = "http://sms.sslwireless.com/pushapi/dynamic/server.php";
        $client = new Client();

        try {
            $response = $client->request('POST', $url, [
                'form_params' => [
                    'user' => $user,
                    'pass' => $pass,
                    'sid'  => $sid,
                    'sms'  => [
                        [$this->phone, $message],
                    ],
                ],
            ]);

            OneTimePassword::create([
                'phone_number' => $this->phone,
                'otp' => $this->otp
            ]);
        }
        catch (GuzzleException $exception) {
            logger($exception);
        }
    }
}
