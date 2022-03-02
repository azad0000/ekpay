@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.ipn.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.ipns.update", [$ipn->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="txn_id_no_id">{{ trans('cruds.ipn.fields.txn_id_no') }}</label>
                <select class="form-control select2 {{ $errors->has('txn_id_no') ? 'is-invalid' : '' }}" name="txn_id_no_id" id="txn_id_no_id" required>
                    @foreach($txn_id_nos as $id => $entry)
                        <option value="{{ $id }}" {{ (old('txn_id_no_id') ? old('txn_id_no_id') : $ipn->txn_id_no->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('txn_id_no'))
                    <div class="invalid-feedback">
                        {{ $errors->first('txn_id_no') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.ipn.fields.txn_id_no_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="msg_code">{{ trans('cruds.ipn.fields.msg_code') }}</label>
                <input class="form-control {{ $errors->has('msg_code') ? 'is-invalid' : '' }}" type="text" name="msg_code" id="msg_code" value="{{ old('msg_code', $ipn->msg_code) }}" required>
                @if($errors->has('msg_code'))
                    <div class="invalid-feedback">
                        {{ $errors->first('msg_code') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.ipn.fields.msg_code_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="msg_det">{{ trans('cruds.ipn.fields.msg_det') }}</label>
                <textarea class="form-control {{ $errors->has('msg_det') ? 'is-invalid' : '' }}" name="msg_det" id="msg_det" required>{{ old('msg_det', $ipn->msg_det) }}</textarea>
                @if($errors->has('msg_det'))
                    <div class="invalid-feedback">
                        {{ $errors->first('msg_det') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.ipn.fields.msg_det_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="req_timestamp">{{ trans('cruds.ipn.fields.req_timestamp') }}</label>
                <input class="form-control datetime {{ $errors->has('req_timestamp') ? 'is-invalid' : '' }}" type="text" name="req_timestamp" id="req_timestamp" value="{{ old('req_timestamp', $ipn->req_timestamp) }}" required>
                @if($errors->has('req_timestamp'))
                    <div class="invalid-feedback">
                        {{ $errors->first('req_timestamp') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.ipn.fields.req_timestamp_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="dgtl_sign">{{ trans('cruds.ipn.fields.dgtl_sign') }}</label>
                <input class="form-control {{ $errors->has('dgtl_sign') ? 'is-invalid' : '' }}" type="text" name="dgtl_sign" id="dgtl_sign" value="{{ old('dgtl_sign', $ipn->dgtl_sign) }}">
                @if($errors->has('dgtl_sign'))
                    <div class="invalid-feedback">
                        {{ $errors->first('dgtl_sign') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.ipn.fields.dgtl_sign_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="remarks">{{ trans('cruds.ipn.fields.remarks') }}</label>
                <input class="form-control {{ $errors->has('remarks') ? 'is-invalid' : '' }}" type="text" name="remarks" id="remarks" value="{{ old('remarks', $ipn->remarks) }}">
                @if($errors->has('remarks'))
                    <div class="invalid-feedback">
                        {{ $errors->first('remarks') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.ipn.fields.remarks_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="ekpay_txn_id_no">{{ trans('cruds.ipn.fields.ekpay_txn_id_no') }}</label>
                <input class="form-control {{ $errors->has('ekpay_txn_id_no') ? 'is-invalid' : '' }}" type="text" name="ekpay_txn_id_no" id="ekpay_txn_id_no" value="{{ old('ekpay_txn_id_no', $ipn->ekpay_txn_id_no) }}" required>
                @if($errors->has('ekpay_txn_id_no'))
                    <div class="invalid-feedback">
                        {{ $errors->first('ekpay_txn_id_no') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.ipn.fields.ekpay_txn_id_no_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="pi_trnx_id_no">{{ trans('cruds.ipn.fields.pi_trnx_id_no') }}</label>
                <input class="form-control {{ $errors->has('pi_trnx_id_no') ? 'is-invalid' : '' }}" type="text" name="pi_trnx_id_no" id="pi_trnx_id_no" value="{{ old('pi_trnx_id_no', $ipn->pi_trnx_id_no) }}">
                @if($errors->has('pi_trnx_id_no'))
                    <div class="invalid-feedback">
                        {{ $errors->first('pi_trnx_id_no') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.ipn.fields.pi_trnx_id_no_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="pi_charge">{{ trans('cruds.ipn.fields.pi_charge') }}</label>
                <input class="form-control {{ $errors->has('pi_charge') ? 'is-invalid' : '' }}" type="text" name="pi_charge" id="pi_charge" value="{{ old('pi_charge', $ipn->pi_charge) }}" required>
                @if($errors->has('pi_charge'))
                    <div class="invalid-feedback">
                        {{ $errors->first('pi_charge') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.ipn.fields.pi_charge_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="ekpay_charge">{{ trans('cruds.ipn.fields.ekpay_charge') }}</label>
                <input class="form-control {{ $errors->has('ekpay_charge') ? 'is-invalid' : '' }}" type="text" name="ekpay_charge" id="ekpay_charge" value="{{ old('ekpay_charge', $ipn->ekpay_charge) }}" required>
                @if($errors->has('ekpay_charge'))
                    <div class="invalid-feedback">
                        {{ $errors->first('ekpay_charge') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.ipn.fields.ekpay_charge_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="pi_discount">{{ trans('cruds.ipn.fields.pi_discount') }}</label>
                <input class="form-control {{ $errors->has('pi_discount') ? 'is-invalid' : '' }}" type="text" name="pi_discount" id="pi_discount" value="{{ old('pi_discount', $ipn->pi_discount) }}" required>
                @if($errors->has('pi_discount'))
                    <div class="invalid-feedback">
                        {{ $errors->first('pi_discount') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.ipn.fields.pi_discount_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="total_ser_charge">{{ trans('cruds.ipn.fields.total_ser_charge') }}</label>
                <input class="form-control {{ $errors->has('total_ser_charge') ? 'is-invalid' : '' }}" type="text" name="total_ser_charge" id="total_ser_charge" value="{{ old('total_ser_charge', $ipn->total_ser_charge) }}" required>
                @if($errors->has('total_ser_charge'))
                    <div class="invalid-feedback">
                        {{ $errors->first('total_ser_charge') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.ipn.fields.total_ser_charge_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="ekpay_charge_discount">{{ trans('cruds.ipn.fields.ekpay_charge_discount') }}</label>
                <input class="form-control {{ $errors->has('ekpay_charge_discount') ? 'is-invalid' : '' }}" type="text" name="ekpay_charge_discount" id="ekpay_charge_discount" value="{{ old('ekpay_charge_discount', $ipn->ekpay_charge_discount) }}" required>
                @if($errors->has('ekpay_charge_discount'))
                    <div class="invalid-feedback">
                        {{ $errors->first('ekpay_charge_discount') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.ipn.fields.ekpay_charge_discount_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="promo_discount">{{ trans('cruds.ipn.fields.promo_discount') }}</label>
                <input class="form-control {{ $errors->has('promo_discount') ? 'is-invalid' : '' }}" type="text" name="promo_discount" id="promo_discount" value="{{ old('promo_discount', $ipn->promo_discount) }}" required>
                @if($errors->has('promo_discount'))
                    <div class="invalid-feedback">
                        {{ $errors->first('promo_discount') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.ipn.fields.promo_discount_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="total_pabl_amt">{{ trans('cruds.ipn.fields.total_pabl_amt') }}</label>
                <input class="form-control {{ $errors->has('total_pabl_amt') ? 'is-invalid' : '' }}" type="text" name="total_pabl_amt" id="total_pabl_amt" value="{{ old('total_pabl_amt', $ipn->total_pabl_amt) }}" required>
                @if($errors->has('total_pabl_amt'))
                    <div class="invalid-feedback">
                        {{ $errors->first('total_pabl_amt') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.ipn.fields.total_pabl_amt_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="pay_timestamp">{{ trans('cruds.ipn.fields.pay_timestamp') }}</label>
                <input class="form-control datetime {{ $errors->has('pay_timestamp') ? 'is-invalid' : '' }}" type="text" name="pay_timestamp" id="pay_timestamp" value="{{ old('pay_timestamp', $ipn->pay_timestamp) }}" required>
                @if($errors->has('pay_timestamp'))
                    <div class="invalid-feedback">
                        {{ $errors->first('pay_timestamp') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.ipn.fields.pay_timestamp_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="pi_name">{{ trans('cruds.ipn.fields.pi_name') }}</label>
                <input class="form-control {{ $errors->has('pi_name') ? 'is-invalid' : '' }}" type="text" name="pi_name" id="pi_name" value="{{ old('pi_name', $ipn->pi_name) }}">
                @if($errors->has('pi_name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('pi_name') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.ipn.fields.pi_name_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="pi_type">{{ trans('cruds.ipn.fields.pi_type') }}</label>
                <input class="form-control {{ $errors->has('pi_type') ? 'is-invalid' : '' }}" type="text" name="pi_type" id="pi_type" value="{{ old('pi_type', $ipn->pi_type) }}">
                @if($errors->has('pi_type'))
                    <div class="invalid-feedback">
                        {{ $errors->first('pi_type') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.ipn.fields.pi_type_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="pi_number">{{ trans('cruds.ipn.fields.pi_number') }}</label>
                <input class="form-control {{ $errors->has('pi_number') ? 'is-invalid' : '' }}" type="text" name="pi_number" id="pi_number" value="{{ old('pi_number', $ipn->pi_number) }}">
                @if($errors->has('pi_number'))
                    <div class="invalid-feedback">
                        {{ $errors->first('pi_number') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.ipn.fields.pi_number_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="pi_gateway">{{ trans('cruds.ipn.fields.pi_gateway') }}</label>
                <input class="form-control {{ $errors->has('pi_gateway') ? 'is-invalid' : '' }}" type="text" name="pi_gateway" id="pi_gateway" value="{{ old('pi_gateway', $ipn->pi_gateway) }}">
                @if($errors->has('pi_gateway'))
                    <div class="invalid-feedback">
                        {{ $errors->first('pi_gateway') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.ipn.fields.pi_gateway_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required">{{ trans('cruds.ipn.fields.is_settled') }}</label>
                @foreach(App\Models\Ipn::IS_SETTLED_RADIO as $key => $label)
                    <div class="form-check {{ $errors->has('is_settled') ? 'is-invalid' : '' }}">
                        <input class="form-check-input" type="radio" id="is_settled_{{ $key }}" name="is_settled" value="{{ $key }}" {{ old('is_settled', $ipn->is_settled) === (string) $key ? 'checked' : '' }} required>
                        <label class="form-check-label" for="is_settled_{{ $key }}">{{ $label }}</label>
                    </div>
                @endforeach
                @if($errors->has('is_settled'))
                    <div class="invalid-feedback">
                        {{ $errors->first('is_settled') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.ipn.fields.is_settled_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="settlement">{{ trans('cruds.ipn.fields.settlement') }}</label>
                <input class="form-control {{ $errors->has('settlement') ? 'is-invalid' : '' }}" type="text" name="settlement" id="settlement" value="{{ old('settlement', $ipn->settlement) }}">
                @if($errors->has('settlement'))
                    <div class="invalid-feedback">
                        {{ $errors->first('settlement') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.ipn.fields.settlement_helper') }}</span>
            </div>
            <div class="form-group">
                <button class="btn btn-danger" type="submit">
                    {{ trans('global.save') }}
                </button>
            </div>
        </form>
    </div>
</div>



@endsection