@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('cruds.ipn.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <table class=" table table-bordered table-striped table-hover ajaxTable datatable datatable-Ipn">
            <thead>
                <tr>
                    <th width="10">

                    </th>
                    <th>
                        {{ trans('cruds.ipn.fields.id') }}
                    </th>
                    <th>
                        {{ trans('cruds.ipn.fields.txn_id_no') }}
                    </th>
                    <th>
                        {{ trans('cruds.ipn.fields.msg_code') }}
                    </th>
                    <th>
                        {{ trans('cruds.ipn.fields.msg_det') }}
                    </th>
                    <th>
                        {{ trans('cruds.ipn.fields.req_timestamp') }}
                    </th>
                    <th>
                        {{ trans('cruds.ipn.fields.dgtl_sign') }}
                    </th>
                    <th>
                        {{ trans('cruds.ipn.fields.remarks') }}
                    </th>
                    <th>
                        {{ trans('cruds.ipn.fields.ekpay_txn_id_no') }}
                    </th>
                    <th>
                        {{ trans('cruds.ipn.fields.pi_trnx_id_no') }}
                    </th>
                    <th>
                        {{ trans('cruds.ipn.fields.pi_charge') }}
                    </th>
                    <th>
                        {{ trans('cruds.ipn.fields.ekpay_charge') }}
                    </th>
                    <th>
                        {{ trans('cruds.ipn.fields.pi_discount') }}
                    </th>
                    <th>
                        {{ trans('cruds.ipn.fields.total_ser_charge') }}
                    </th>
                    <th>
                        {{ trans('cruds.ipn.fields.ekpay_charge_discount') }}
                    </th>
                    <th>
                        {{ trans('cruds.ipn.fields.promo_discount') }}
                    </th>
                    <th>
                        {{ trans('cruds.ipn.fields.total_pabl_amt') }}
                    </th>
                    <th>
                        {{ trans('cruds.ipn.fields.pay_timestamp') }}
                    </th>
                    <th>
                        {{ trans('cruds.ipn.fields.pi_name') }}
                    </th>
                    <th>
                        {{ trans('cruds.ipn.fields.pi_type') }}
                    </th>
                    <th>
                        {{ trans('cruds.ipn.fields.pi_number') }}
                    </th>
                    <th>
                        {{ trans('cruds.ipn.fields.pi_gateway') }}
                    </th>
                    <th>
                        {{ trans('cruds.ipn.fields.is_settled') }}
                    </th>
                    <th>
                        {{ trans('cruds.ipn.fields.settlement') }}
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
                        <select class="search" strict="true">
                            <option value>{{ trans('global.all') }}</option>
                            @foreach(App\Models\Ipn::IS_SETTLED_RADIO as $key => $item)
                                <option value="{{ $key }}">{{ $item }}</option>
                            @endforeach
                        </select>
                    </td>
                    <td>
                        <input class="search" type="text" placeholder="{{ trans('global.search') }}">
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
    ajax: "{{ route('admin.ipns.index') }}",
    columns: [
      { data: 'placeholder', name: 'placeholder' },
{ data: 'id', name: 'id' },
{ data: 'txn_id_no_merchant_trnx_id_no', name: 'txn_id_no.merchant_trnx_id_no' },
{ data: 'msg_code', name: 'msg_code' },
{ data: 'msg_det', name: 'msg_det' },
{ data: 'req_timestamp', name: 'req_timestamp' },
{ data: 'dgtl_sign', name: 'dgtl_sign' },
{ data: 'remarks', name: 'remarks' },
{ data: 'ekpay_txn_id_no', name: 'ekpay_txn_id_no' },
{ data: 'pi_trnx_id_no', name: 'pi_trnx_id_no' },
{ data: 'pi_charge', name: 'pi_charge' },
{ data: 'ekpay_charge', name: 'ekpay_charge' },
{ data: 'pi_discount', name: 'pi_discount' },
{ data: 'total_ser_charge', name: 'total_ser_charge' },
{ data: 'ekpay_charge_discount', name: 'ekpay_charge_discount' },
{ data: 'promo_discount', name: 'promo_discount' },
{ data: 'total_pabl_amt', name: 'total_pabl_amt' },
{ data: 'pay_timestamp', name: 'pay_timestamp' },
{ data: 'pi_name', name: 'pi_name' },
{ data: 'pi_type', name: 'pi_type' },
{ data: 'pi_number', name: 'pi_number' },
{ data: 'pi_gateway', name: 'pi_gateway' },
{ data: 'is_settled', name: 'is_settled' },
{ data: 'settlement', name: 'settlement' },
{ data: 'actions', name: '{{ trans('global.actions') }}' }
    ],
    orderCellsTop: true,
    order: [[ 1, 'desc' ]],
    pageLength: 50,
  };
  let table = $('.datatable-Ipn').DataTable(dtOverrideGlobals);
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