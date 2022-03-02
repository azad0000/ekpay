@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.settlement.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.settlements.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.settlement.fields.id') }}
                        </th>
                        <td>
                            {{ $settlement->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.settlement.fields.company') }}
                        </th>
                        <td>
                            {{ $settlement->company->shortname ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.settlement.fields.transaction') }}
                        </th>
                        <td>
                            @foreach($settlement->transactions as $key => $transaction)
                                <span class="label label-info">{{ $transaction->merchant_trnx_id_no }}</span>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.settlement.fields.total_pabl_amount') }}
                        </th>
                        <td>
                            {{ $settlement->total_pabl_amount }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.settlement.fields.total_paid_amount') }}
                        </th>
                        <td>
                            {{ $settlement->total_paid_amount }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.settlement.fields.paid_by') }}
                        </th>
                        <td>
                            {{ $settlement->paid_by }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.settlement.fields.payment_medium') }}
                        </th>
                        <td>
                            {{ $settlement->payment_medium }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.settlement.fields.payment_ref') }}
                        </th>
                        <td>
                            {{ $settlement->payment_ref }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.settlement.fields.attachments') }}
                        </th>
                        <td>
                            @foreach($settlement->attachments as $key => $media)
                                <a href="{{ $media->getUrl() }}" target="_blank">
                                    {{ trans('global.view_file') }}
                                </a>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.settlement.fields.status') }}
                        </th>
                        <td>
                            {{ App\Models\Settlement::STATUS_SELECT[$settlement->status] ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.settlements.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection