<?php

namespace App\Http\Controllers;

use App\Models\General;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Http;

use Illuminate\Support\Str;

date_default_timezone_set('Asia/Dhaka');

class TesekPayApi extends Controller
{
    public function makePayment($txId){

        $txId = Str::of($txId)->replace('-', ' ');
        $transaction = Transaction::where('merchant_trnx_id_no', $txId)->first();

        if(empty($transaction)){
            abort(404);
        }

        $setting = General::first();

        //Merchant Info
        $mer_reg_id = $setting->mer_reg_id_no;
        $mer_pas_key = $setting->mer_pas_key;

        //Feed Uri
        $s_uri = $setting->s_uri;
        $f_uri = $setting->f_uri;
        $c_uri = $setting->c_uri;

        //Customer Info
        $cust_id = $transaction->cust_id_no;
        $cust_name = $transaction->cust_name;
        $cust_mobo_no = $transaction->cust_mobo_no;
        $cust_email = $transaction->cust_email ;
        $cust_mail_addr = $transaction->cust_mail_addr;

        //Transaction Info
        $trnx_id = $transaction->merchant_trnx_id_no;
        $trnx_amt = $transaction->merchant_trnx_amt;
        $trnx_currency=$transaction->trnx_currency;
        $ord_id = $transaction->merchant_ord_id_no;
        $ord_det = $transaction->merchant_ord_det;

        //IPN info
        $ipn_channel = $setting->ipn_channel;
        $ipn_email = $setting->ipn_email;
        $ipn_uri = $setting->ipn_uri;

        $mac_addr = $setting->mac_addr;

        $timestamp = Carbon::now()->format('Y-m-d H:i:s');

        $timestamp = $timestamp. ' GMT+6';

        if($setting->test_mode){
            $api_endpoint = $setting->ekpay_dev_uri;
        }else{
            $api_endpoint = $setting->ekpay_prod_uri;
        }

        //API
        $data = [
            "mer_info"=>[
                'mer_reg_id'=>$mer_reg_id,
                'mer_pas_key'=>$mer_pas_key
            ],
            "req_timestamp"=>$timestamp,
            "feed_uri"=>[
                "s_uri"=>$s_uri,
                "f_uri"=>$f_uri,
                "c_uri"=>$c_uri
            ],
            "cust_info"=>[
                "cust_id"=>$cust_id,
                "cust_name"=>$cust_name,
                "cust_mobo_no"=>$cust_mobo_no,
                "cust_email"=>$cust_email,
                "cust_mail_addr"=>$cust_mail_addr
            ],
            "trns_info"=>[
                "trnx_id"=>$trnx_id,
                "trnx_amt"=>$trnx_amt,
                "trnx_currency"=>$trnx_currency,
                "ord_id"=>$ord_id,
                "ord_det"=>$ord_det
            ],
            "ipn_info"=>[
                "ipn_channel"=>$ipn_channel,
                "ipn_email"=>$ipn_email,
                "ipn_uri"=>$ipn_uri
            ],
            "mac_addr"=>$mac_addr
        ];


        //  $response = Http::withBody(json_encode($data))->post($api_endpoint);

         return $response = Http::post($api_endpoint, $data);
    }
}
