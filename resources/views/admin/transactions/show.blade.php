@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.transaction.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.transactions.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.transaction.fields.id') }}
                        </th>
                        <td>
                            {{ $transaction->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.transaction.fields.cust_id_no') }}
                        </th>
                        <td>
                            {{ $transaction->cust_id_no }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.transaction.fields.cust_name') }}
                        </th>
                        <td>
                            {{ $transaction->cust_name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.transaction.fields.cust_mobo_no') }}
                        </th>
                        <td>
                            {{ $transaction->cust_mobo_no }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.transaction.fields.cust_email') }}
                        </th>
                        <td>
                            {{ $transaction->cust_email }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.transaction.fields.cust_mail_addr') }}
                        </th>
                        <td>
                            {{ $transaction->cust_mail_addr }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.transaction.fields.merchant_trnx_id_no') }}
                        </th>
                        <td>
                            {{ $transaction->merchant_trnx_id_no }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.transaction.fields.merchant_trnx_amt') }}
                        </th>
                        <td>
                            {{ $transaction->merchant_trnx_amt }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.transaction.fields.trnx_currency') }}
                        </th>
                        <td>
                            {{ App\Models\Transaction::TRNX_CURRENCY_RADIO[$transaction->trnx_currency] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.transaction.fields.merchant_ord_id_no') }}
                        </th>
                        <td>
                            {{ $transaction->merchant_ord_id_no }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.transaction.fields.merchant_ord_det') }}
                        </th>
                        <td>
                            {{ $transaction->merchant_ord_det }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.transaction.fields.company') }}
                        </th>
                        <td>
                            {{ $transaction->company->shortname ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.transaction.fields.payment_url') }}
                        </th>
                        <td>
                            {{ $transaction->payment_url }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.transaction.fields.secure_token') }}
                        </th>
                        <td>
                            {{ $transaction->secure_token }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.transactions.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection