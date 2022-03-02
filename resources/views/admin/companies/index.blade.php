@extends('layouts.admin')
@section('content')
@can('company_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.companies.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.company.title_singular') }}
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        @if (session()->has('success'))
        <span class=" alert alert-success">{{ session('success') }}</span>
        @endif
        {{ trans('cruds.company.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <table class=" table table-bordered table-striped table-hover ajaxTable datatable datatable-Company">
            <thead>
                <tr>
                    <th width="10">

                    </th>
                    <th>
                        {{ trans('cruds.company.fields.id') }}
                    </th>
                    <th>
                        {{ trans('cruds.company.fields.name') }}
                    </th>
                    <th>
                        {{ trans('cruds.company.fields.shortname') }}
                    </th>
                    <th>
                        {{ trans('cruds.company.fields.has_ekpay_id_no') }}
                    </th>
                    <th>
                        {{ trans('cruds.company.fields.mer_reg') }}
                    </th>
                    <th>
                        {{ trans('cruds.company.fields.mer_pas_key') }}
                    </th>
                    <th>
                        {{ trans('cruds.company.fields.domain_url') }}
                    </th>
                    <th>
                        {{ trans('cruds.company.fields.s_uri') }}
                    </th>
                    <th>
                        {{ trans('cruds.company.fields.f_uri') }}
                    </th>
                    <th>
                        {{ trans('cruds.company.fields.c_uri') }}
                    </th>
                    <th>
                        {{ trans('cruds.company.fields.ipn_channel') }}
                    </th>
                    <th>
                        {{ trans('cruds.company.fields.ipn_email') }}
                    </th>
                    <th>
                        {{ trans('cruds.company.fields.ipn_uri') }}
                    </th>
                    <th>
                        {{ trans('cruds.company.fields.mac_addr') }}
                    </th>
                    <th>
                        {{ trans('cruds.company.fields.active') }}
                    </th>
                    <th>
                        &nbsp;
                    </th>
                </tr>
            </thead>
        </table>
    </div>
</div>



@endsection
@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('company_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}';
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.companies.massDestroy') }}",
    className: 'btn-danger',
    action: function (e, dt, node, config) {
      var ids = $.map(dt.rows({ selected: true }).data(), function (entry) {
          return entry.id
      });

      if (ids.length === 0) {
        alert('{{ trans('global.datatables.zero_selected') }}')

        return
      }

      if (confirm('{{ trans('global.areYouSure') }}')) {
        $.ajax({
          headers: {'x-csrf-token': _token},
          method: 'POST',
          url: config.url,
          data: { ids: ids, _method: 'DELETE' }})
          .done(function () { location.reload() })
      }
    }
  }
  dtButtons.push(deleteButton)
@endcan

  let dtOverrideGlobals = {
    buttons: dtButtons,
    processing: true,
    serverSide: true,
    retrieve: true,
    aaSorting: [],
    ajax: "{{ route('admin.companies.index') }}",
    columns: [
      { data: 'placeholder', name: 'placeholder' },
{ data: 'id', name: 'id' },
{ data: 'name', name: 'name' },
{ data: 'shortname', name: 'shortname' },
{ data: 'has_ekpay_id_no', name: 'has_ekpay_id_no' },
{ data: 'mer_reg', name: 'mer_reg' },
{ data: 'mer_pas_key', name: 'mer_pas_key' },
{ data: 'domain_url', name: 'domain_url' },
{ data: 's_uri', name: 's_uri' },
{ data: 'f_uri', name: 'f_uri' },
{ data: 'c_uri', name: 'c_uri' },
{ data: 'ipn_channel', name: 'ipn_channel' },
{ data: 'ipn_email', name: 'ipn_email' },
{ data: 'ipn_uri', name: 'ipn_uri' },
{ data: 'mac_addr', name: 'mac_addr' },
{ data: 'active', name: 'active' },
{ data: 'actions', name: '{{ trans('global.actions') }}' }
    ],
    orderCellsTop: true,
    order: [[ 1, 'desc' ]],
    pageLength: 50,
  };
  let table = $('.datatable-Company').DataTable(dtOverrideGlobals);
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
});

</script>
@endsection