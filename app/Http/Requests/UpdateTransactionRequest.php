<?php

namespace App\Http\Requests;

use App\Models\Transaction;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateTransactionRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('transaction_edit');
    }

    public function rules()
    {
        return [
            'cust_id_no' => [
                'string',
                'required',
                'unique:transactions,cust_id_no,' . request()->route('transaction')->id,
            ],
            'cust_name' => [
                'string',
                'required',
            ],
            'cust_mobo_no' => [
                'string',
                'required',
            ],
            'cust_mail_addr' => [
                'string',
                'nullable',
            ],
            'merchant_trnx_id_no' => [
                'string',
                'required',
                'unique:transactions,merchant_trnx_id_no,' . request()->route('transaction')->id,
            ],
            'merchant_trnx_amt' => [
                'string',
                'required',
            ],
            'trnx_currency' => [
                'required',
            ],
            'merchant_ord_id_no' => [
                'string',
                'nullable',
            ],
            'company_id' => [
                'required',
                'integer',
            ],
        ];
    }
}
