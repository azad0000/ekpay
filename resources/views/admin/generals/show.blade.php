@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.general.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.generals.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.general.fields.id') }}
                        </th>
                        <td>
                            {{ $general->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.general.fields.mer_reg_id_no') }}
                        </th>
                        <td>
                            {{ $general->mer_reg_id_no }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.general.fields.mer_pas_key') }}
                        </th>
                        <td>
                            {{ $general->mer_pas_key }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.general.fields.ekpay_dev_uri') }}
                        </th>
                        <td>
                            {{ $general->ekpay_dev_uri }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.general.fields.ekpay_prod_uri') }}
                        </th>
                        <td>
                            {{ $general->ekpay_prod_uri }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.general.fields.test_mode') }}
                        </th>
                        <td>
                            @if ($general->test_mode == 1)
                             <span class="bg-danger rounded p-1" style="font-size:10px;">Test Mode</span>
                            @else
                              <span class="bg-success rounded p-1" style="font-size:10px;">Dev Mode</span>  
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.general.fields.s_uri') }}
                        </th>
                        <td>
                            {{ $general->s_uri }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.general.fields.f_uri') }}
                        </th>
                        <td>
                            {{ $general->f_uri }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.general.fields.c_uri') }}
                        </th>
                        <td>
                            {{ $general->c_uri }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.general.fields.ipn_uri') }}
                        </th>
                        <td>
                            {{ $general->ipn_uri }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.general.fields.mac_addr') }}
                        </th>
                        <td>
                            {{ $general->mac_addr }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.general.fields.ipn_channel') }}
                        </th>
                        <td>
                            {{ App\Models\General::IPN_CHANNEL_SELECT[$general->ipn_channel] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.general.fields.ipn_email') }}
                        </th>
                        <td>
                            {{ $general->ipn_email }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.generals.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection