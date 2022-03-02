<?php

namespace App\Http\Requests;

use App\Models\Ipn;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyIpnRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('ipn_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:ipns,id',
        ];
    }
}
