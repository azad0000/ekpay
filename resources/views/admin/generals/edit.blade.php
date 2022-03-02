@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.general.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.generals.update", [$general->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="mer_reg_id_no">{{ trans('cruds.general.fields.mer_reg_id_no') }}</label>
                <input class="form-control {{ $errors->has('mer_reg_id_no') ? 'is-invalid' : '' }}" type="text" name="mer_reg_id_no" id="mer_reg_id_no" value="{{ old('mer_reg_id_no', $general->mer_reg_id_no) }}" required>
                @if($errors->has('mer_reg_id_no'))
                    <div class="invalid-feedback">
                        {{ $errors->first('mer_reg_id_no') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.general.fields.mer_reg_id_no_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="mer_pas_key">{{ trans('cruds.general.fields.mer_pas_key') }}</label>
                <input class="form-control {{ $errors->has('mer_pas_key') ? 'is-invalid' : '' }}" type="text" name="mer_pas_key" id="mer_pas_key" value="{{ old('mer_pas_key', $general->mer_pas_key) }}" required>
                @if($errors->has('mer_pas_key'))
                    <div class="invalid-feedback">
                        {{ $errors->first('mer_pas_key') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.general.fields.mer_pas_key_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="ekpay_dev_uri">{{ trans('cruds.general.fields.ekpay_dev_uri') }}</label>
                <input class="form-control {{ $errors->has('ekpay_dev_uri') ? 'is-invalid' : '' }}" type="text" name="ekpay_dev_uri" id="ekpay_dev_uri" value="{{ old('ekpay_dev_uri', $general->ekpay_dev_uri) }}" required>
                @if($errors->has('ekpay_dev_uri'))
                    <div class="invalid-feedback">
                        {{ $errors->first('ekpay_dev_uri') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.general.fields.ekpay_dev_uri_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="ekpay_prod_uri">{{ trans('cruds.general.fields.ekpay_prod_uri') }}</label>
                <input class="form-control {{ $errors->has('ekpay_prod_uri') ? 'is-invalid' : '' }}" type="text" name="ekpay_prod_uri" id="ekpay_prod_uri" value="{{ old('ekpay_prod_uri', $general->ekpay_prod_uri) }}" required>
                @if($errors->has('ekpay_prod_uri'))
                    <div class="invalid-feedback">
                        {{ $errors->first('ekpay_prod_uri') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.general.fields.ekpay_prod_uri_helper') }}</span>
            </div>
            <div class="form-group">
                <div class="form-check {{ $errors->has('test_mode') ? 'is-invalid' : '' }}">
                    <input class="form-check-input" type="checkbox" name="test_mode" id="test_mode" value="1" {{ $general->test_mode || old('test_mode', 0) === 1 ? 'checked' : '' }}>
                    <label class="form-check-label" for="test_mode">{{ trans('cruds.general.fields.test_mode') }}</label>
                </div>
                @if($errors->has('test_mode'))
                    <div class="invalid-feedback">
                        {{ $errors->first('test_mode') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.general.fields.test_mode_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="s_uri">{{ trans('cruds.general.fields.s_uri') }}</label>
                <input class="form-control {{ $errors->has('s_uri') ? 'is-invalid' : '' }}" type="text" name="s_uri" id="s_uri" value="{{ old('s_uri', $general->s_uri) }}" required>
                @if($errors->has('s_uri'))
                    <div class="invalid-feedback">
                        {{ $errors->first('s_uri') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.general.fields.s_uri_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="f_uri">{{ trans('cruds.general.fields.f_uri') }}</label>
                <input class="form-control {{ $errors->has('f_uri') ? 'is-invalid' : '' }}" type="text" name="f_uri" id="f_uri" value="{{ old('f_uri', $general->f_uri) }}" required>
                @if($errors->has('f_uri'))
                    <div class="invalid-feedback">
                        {{ $errors->first('f_uri') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.general.fields.f_uri_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="c_uri">{{ trans('cruds.general.fields.c_uri') }}</label>
                <input class="form-control {{ $errors->has('c_uri') ? 'is-invalid' : '' }}" type="text" name="c_uri" id="c_uri" value="{{ old('c_uri', $general->c_uri) }}" required>
                @if($errors->has('c_uri'))
                    <div class="invalid-feedback">
                        {{ $errors->first('c_uri') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.general.fields.c_uri_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="ipn_uri">{{ trans('cruds.general.fields.ipn_uri') }}</label>
                <input class="form-control {{ $errors->has('ipn_uri') ? 'is-invalid' : '' }}" type="text" name="ipn_uri" id="ipn_uri" value="{{ old('ipn_uri', $general->ipn_uri) }}" required>
                @if($errors->has('ipn_uri'))
                    <div class="invalid-feedback">
                        {{ $errors->first('ipn_uri') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.general.fields.ipn_uri_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="mac_addr">{{ trans('cruds.general.fields.mac_addr') }}</label>
                <input class="form-control {{ $errors->has('mac_addr') ? 'is-invalid' : '' }}" type="text" name="mac_addr" id="mac_addr" value="{{ old('mac_addr', $general->mac_addr) }}" required>
                @if($errors->has('mac_addr'))
                    <div class="invalid-feedback">
                        {{ $errors->first('mac_addr') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.general.fields.mac_addr_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required">{{ trans('cruds.general.fields.ipn_channel') }}</label>
                <select class="form-control {{ $errors->has('ipn_channel') ? 'is-invalid' : '' }}" name="ipn_channel" id="ipn_channel" required>
                    <option value disabled {{ old('ipn_channel', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\General::IPN_CHANNEL_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('ipn_channel', $general->ipn_channel) === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('ipn_channel'))
                    <div class="invalid-feedback">
                        {{ $errors->first('ipn_channel') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.general.fields.ipn_channel_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="ipn_email">{{ trans('cruds.general.fields.ipn_email') }}</label>
                <input class="form-control {{ $errors->has('ipn_email') ? 'is-invalid' : '' }}" type="email" name="ipn_email" id="ipn_email" value="{{ old('ipn_email', $general->ipn_email) }}" required>
                @if($errors->has('ipn_email'))
                    <div class="invalid-feedback">
                        {{ $errors->first('ipn_email') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.general.fields.ipn_email_helper') }}</span>
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