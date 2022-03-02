@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.transaction.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.transactions.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="cust_id_no">{{ trans('cruds.transaction.fields.cust_id_no') }}</label>
                <input class="form-control {{ $errors->has('cust_id_no') ? 'is-invalid' : '' }}" type="text" name="cust_id_no" id="cust_id_no" value="{{ old('cust_id_no', '') }}" required>
                @if($errors->has('cust_id_no'))
                    <div class="invalid-feedback">
                        {{ $errors->first('cust_id_no') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.transaction.fields.cust_id_no_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="cust_name">{{ trans('cruds.transaction.fields.cust_name') }}</label>
                <input class="form-control {{ $errors->has('cust_name') ? 'is-invalid' : '' }}" type="text" name="cust_name" id="cust_name" value="{{ old('cust_name', '') }}" required>
                @if($errors->has('cust_name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('cust_name') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.transaction.fields.cust_name_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="cust_mobo_no">{{ trans('cruds.transaction.fields.cust_mobo_no') }}</label>
                <input class="form-control {{ $errors->has('cust_mobo_no') ? 'is-invalid' : '' }}" type="text" name="cust_mobo_no" id="cust_mobo_no" value="{{ old('cust_mobo_no', '') }}" required>
                @if($errors->has('cust_mobo_no'))
                    <div class="invalid-feedback">
                        {{ $errors->first('cust_mobo_no') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.transaction.fields.cust_mobo_no_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="cust_email">{{ trans('cruds.transaction.fields.cust_email') }}</label>
                <input class="form-control {{ $errors->has('cust_email') ? 'is-invalid' : '' }}" type="email" name="cust_email" id="cust_email" value="{{ old('cust_email') }}">
                @if($errors->has('cust_email'))
                    <div class="invalid-feedback">
                        {{ $errors->first('cust_email') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.transaction.fields.cust_email_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="cust_mail_addr">{{ trans('cruds.transaction.fields.cust_mail_addr') }}</label>
                <input class="form-control {{ $errors->has('cust_mail_addr') ? 'is-invalid' : '' }}" type="text" name="cust_mail_addr" id="cust_mail_addr" value="{{ old('cust_mail_addr', '') }}">
                @if($errors->has('cust_mail_addr'))
                    <div class="invalid-feedback">
                        {{ $errors->first('cust_mail_addr') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.transaction.fields.cust_mail_addr_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="merchant_trnx_id_no">{{ trans('cruds.transaction.fields.merchant_trnx_id_no') }}</label>
                <input class="form-control {{ $errors->has('merchant_trnx_id_no') ? 'is-invalid' : '' }}" type="text" name="merchant_trnx_id_no" id="merchant_trnx_id_no" value="{{ old('merchant_trnx_id_no', '') }}" required>
                @if($errors->has('merchant_trnx_id_no'))
                    <div class="invalid-feedback">
                        {{ $errors->first('merchant_trnx_id_no') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.transaction.fields.merchant_trnx_id_no_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="merchant_trnx_amt">{{ trans('cruds.transaction.fields.merchant_trnx_amt') }}</label>
                <input class="form-control {{ $errors->has('merchant_trnx_amt') ? 'is-invalid' : '' }}" type="text" name="merchant_trnx_amt" id="merchant_trnx_amt" value="{{ old('merchant_trnx_amt', '') }}" required>
                @if($errors->has('merchant_trnx_amt'))
                    <div class="invalid-feedback">
                        {{ $errors->first('merchant_trnx_amt') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.transaction.fields.merchant_trnx_amt_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required">{{ trans('cruds.transaction.fields.trnx_currency') }}</label>
                @foreach(App\Models\Transaction::TRNX_CURRENCY_RADIO as $key => $label)
                    <div class="form-check {{ $errors->has('trnx_currency') ? 'is-invalid' : '' }}">
                        <input class="form-check-input" type="radio" id="trnx_currency_{{ $key }}" name="trnx_currency" value="{{ $key }}" {{ old('trnx_currency', 'BDT') === (string) $key ? 'checked' : '' }} required>
                        <label class="form-check-label" for="trnx_currency_{{ $key }}">{{ $label }}</label>
                    </div>
                @endforeach
                @if($errors->has('trnx_currency'))
                    <div class="invalid-feedback">
                        {{ $errors->first('trnx_currency') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.transaction.fields.trnx_currency_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="merchant_ord_id_no">{{ trans('cruds.transaction.fields.merchant_ord_id_no') }}</label>
                <input class="form-control {{ $errors->has('merchant_ord_id_no') ? 'is-invalid' : '' }}" type="text" name="merchant_ord_id_no" id="merchant_ord_id_no" value="{{ old('merchant_ord_id_no', '') }}">
                @if($errors->has('merchant_ord_id_no'))
                    <div class="invalid-feedback">
                        {{ $errors->first('merchant_ord_id_no') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.transaction.fields.merchant_ord_id_no_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="merchant_ord_det">{{ trans('cruds.transaction.fields.merchant_ord_det') }}</label>
                <textarea class="form-control {{ $errors->has('merchant_ord_det') ? 'is-invalid' : '' }}" name="merchant_ord_det" id="merchant_ord_det">{{ old('merchant_ord_det') }}</textarea>
                @if($errors->has('merchant_ord_det'))
                    <div class="invalid-feedback">
                        {{ $errors->first('merchant_ord_det') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.transaction.fields.merchant_ord_det_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="company_id">{{ trans('cruds.transaction.fields.company') }}</label>
                <select class="form-control select2 {{ $errors->has('company') ? 'is-invalid' : '' }}" name="company_id" id="company_id" required>
                    @foreach($companies as $id => $entry)
                        <option value="{{ $id }}" {{ old('company_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('company'))
                    <div class="invalid-feedback">
                        {{ $errors->first('company') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.transaction.fields.company_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="secure_token">{{ trans('cruds.transaction.fields.secure_token') }}</label>
                <input class="form-control {{ $errors->has('secure_token') ? 'is-invalid' : '' }}" type="text" name="secure_token" id="secure_token" value="{{ old('secure_token', '') }}">
                @if($errors->has('secure_token'))
                    <div class="invalid-feedback">
                        {{ $errors->first('secure_token') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.transaction.fields.secure_token_helper') }}</span>
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