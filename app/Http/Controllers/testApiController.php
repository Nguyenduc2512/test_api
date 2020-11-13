<?php

namespace App\Http\Controllers;

use App\Models\OrdersModel;
use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Log;

class testApiController extends Controller
{
    public function index() {
        return view('test_api');
    }

    public function getListBank() {
        $client = new \GuzzleHttp\Client(['timeout' => 20.0]);
        $options['query']['jwt'] = TestAPI::getToken();


        $response = $client->request("GET", "https://api.baokim.vn/payment/api/v4/bpm/list", $options);
        $banks = json_decode($response->getBody()->getContents());
        $data = $banks->data;
        return view('show_bank', compact('data'));
    }

    public function sendOrder(Request $request) {
        $client = new \GuzzleHttp\Client(['timeout' => 20.0]);
        $options['query']['jwt'] = TestAPI::getToken();

        $payload['mrc_order_id'] = rand(1,99999999);
        $payload['total_amount'] = $request->total_amount;
        $payload['description'] = $request->description;
        $payload['url_success'] = $request->url_success;
        $payload['merchant_id'] = $request->merchant_id;
        $payload['url_detail'] = $request->url_detail;
        $payload['lang'] = "";
        $payload['bpm_id'] = $request->bpm_id;
        $payload['accept_bank'] = $request->accept_bank;
        $payload['accept_cc'] = $request->accept_cc;
        $payload['accept_qrpay'] = $request->accept_qrpay;
        $payload['accept_e_wallet'] = $request->accept_e_wallet;
        $payload['webhooks'] = $request->webhooks;
        $payload['customer_email'] = $request->customer_email;
        $payload['customer_phone'] = $request->customer_phone;
        $payload['customer_name'] = $request->customer_name;
        $payload['customer_address'] = $request->customer_address;
        $options['form_params'] = $payload;

        $response = $client->request("POST", "https://api.baokim.vn/payment/api/v4/order/send", $options);
        $data = json_decode($response->getBody()->getContents());
        return redirect($data->data->payment_url);

    }
    public function success() {
        return view('success');
    }
    public function detail() {
        return view('detail');
    }

    public function webhookNotification(){
        $jsonWebhookData = '{"order":{order data},"txn":{txn data},"sign":"baokim sign"}';
        $webhookData = json_decode($jsonWebhookData, true);

        //Get và remove trường sign ra khỏi dữ liệu
        $baokimSign = $webhookData['sign'];
        unset($webhookData['sign']);

        //Chuyển dữ liệu đã remove sign về lại dạng json và sử dụng thuật toán hash sha256 để tạo signature với secret key
        $signData = json_encode($webhookData);
        $secret = TestAPI::API_SECRET;
        $mySign = hash_hmac('sha256', $signData, $secret);

        //So sánh chữ ký bạn tạo ra với chữ ký bảo kim gửi sang, nếu khớp thì verify thành công
        if($baokimSign == $mySign){
            Log::error('signature success');
        }else {
            echo "Signature is invalid";
        }
    }
}
