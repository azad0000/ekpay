<?php

namespace App\Http\Requests;

use App\Models\General;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateGeneralRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('general_edit');
    }

    public function rules()
    {
        return [
            'mer_reg_id_no' => [
                'string',
                'required',
                'unique:generals,mer_reg_id_no,' . request()->route('general')->id,
            ],
            'mer_pas_key' => [
                'string',
                'required',
            ],
            'ekpay_dev_uri' => [
                'string',
                'required',
            ],
            'ekpay_prod_uri' => [
                'string',
                'required',
            ],
            'test_mode',
            's_uri' => [
                'string',
                'required',
            ],
            'f_uri' => [
                'string',
                'required',
            ],
            'c_uri' => [
                'string',
                'required',
            ],
            'ipn_uri' => [
                'string',
                'required',
            ],
            'mac_addr' => [
                'string',
                'required',
            ],
            'ipn_channel' => [
                'required',
            ],
            'ipn_email' => [
                'required',
            ],
        ];
    }
}
