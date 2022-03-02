<?php

namespace App\Http\Requests;

use App\Models\Company;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreCompanyRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('company_create');
    }

    public function rules()
    {
        return [
            'name' => [
                'string',
                'required',
            ],
            'shortname' => [
                'string',
                'required',
                'unique:companies',
            ],
            'mer_reg' => [
                'string',
                'nullable',
            ],
            'mer_pas_key' => [
                'string',
                'nullable',
            ],
            'domain_url' => [
                'string',
                'nullable',
            ],
            's_uri' => [
                'string',
                'nullable',
            ],
            'f_uri' => [
                'string',
                'nullable',
            ],
            'c_uri' => [
                'string',
                'nullable',
            ],
            'ipn_channel' => [
                'required',
            ],
            'ipn_email' => [
                'string',
                'required',
                'unique:companies',
            ],
            'ipn_uri' => [
                'string',
                'nullable',
            ],
            'mac_addr' => [
                'string',
                'nullable',
            ],
            'active' => [
                'required',
            ],
            'has_ekpay_id_no' => [
                'nullable'
            ],
        ];
    }
}
