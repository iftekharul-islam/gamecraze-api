<?php

namespace App\Http\Controllers;

use App\Exports\TransactionsExport;
use App\Models\Lender;
use App\Models\TransactionHistory;
use App\Models\User;
use App\Services\BkashPaymentService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class TransactionHistoryController extends Controller
{
    protected $bkashPaymentService;

    public function __construct(BkashPaymentService $bkashPaymentService)
    {
        $this->bkashPaymentService = $bkashPaymentService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
         if ($request->search){
            $value = User::where(DB::raw("CONCAT(`name`, ' ', `last_name`)"), 'LIKE', "%".$request->search."%")
                ->join('lenders', 'users.id', '=', 'lenders.renter_id')
                ->selectRaw('SUM(discount_amount) as discount_amount, 
                            SUM(commission) as commission,
                            SUM(original_commission) as original_commission,
                            SUM(lend_cost) as seller_amount,
                            renter_id, users.name, users.last_name, users.id')
                    ->groupBy('lenders.renter_id')
                    ->where('lenders.status', 1)
                    ->where('lenders.deleted_at', null)
                    ->get();
        } else {
            $value = User::join('lenders', 'users.id', '=', 'lenders.renter_id')
                ->selectRaw('SUM(discount_amount) as discount_amount, 
                            SUM(commission) as commission,
                            SUM(original_commission) as original_commission,
                            SUM(lend_cost) as seller_amount,
                            renter_id, users.name, users.last_name, users.id')
                ->groupBy('lenders.renter_id')
                ->where('lenders.status', 1)
                ->where('lenders.deleted_at', null)
                ->get();
        }

        $paid_amount = TransactionHistory::selectRaw('SUM(amount) as paid_amount, user_id as id')->groupBy('user_id')->get();

        $data = $value->map(function ($row) use ($paid_amount) {
            $paid = $paid_amount->where('id', $row->id)->pluck('paid_amount')->first();
            return collect($row)->put('due', $row->seller_amount + $row->discount_amount + $row->commission - $row->original_commission  - $paid );
        });

        $total_amount= 0;
        $seller_amount= 0;
        $gamehub_amount= 0;
        $discount_amount = 0;
        foreach ($data as $item) {
            $total_amount += $item['seller_amount'] + $item['discount_amount'] + $item['commission'];
            $seller_amount += $item['seller_amount'] + $item['discount_amount'] + $item['commission'] - $item['original_commission'];
            $discount_amount += $item['discount_amount'];
            $gamehub_amount += $item['original_commission'];
        }

        return view('admin.transaction_history.index', compact('data', 'paid_amount', 'total_amount', 'seller_amount', 'discount_amount', 'gamehub_amount'));
    }

    public function payAmount($id)
    {
        $data = TransactionHistory::with('author')
            ->where('user_id', $id)
            ->get();

        return view('admin.transaction_history.pay_amount', compact('data'));
    }

    public function myLendPost($id)
    {
        $data = Lender::with('lender', 'rent.game', 'order')->where('renter_id', $id)->where('status', 1)->get();

        return view('admin.transaction_history.lend_list', compact('data'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    public function payment(Request $request, $id)
    {
        $data = $request->only(['amount', 'description', 'payment_type', 'transaction_id', 'user_id', 'author_id']);

        $data['description'] = 'Test description';

        $data['user_id'] = $id;

        $data['author_id'] = Auth::user()->id;

        TransactionHistory::create($data);

        return redirect()->back()->with('status', 'Payment successfully completed');

    }

    public function transactionExport()
    {
        $date = Carbon::now()->format('d-m-Y');
        ob_end_clean();
        ob_start();
        return (new TransactionsExport())->download('transaction-'.  time() . '-' . $date  . '.xls');
    }


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
            return json_decode($data, true);
        }
        return null;
    }

    public function payBkash(Request $request)
    {
        $token = $this->bkashPaymentService->grantToken();
        if (empty($token)) {
            die('Internal error occured. Try later');
        }
        $data = [
            'amount' => 100,
            'currency' => 'BDT',
            'intent' => 'sale',
            'merchantInvoiceNumber' => 'SR100000000'
        ];
        return $this->bkashPaymentService->processPayment($data);
//        $data = $this->bkashPaymentService->processPayment($data);
//        $value = $this->executeBkashPayment($data);
//        return $value;
    }


    public function executeBkashPayment(Request $request)
    {
        $executeBkash = $this->bkashPaymentService->execute($request);
        $bkashData = json_decode($executeBkash, true);
        logger($bkashData);
//        die();
        if ($bkashData['transactionStatus'] === 'Completed') {
//            $orderNo = $this->bkashPayment($bkashData);
//            if ($orderNo) {
                logger('payment complete');
                Session::flash('success_message', __('Order Completed Successfully! Please check email. '));
//                Session::flash('success_message', __('Order Completed Successfully! Please check email. order-no: ' . $orderNo));
                return $executeBkash;
//            }
        }
    }

//    public function bkashPayment($bkashData)
//    {
//        #Save User all information
//        $userDetails = session()->get('user_details');
//        $customerProduct = Session::get('single_vendor_price');
//        $memberList = Session::get('member_list');
//        $memberNameList = [];
//        foreach ($memberList as $member) {
//            $memberNameList[] = $member->name;
//        }
//        $userInfo = TravelCustomerDetails::create([
//            'user_id'                => $userDetails['user_id'],
//            'user_name'              => $userDetails['user_name'],
//            'user_mobile'            => $userDetails['user_mobile'],
//            'user_email'             => $userDetails['user_email'],
//            'nid_number'             => $userDetails['nid_number'],
//            'home_address'           => $userDetails['home_address'],
//            'home_city'              => $userDetails['home_city'],
//            'home_area'              => $userDetails['home_area'],
//            'delivery_address'       => $userDetails['delivery_address'],
//            'delivery_city'          => $userDetails['delivery_city'],
//            'delivery_area'          => $userDetails['delivery_area'],
//            'additional_information' => $userDetails['additional_information'],
//        ]);
//        $memberPassport = TemporaryMemberPassportImage::where('user_id', $userDetails['user_id'])->get();
//        $memberMedicalDetails = TemporaryMedicalData::where('user_id', $userDetails['user_id'])->get();
//        $medicalInfoIds = [];
//        foreach ($memberList as $key => $member) {
//            $medicalInfo = TravelInsuranceMemberDetails::create([
//                'user_id' => $userDetails['user_id'],
//                'member_name' => $member->name,
//                'member_dob' => Carbon::createFromFormat('m/d/Y', $member->dob)->format('Y-m-d'),
//                'member_age' => $member->age,
//                'member_passport' => $memberPassport[$key]->passport_image,
//                "q1_check" => $memberMedicalDetails[$key]->q1_check,
//                "q1_ans" => $memberMedicalDetails[$key]->q1_ans,
//                "q2a_check" => $memberMedicalDetails[$key]->q2a_check,
//                "q2a_ans" => $memberMedicalDetails[$key]->q2a_ans,
//                "q2b_check" => $memberMedicalDetails[$key]->q2b_check,
//                "q2b_ans" => $memberMedicalDetails[$key]->q2a_ans,
//                "q2c_check" => $memberMedicalDetails[$key]->q2c_check,
//                "q2c_ans" => $memberMedicalDetails[$key]->q2a_ans,
//                "q2d_check" => $memberMedicalDetails[$key]->q2d_check,
//                "q2d_ans" => $memberMedicalDetails[$key]->q2a_ans,
//                "q2e_check" => $memberMedicalDetails[$key]->q2e_check,
//                "q2e_ans" => $memberMedicalDetails[$key]->q2a_ans,
//                "q2f_check" => $memberMedicalDetails[$key]->q2f_check,
//                "q2f_ans" => $memberMedicalDetails[$key]->q2a_ans,
//                "q3_check" => $memberMedicalDetails[$key]->q3_check,
//                "q3_ans" => $memberMedicalDetails[$key]->q2a_ans,
//                "q4_check" => $memberMedicalDetails[$key]->q4_check,
//                "q4_ans" => $memberMedicalDetails[$key]->q2a_ans,
//                "q5_illness_ans" => $memberMedicalDetails[$key]->q5_illness_ans,
//                "q5_date" => $memberMedicalDetails[$key]->q5_date,
//                "q5_attending_info" => $memberMedicalDetails[$key]->q5_attending_info,
//                "q6_ans" => $memberMedicalDetails[$key]->q6_ans,
//                "accept_term" => $memberMedicalDetails[$key]->accept_term,
//                "user_details_id" => $userInfo->id
//            ]);
//            $memberPassport[$key]->delete();
//            $memberMedicalDetails[$key]->delete();
//            $medicalInfoIds[] = $medicalInfo->id;
//        }
//        $travelCustomerProductInfo = TravelCustomerProductInfo::create([
//            'user_id'                  => $userDetails['user_id'],
//            'purpose_your_visit'       => $customerProduct['purpose_your_visit'],
//            'country_to_travel'        => $customerProduct['country_to_travel'],
//            'sub_country_type'         => $customerProduct['sub_category'],
//            'insurance_covered'        => $customerProduct['insurance_covered_id'] == 1 ? 'Individual' : 'Group',
//            'insurance_people_covered' => $customerProduct['insurance_covered'],
//            'travel_type'              => $customerProduct['travel_type'] == 1 ? 'Single' : 'Multiple',
//            'start_date'               => Carbon::parse($customerProduct['start_date'])->format('Y-m-d'),
//            'end_date'                 => Carbon::parse($customerProduct['end_date'])->format('Y-m-d'),
//            'stay_days'                => $customerProduct['stay_days'],
//            'country_list'             => $customerProduct['country_list'],
//            'member_list'              => json_encode($memberList),
//            'per_person_cost'          => json_encode($customerProduct['per_person_cost'])
//        ]);
//        $netPremium = $customerProduct['net_premium'] * $customerProduct['currency_rate'];
//        $discountAmount = ( $netPremium * $customerProduct['discount_amount'] )/ 100 ;
//        $vendorVat = ($netPremium * $customerProduct['vendor_vat']) / 100;
//        $amount = $bkashData['amount'];
//        $createDate = explode(' ', $bkashData['createTime']);
//        $createDate = explode('T', $createDate[0]);
//        $updateDate = explode(' ', $bkashData['updateTime']);
//        $updateDate = explode('T', $updateDate[0]);
//        $customerOrder = new TravelCustomerOrder();
//        $customerOrder->product_info = json_encode($customerProduct);
//        $customerOrder->customer_id = Auth::user()->user_type_primary_id;
//        $customerOrder->customer_name = $userDetails['user_name'];
//        $customerOrder->customer_mobile = $userDetails['user_mobile'];
//        $customerOrder->customer_email = isset($userDetails['user_email']) ? $userDetails['user_email'] : '';
//        $customerOrder->vendor_id = $customerProduct['vendor_id'];
//        $customerOrder->tran_id = $bkashData['trxID'];
//        $customerOrder->payment_type = array_flip(config('common.payment_types'))['Bkash'];
//        $customerOrder->val_id = $bkashData['paymentID'];
//        $customerOrder->amount = $amount;
//        $customerOrder->currency = "BDT";
//        $customerOrder->store_amount = $amount;
//        $customerOrder->bank_tran_id = 0;
//        $customerOrder->card_type = 0;
//        $customerOrder->tran_date = Carbon::parse($createDate[0])->format('Y-m-d');
//        $customerOrder->validated_on = Carbon::parse($updateDate[0])->format('Y-m-d');
//        $customerOrder->travel_plan_name = $customerProduct['purpose_your_visit'];
//        $customerOrder->discount_amount = $customerProduct['discount_amount'];
//        $customerOrder->discount_promo_code = $customerProduct['discount_promo_code'];
//        $customerOrder->currency_rate = $customerProduct['currency_rate'];
//        $vendorInfo = vendorModel::find($customerProduct['vendor_id']);
//        $dealTypeVendor = $vendorInfo->deal_type;
//        $dealAmountVendor = $vendorInfo->amount;
//        if($dealTypeVendor == array_flip(config('common.deal_type'))['Percentage']){
//            $receivableAmount = ($dealAmountVendor/100)*$amount;
//        }elseif ($dealTypeVendor == array_flip(config('common.deal_type'))['Fixed Amount']){
//            $receivableAmount = $dealAmountVendor;
//        }
//        $customerOrder->customer_product_info_id = $travelCustomerProductInfo->id;
//        $customerOrder->receivable_amount = $receivableAmount;
//        $customerOrder->save();
//        //Travel customer details save order id
//        TravelCustomerDetails::where('id', $userInfo->id)->update(['order_id' => $customerOrder->id] );
//        foreach ($medicalInfoIds as $id) {
//            TravelInsuranceMemberDetails::where('id', $id)->update(['order_id' => $customerOrder->id]);
//        }
//        $customerData = Customer::find(Auth::user()->user_type_primary_id);
//        $vendorData = vendorModel::find($customerProduct['vendor_id']);
//        $customerProductData = $customerProduct;
//        $customerProductInfo = $travelCustomerProductInfo;
//        $data = [
//            'customerData' => $customerData,
//            'vendorData' => $vendorData,
//            'orderNo'=>$customerOrder->order_no,
//            'customerProductData'=> $customerProductData,
//            'customerProductInfo' => $customerProductInfo,
//            'memberNameList' => $memberNameList,
//            'discount_amount' => $customerOrder->discount_amount,
//            'currency_rate' => $customerOrder->currency_rate,
//            'customer_name' => $customerOrder->customer_name
//        ];
//        $orderNo = $customerOrder->order_no;
//        $insuranceCurrency = $customerOrder->currency;
//        $discountAmount = $customerOrder->discount_amount;
//        $currencyRate = $customerOrder->currency_rate;
//        $customerName = $customerOrder->customer_name;
//        $travelInvoice = TravelInsuranceInvoice::create([
//            'user_id'                  => $userDetails['user_id'],
//            'order_id'                 => $orderNo,
//            'vendor_id'                => $customerProduct['vendor_id'],
//            'vendor_name'              => $customerProduct['vendor_name'],
//            'purpose_your_visit'       => $customerProduct['purpose_your_visit'],
//            'sub_country_type'         => $customerProduct['sub_category'],
//            'country_to_travel'        => $customerProduct['country_to_travel'],
//            'insurance_covered'        => $customerProduct['insurance_covered_id'] == 1 ? 'Individual' : 'Group',
//            'insurance_people_covered' => $customerProduct['insurance_covered'],
//            'travel_type'              => $customerProduct['travel_type'] == 1 ? 'Single' : 'Multiple',
//            'start_date'               => Carbon::parse($customerProduct['start_date'])->format('Y-m-d'),
//            'end_date'                 => Carbon::parse($customerProduct['end_date'])->format('Y-m-d'),
//            'stay_days'                => $customerProduct['stay_days'],
//            'country_list'             => $customerProduct['country_list'],
//            'member_list'              => json_encode($memberList),
//            'home_address'             => $userDetails['home_address'],
//            'home_city'                => $userDetails['home_city'],
//            'home_area'                => $userDetails['home_area'],
//            'delivery_address'         => $userDetails['delivery_address'],
//            'delivery_city'            => $userDetails['delivery_city'],
//            'delivery_area'            => $userDetails['delivery_area'],
//        ]);
//
//        // SMS Send
//        $customerPhone = trim($userDetails['user_mobile']);
//        $customerPhone = '88'.$customerPhone;
//        $textMsg = "Dear " . (Auth::user()->full_name_en != null ? Auth::user()->full_name_en : 'customer') . "\n" . "Your Travel Insurance Order ID: " . $orderNo . " has been placed successfully at Surokkha. Please check email for invoice & other documents.";
//        $curl = curl_init();
//        curl_setopt_array($curl, array( CURLOPT_RETURNTRANSFER => 1, CURLOPT_URL =>
//            'http://sms.sslwireless.com/pushapi/dynamic/server.php?user=Ezy_fintech&pass=v>73F041&sid=SurokkhaENG&sms='.urlencode($textMsg).'&msisdn='.$customerPhone.'&csmsid=123456789', CURLOPT_USERAGENT => 'Sample cURL Request' ));
//        $resp = curl_exec($curl);
//        curl_close($curl);
//        return $orderNo;
//    }

    public function getToken()
    {
        session()->forget('bkash_token');

        $post_token = array(
            'app_key' => env('BKASH_APP_KEY'),
            'app_secret' => env('BKASH_APP_SECRET')
        );

//        $url = curl_init("$this->base_url/checkout/token/grant");
        $url = curl_init(env('BKASH_GRANT_URL'));
        $post_token = json_encode($post_token);
        $header = array(
            'Content-Type:application/json',
            'username:' . env('BKASH_USER_NAME'),
            'password:' . env('BKASH_USER_PASSWORD')
        );

        curl_setopt($url, CURLOPT_HTTPHEADER, $header);
        curl_setopt($url, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($url, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($url, CURLOPT_POSTFIELDS, $post_token);
        curl_setopt($url, CURLOPT_FOLLOWLOCATION, 1);
        $resultdata = curl_exec($url);
        curl_close($url);

        $response = json_decode($resultdata, true);

        if (array_key_exists('msg', $response)) {
            return $response;
        }

//        session()->put('bkash_token', $response['id_token']);
        return $response['id_token'];
//        return response()->json(['success', true]);
    }

    public function createPayment()
    {
        $auth = $this->getToken();
        logger(json_encode($auth));
//        die();

        $callbackURL='fb.com';

        $requestbody = array(
            'mode' => '0011',
            'amount' => '10',
            'currency' => 'BDT',
            'intent' => 'sale',
            'payerReference' => '01770618575',
            'merchantInvoiceNumber' => 'commonPayment001',
            'callbackURL' => $callbackURL
        );
        logger($requestbody);
//        die();
//        http://www.bkashcluster.com:9080/dreamwave/merchant/trxcheck/sendmsg
        $url = curl_init('https://sandbox.bka.sh/v1.2.0-beta/tokenized/checkout/create');
//        $url = curl_init(env('BKASH_CREATE_URL'));
        $requestbodyJson = json_encode($requestbody);
//        logger($url);
//        die();
        $header = array(
            'Content-Type:application/json',
            'Authorization:' . $auth,
            'X-APP-Key:'. env('BKASH_APP_KEY'),
            'username:' . env('BKASH_USER_NAME'),
            'password:' . env('BKASH_USER_PASSWORD'),
        );

        curl_setopt($url, CURLOPT_HTTPHEADER, $header);
        curl_setopt($url, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($url, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($url, CURLOPT_POSTFIELDS, $requestbodyJson);
        curl_setopt($url, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($url, CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V4);
        $resultdata = curl_exec($url);
        curl_close($url);
        echo $resultdata;

        $obj = json_decode($resultdata);
        logger(json_encode($obj));
        die();

        header("Location: " . $obj->{'bkashURL'});

    }

}
