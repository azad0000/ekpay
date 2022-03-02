<?php

namespace App\Http\Requests;

use App\Models\Settlement;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreSettlementRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('settlement_create');
    }

    public function rules()
    {
        return [
            'company_id' => [
                'required',
                'integer',
            ],
            'transactions.*' => [
                'integer',
            ],
            'transactions' => [
                'required',
                'array',
            ],
            'total_pabl_amount' => [
                'string',
                'required',
            ],
            'total_paid_amount' => [
                'string',
                'required',
            ],
            'paid_by' => [
                'string',
                'required',
            ],
            'payment_medium' => [
                'string',
                'required',
            ],
            'attachments' => [
                'array',
            ],
            'status' => [
                'required',
            ],
        ];
    }
}
