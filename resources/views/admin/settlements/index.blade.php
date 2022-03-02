@extends('layouts.admin')
@section('content')
@can('settlement_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.settlements.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.settlement.title_singular') }}
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.settlement.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <table class=" table table-bordered table-striped table-hover ajaxTable datatable datatable-Settlement">
            <thead>
                <tr>
                    <th width="10">

                    </th>
                    <th>
                        {{ trans('cruds.settlement.fields.id') }}
                    </th>
                    <th>
                        {{ trans('cruds.settlement.fields.company') }}
                    </th>
                    <th>
                        {{ trans('cruds.settlement.fields.transaction') }}
                    </th>
                    <th>
                        {{ trans('cruds.settlement.fields.total_pabl_amount') }}
                    </th>
                    <th>
                        {{ trans('cruds.settlement.fields.total_paid_amount') }}
                    </th>
                    <th>
                        {{ trans('cruds.settlement.fields.paid_by') }}
                    </th>
                    <th>
                        {{ trans('cruds.settlement.fields.payment_medium') }}
                    </th>
                    <th>
                        {{ trans('cruds.settlement.fields.payment_ref') }}
                    </th>
                    <th>
                        {{ trans('cruds.settlement.fields.attachments') }}
                    </th>
                    <th>
                        {{ trans('cruds.settlement.fields.status') }}
                    </th>
                    <th>
                        &nbsp;
                    </th>
                </tr>
                <tr>
                    <td>
                    </td>
                    <td>
                        <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                    </td>
                    <td>
                        <select class="search">
                            <option value>{{ trans('global.all') }}</option>
                            @foreach($companies as $key => $item)
                                <option value="{{ $item->shortname }}">{{ $item->shortname }}</option>
                            @endforeach
                        </select>
                    </td>
                    <td>
                        <select class="search">
                            <option value>{{ trans('global.all') }}</option>
                            @foreach($transactions as $key => $item)
                                <option value="{{ $item->merchant_trnx_id_no }}">{{ $item->merchant_trnx_id_no }}</option>
                            @endforeach
                        </select>
                    </td>
                    <td>
                        <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                    </td>
                    <td>
                        <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                    </td>
                    <td>
                        <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                    </td>
                    <td>
                        <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                    </td>
                    <td>
                        <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                    </td>
                    <td>
                    </td>
                    <td>
                        <select class="search" strict="true">
                            <option value>{{ trans('global.all') }}</option>
                            @foreach(App\Models\Settlement::STATUS_SELECT as $key => $item)
                                <option value="{{ $key }}">{{ $item }}</option>
                            @endforeach
                        </select>
                    </td>
                    <td>
                    </td>
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
  
  let dtOverrideGlobals = {
    buttons: dtButtons,
    processing: true,
    serverSide: true,
    retrieve: true,
    aaSorting: [],
    ajax: "{{ route('admin.settlements.index') }}",
    columns: [
      { data: 'placeholder', name: 'placeholder' },
{ data: 'id', name: 'id' },
{ data: 'company_shortname', name: 'company.shortname' },
{ data: 'transaction', name: 'transactions.merchant_trnx_id_no' },
{ data: 'total_pabl_amount', name: 'total_pabl_amount' },
{ data: 'total_paid_amount', name: 'total_paid_amount' },
{ data: 'paid_by', name: 'paid_by' },
{ data: 'payment_medium', name: 'payment_medium' },
{ data: 'payment_ref', name: 'payment_ref' },
{ data: 'attachments', name: 'attachments', sortable: false, searchable: false },
{ data: 'status', name: 'status' },
{ data: 'actions', name: '{{ trans('global.actions') }}' }
    ],
    orderCellsTop: true,
    order: [[ 1, 'desc' ]],
    pageLength: 50,
  };
  let table = $('.datatable-Settlement').DataTable(dtOverrideGlobals);
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
let visibleColumnsIndexes = null;
$('.datatable thead').on('input', '.search', function () {
      let strict = $(this).attr('strict') || false
      let value = strict && this.value ? "^" + this.value + "$" : this.value

      let index = $(this).parent().index()
      if (visibleColumnsIndexes !== null) {
        index = visibleColumnsIndexes[index]
      }

      table
        .column(index)
        .search(value, strict)
        .draw()
  });
table.on('column-visibility.dt', function(e, settings, column, state) {
      visibleColumnsIndexes = []
      table.columns(":visible").every(function(colIdx) {
          visibleColumnsIndexes.push(colIdx);
      });
  })
});

</script>
@endsection