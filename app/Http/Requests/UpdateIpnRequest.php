<?php

namespace App\Http\Requests;

use App\Models\Ipn;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateIpnRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('ipn_edit');
    }

    public function rules()
    {
        return [
            'txn_id_no_id' => [
                'required',
                'integer',
            ],
            'msg_code' => [
                'string',
                'required',
            ],
            'msg_det' => [
                'required',
            ],
            'req_timestamp' => [
                'required',
                'date_format:' . config('panel.date_format') . ' ' . config('panel.time_format'),
            ],
            'dgtl_sign' => [
                'string',
                'nullable',
            ],
            'remarks' => [
                'string',
                'nullable',
            ],
            'ekpay_txn_id_no' => [
                'string',
                'required',
                'unique:ipns,ekpay_txn_id_no,' . request()->route('ipn')->id,
            ],
            'pi_trnx_id_no' => [
                'string',
                'nullable',
            ],
            'pi_charge' => [
                'string',
                'required',
            ],
            'ekpay_charge' => [
                'string',
                'required',
            ],
            'pi_discount' => [
                'string',
                'required',
            ],
            'total_ser_charge' => [
                'string',
                'required',
            ],
            'ekpay_charge_discount' => [
                'string',
                'required',
            ],
            'promo_discount' => [
                'string',
                'required',
            ],
            'total_pabl_amt' => [
                'string',
                'required',
            ],
            'pay_timestamp' => [
                'required',
                'date_format:' . config('panel.date_format') . ' ' . config('panel.time_format'),
            ],
            'pi_name' => [
                'string',
                'nullable',
            ],
            'pi_type' => [
                'string',
                'nullable',
            ],
            'pi_number' => [
                'string',
                'nullable',
            ],
            'pi_gateway' => [
                'string',
                'nullable',
            ],
            'is_settled' => [
                'required',
            ],
            'settlement' => [
                'string',
                'nullable',
            ],
        ];
    }
}
