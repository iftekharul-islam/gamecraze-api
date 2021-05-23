<?php
namespace App\Services;

class BkashPaymentService
{
    public function processPayment($data)
    {
        $token = $this->grantToken();
        if (empty($token)) {
            die('Internal error occured. Try later');
        }
        $request_data = array(
            'amount' => $data['amount'],
            'currency' => $data['currency'],
            'intent' => $data['intent'],
            'merchantInvoiceNumber' => $data['merchantInvoiceNumber'],
            'user_id' => $data['user_id'] ?? 0
        );
        $url = curl_init(env('BKASH_CREATE_URL'));
        $request_data_json = json_encode($request_data);
        $header = array(
            'Content-Type:application/json',
            'authorization:' . $token,
            'x-app-key:' . env('BKASH_APP_KEY')
        );
        curl_setopt($url, CURLOPT_HTTPHEADER, $header);
        curl_setopt($url, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($url, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($url, CURLOPT_POSTFIELDS, $request_data_json);
        curl_setopt($url, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($url, CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V4);
        curl_setopt($url, CURLOPT_TIMEOUT, 30);
        curl_setopt($url, CURLOPT_CONNECTTIMEOUT, 30);
        $response = curl_exec($url);
        $code = curl_getinfo($url, CURLINFO_HTTP_CODE);
        curl_close($url);
        // if ($code == 200 ) {
        //     $this->executeBkashPayment(json_decode($response));
        //     exit;
        // }

        return $response;
    }

    /**
     * @return mixed|null
     */
    public function grantToken()
    {
        $request_data = [
            'app_key' => env('BKASH_APP_KEY'),
            'app_secret' => env('BKASH_APP_SECRET')
        ];
        $url = curl_init(env('BKASH_GRANT_URL'));
        $request_data_json = json_encode($request_data);
        $header = array(
            'Content-Type:application/json',
            'username:' . env('BKASH_USER_NAME'),
            'password:' . env('BKASH_USER_PASSWORD')
        );
        curl_setopt($url, CURLOPT_HTTPHEADER, $header);
        curl_setopt($url, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($url, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($url, CURLOPT_POSTFIELDS, $request_data_json);
        curl_setopt($url, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($url, CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V4);
        $data = curl_exec($url);
        $code = curl_getinfo($url, CURLINFO_HTTP_CODE);
        curl_close($url);
        if ($code == 200) {
            return json_decode($data, true)['id_token'];
        }
        return null;
    }

    public function execute($request)
    {
        $paymentID = $request->paymentID;
        logger($paymentID);

        $token = $this->grantToken();
        $url = curl_init(env('BKASH_EXECUTE_URL') . $paymentID);
        $header = array(
            'Content-Type:application/json',
            'authorization:' . $token,
            'x-app-key:' . env('BKASH_APP_KEY')
        );
        curl_setopt($url, CURLOPT_HTTPHEADER, $header);
        curl_setopt($url, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($url, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($url, CURLOPT_FOLLOWLOCATION, 1);
        $response = curl_exec($url);
        curl_close($url);
//        logger($response);
        return $response;
    }

    public function execute2($data)
    {
        $data = json_decode($data, true);
        logger($data['paymentID']);
//        die();
        $paymentID = $data['paymentID'];

        $token = $this->grantToken();
        logger($token);
        $url = curl_init(env('BKASH_EXECUTE_URL') . $paymentID);
        $header = array(
            'Content-Type:application/json',
            'authorization:' . $token,
            'x-app-key:' . env('BKASH_APP_KEY')
        );
        curl_setopt($url, CURLOPT_HTTPHEADER, $header);
        curl_setopt($url, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($url, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($url, CURLOPT_FOLLOWLOCATION, 1);
        $response = curl_exec($url);
        curl_close($url);
//        logger($response);
//        die();
        return $response;
    }
}
