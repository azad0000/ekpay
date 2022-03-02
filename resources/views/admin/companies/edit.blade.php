@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.company.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.companies.update", [$company->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="name">{{ trans('cruds.company.fields.name') }}</label>
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', $company->name) }}" required>
                @if($errors->has('name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('name') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.company.fields.name_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="shortname">{{ trans('cruds.company.fields.shortname') }}</label>
                <input class="form-control {{ $errors->has('shortname') ? 'is-invalid' : '' }}" type="text" name="shortname" id="shortname" value="{{ old('shortname', $company->shortname) }}" required>
                @if($errors->has('shortname'))
                    <div class="invalid-feedback">
                        {{ $errors->first('shortname') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.company.fields.shortname_helper') }}</span>
            </div>
            <div class="form-group">
                <div class="form-check {{ $errors->has('has_ekpay_id_no') ? 'is-invalid' : '' }}">
                    <input class="form-check-input" type="checkbox" name="has_ekpay_id_no" id="has_ekpay_id_no" value="1" {{ $company->has_ekpay_id_no || old('has_ekpay_id_no', 0) === 1 ? 'checked' : '' }}>
                    <label class="form-check-label" for="has_ekpay_id_no">{{ trans('cruds.company.fields.has_ekpay_id_no') }}</label>
                </div>
                @if($errors->has('has_ekpay_id_no'))
                    <div class="invalid-feedback">
                        {{ $errors->first('has_ekpay_id_no') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.company.fields.has_ekpay_id_no_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="mer_reg">{{ trans('cruds.company.fields.mer_reg') }}</label>
                <input class="form-control {{ $errors->has('mer_reg') ? 'is-invalid' : '' }}" type="text" name="mer_reg" id="mer_reg" value="{{ old('mer_reg', $company->mer_reg) }}">
                @if($errors->has('mer_reg'))
                    <div class="invalid-feedback">
                        {{ $errors->first('mer_reg') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.company.fields.mer_reg_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="mer_pas_key">{{ trans('cruds.company.fields.mer_pas_key') }}</label>
                <input class="form-control {{ $errors->has('mer_pas_key') ? 'is-invalid' : '' }}" type="text" name="mer_pas_key" id="mer_pas_key" value="{{ old('mer_pas_key', $company->mer_pas_key) }}">
                @if($errors->has('mer_pas_key'))
                    <div class="invalid-feedback">
                        {{ $errors->first('mer_pas_key') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.company.fields.mer_pas_key_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="domain_url">{{ trans('cruds.company.fields.domain_url') }}</label>
                <input class="form-control {{ $errors->has('domain_url') ? 'is-invalid' : '' }}" type="text" name="domain_url" id="domain_url" value="{{ old('domain_url', $company->domain_url) }}">
                @if($errors->has('domain_url'))
                    <div class="invalid-feedback">
                        {{ $errors->first('domain_url') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.company.fields.domain_url_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="s_uri">{{ trans('cruds.company.fields.s_uri') }}</label>
                <input class="form-control {{ $errors->has('s_uri') ? 'is-invalid' : '' }}" type="text" name="s_uri" id="s_uri" value="{{ old('s_uri', $company->s_uri) }}">
                @if($errors->has('s_uri'))
                    <div class="invalid-feedback">
                        {{ $errors->first('s_uri') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.company.fields.s_uri_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="f_uri">{{ trans('cruds.company.fields.f_uri') }}</label>
                <input class="form-control {{ $errors->has('f_uri') ? 'is-invalid' : '' }}" type="text" name="f_uri" id="f_uri" value="{{ old('f_uri', $company->f_uri) }}">
                @if($errors->has('f_uri'))
                    <div class="invalid-feedback">
                        {{ $errors->first('f_uri') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.company.fields.f_uri_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="c_uri">{{ trans('cruds.company.fields.c_uri') }}</label>
                <input class="form-control {{ $errors->has('c_uri') ? 'is-invalid' : '' }}" type="text" name="c_uri" id="c_uri" value="{{ old('c_uri', $company->c_uri) }}">
                @if($errors->has('c_uri'))
                    <div class="invalid-feedback">
                        {{ $errors->first('c_uri') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.company.fields.c_uri_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required">{{ trans('cruds.company.fields.ipn_channel') }}</label>
                <select class="form-control {{ $errors->has('ipn_channel') ? 'is-invalid' : '' }}" name="ipn_channel" id="ipn_channel" required>
                    <option value disabled {{ old('ipn_channel', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\Company::IPN_CHANNEL_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('ipn_channel', $company->ipn_channel) === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('ipn_channel'))
                    <div class="invalid-feedback">
                        {{ $errors->first('ipn_channel') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.company.fields.ipn_channel_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="ipn_email">{{ trans('cruds.company.fields.ipn_email') }}</label>
                <input class="form-control {{ $errors->has('ipn_email') ? 'is-invalid' : '' }}" type="text" name="ipn_email" id="ipn_email" value="{{ old('ipn_email', $company->ipn_email) }}" required>
                @if($errors->has('ipn_email'))
                    <div class="invalid-feedback">
                        {{ $errors->first('ipn_email') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.company.fields.ipn_email_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="ipn_uri">{{ trans('cruds.company.fields.ipn_uri') }}</label>
                <input class="form-control {{ $errors->has('ipn_uri') ? 'is-invalid' : '' }}" type="text" name="ipn_uri" id="ipn_uri" value="{{ old('ipn_uri', $company->ipn_uri) }}">
                @if($errors->has('ipn_uri'))
                    <div class="invalid-feedback">
                        {{ $errors->first('ipn_uri') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.company.fields.ipn_uri_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="mac_addr">{{ trans('cruds.company.fields.mac_addr') }}</label>
                <input class="form-control {{ $errors->has('mac_addr') ? 'is-invalid' : '' }}" type="text" name="mac_addr" id="mac_addr" value="{{ old('mac_addr', $company->mac_addr) }}">
                @if($errors->has('mac_addr'))
                    <div class="invalid-feedback">
                        {{ $errors->first('mac_addr') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.company.fields.mac_addr_helper') }}</span>
            </div>
            <div class="form-group">
                <div class="form-check {{ $errors->has('active') ? 'is-invalid' : '' }}">
                    <input class="form-check-input" type="checkbox" name="active" id="active" value="1" {{ $company->active || old('active', 0) === 1 ? 'checked' : '' }} required>
                    <label class="required form-check-label" for="active">{{ trans('cruds.company.fields.active') }}</label>
                </div>
                @if($errors->has('active'))
                    <div class="invalid-feedback">
                        {{ $errors->first('active') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.company.fields.active_helper') }}</span>
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