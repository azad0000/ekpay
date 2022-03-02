@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.company.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.companies.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.company.fields.id') }}
                        </th>
                        <td>
                            {{ $company->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.company.fields.name') }}
                        </th>
                        <td>
                            {{ $company->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.company.fields.shortname') }}
                        </th>
                        <td>
                            {{ $company->shortname }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.company.fields.has_ekpay_id_no') }}
                        </th>
                        <td>
                            <input type="checkbox" disabled="disabled" {{ $company->has_ekpay_id_no ? 'checked' : '' }}>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.company.fields.mer_reg') }}
                        </th>
                        <td>
                            {{ $company->mer_reg }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.company.fields.mer_pas_key') }}
                        </th>
                        <td>
                            {{ $company->mer_pas_key }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.company.fields.domain_url') }}
                        </th>
                        <td>
                            {{ $company->domain_url }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.company.fields.s_uri') }}
                        </th>
                        <td>
                            {{ $company->s_uri }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.company.fields.f_uri') }}
                        </th>
                        <td>
                            {{ $company->f_uri }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.company.fields.c_uri') }}
                        </th>
                        <td>
                            {{ $company->c_uri }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.company.fields.ipn_channel') }}
                        </th>
                        <td>
                            {{ App\Models\Company::IPN_CHANNEL_SELECT[$company->ipn_channel] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.company.fields.ipn_email') }}
                        </th>
                        <td>
                            {{ $company->ipn_email }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.company.fields.ipn_uri') }}
                        </th>
                        <td>
                            {{ $company->ipn_uri }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.company.fields.mac_addr') }}
                        </th>
                        <td>
                            {{ $company->mac_addr }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.company.fields.active') }}
                        </th>
                        <td>
                            <input type="checkbox" disabled="disabled" {{ $company->active ? 'checked' : '' }}>
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.companies.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header">
        {{ trans('global.relatedData') }}
    </div>
    <ul class="nav nav-tabs" role="tablist" id="relationship-tabs">
        <li class="nav-item">
            <a class="nav-link" href="#company_users" role="tab" data-toggle="tab">
                {{ trans('cruds.user.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="company_users">
            @includeIf('admin.companies.relationships.companyUsers', ['users' => $company->companyUsers])
        </div>
    </div>
</div>

@endsection