@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.ipn.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.ipns.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.ipn.fields.id') }}
                        </th>
                        <td>
                            {{ $ipn->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.ipn.fields.txn_id_no') }}
                        </th>
                        <td>
                            {{ $ipn->txn_id_no->merchant_trnx_id_no ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.ipn.fields.msg_code') }}
                        </th>
                        <td>
                            {{ $ipn->msg_code }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.ipn.fields.msg_det') }}
                        </th>
                        <td>
                            {{ $ipn->msg_det }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.ipn.fields.req_timestamp') }}
                        </th>
                        <td>
                            {{ $ipn->req_timestamp }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.ipn.fields.dgtl_sign') }}
                        </th>
                        <td>
                            {{ $ipn->dgtl_sign }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.ipn.fields.remarks') }}
                        </th>
                        <td>
                            {{ $ipn->remarks }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.ipn.fields.ekpay_txn_id_no') }}
                        </th>
                        <td>
                            {{ $ipn->ekpay_txn_id_no }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.ipn.fields.pi_trnx_id_no') }}
                        </th>
                        <td>
                            {{ $ipn->pi_trnx_id_no }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.ipn.fields.pi_charge') }}
                        </th>
                        <td>
                            {{ $ipn->pi_charge }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.ipn.fields.ekpay_charge') }}
                        </th>
                        <td>
                            {{ $ipn->ekpay_charge }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.ipn.fields.pi_discount') }}
                        </th>
                        <td>
                            {{ $ipn->pi_discount }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.ipn.fields.total_ser_charge') }}
                        </th>
                        <td>
                            {{ $ipn->total_ser_charge }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.ipn.fields.ekpay_charge_discount') }}
                        </th>
                        <td>
                            {{ $ipn->ekpay_charge_discount }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.ipn.fields.promo_discount') }}
                        </th>
                        <td>
                            {{ $ipn->promo_discount }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.ipn.fields.total_pabl_amt') }}
                        </th>
                        <td>
                            {{ $ipn->total_pabl_amt }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.ipn.fields.pay_timestamp') }}
                        </th>
                        <td>
                            {{ $ipn->pay_timestamp }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.ipn.fields.pi_name') }}
                        </th>
                        <td>
                            {{ $ipn->pi_name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.ipn.fields.pi_type') }}
                        </th>
                        <td>
                            {{ $ipn->pi_type }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.ipn.fields.pi_number') }}
                        </th>
                        <td>
                            {{ $ipn->pi_number }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.ipn.fields.pi_gateway') }}
                        </th>
                        <td>
                            {{ $ipn->pi_gateway }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.ipn.fields.is_settled') }}
                        </th>
                        <td>
                            {{ App\Models\Ipn::IS_SETTLED_RADIO[$ipn->is_settled] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.ipn.fields.settlement') }}
                        </th>
                        <td>
                            {{ $ipn->settlement }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.ipns.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection