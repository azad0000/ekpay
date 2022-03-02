@extends('layouts.admin')
@section('content')
@can('general_create')
    <div style="margin-bottom: 10px;" class="row">
        @if (count($generals)<1)
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.generals.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.general.title_singular') }}
            </a>
        </div>
        @else
            <div></div>
        @endif
        
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.general.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-General">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.general.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.general.fields.mer_reg_id_no') }}
                        </th>
                        <th>
                            {{ trans('cruds.general.fields.mer_pas_key') }}
                        </th>
                        <th>
                            {{ trans('cruds.general.fields.ekpay_dev_uri') }}
                        </th>
                        <th>
                            {{ trans('cruds.general.fields.ekpay_prod_uri') }}
                        </th>
                        <th>
                            {{ trans('cruds.general.fields.test_mode') }}
                        </th>
                        <th>
                            {{ trans('cruds.general.fields.s_uri') }}
                        </th>
                        <th>
                            {{ trans('cruds.general.fields.f_uri') }}
                        </th>
                        <th>
                            {{ trans('cruds.general.fields.c_uri') }}
                        </th>
                        <th>
                            {{ trans('cruds.general.fields.ipn_uri') }}
                        </th>
                        <th>
                            {{ trans('cruds.general.fields.mac_addr') }}
                        </th>
                        <th>
                            {{ trans('cruds.general.fields.ipn_channel') }}
                        </th>
                        <th>
                            {{ trans('cruds.general.fields.ipn_email') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($generals as $key => $general)
                        <tr data-entry-id="{{ $general->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $general->id ?? '' }}
                            </td>
                            <td>
                                {{ $general->mer_reg_id_no ?? '' }}
                            </td>
                            <td>
                                {{ $general->mer_pas_key ?? '' }}
                            </td>
                            <td>
                                {{ $general->ekpay_dev_uri ?? '' }}
                            </td>
                            <td>
                                {{ $general->ekpay_prod_uri ?? '' }}
                            </td>
                            <td>
                                <span style="display:none">{{ $general->test_mode ?? '' }}</span>
                                @if ($general->test_mode == 1)
                                <span class="bg-danger rounded p-1" style="font-size:10px;">Test Mode</span>
                                @else
                                <span class="bg-success rounded p-1" style="font-size:10px;">Dev Mode</span>  
                                @endif
                            </td>
                            <td>
                                {{ $general->s_uri ?? '' }}
                            </td>
                            <td>
                                {{ $general->f_uri ?? '' }}
                            </td>
                            <td>
                                {{ $general->c_uri ?? '' }}
                            </td>
                            <td>
                                {{ $general->ipn_uri ?? '' }}
                            </td>
                            <td>
                                {{ $general->mac_addr ?? '' }}
                            </td>
                            <td>
                                {{ App\Models\General::IPN_CHANNEL_SELECT[$general->ipn_channel] ?? '' }}
                            </td>
                            <td>
                                {{ $general->ipn_email ?? '' }}
                            </td>
                            <td>
                                @can('general_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.generals.show', $general->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('general_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.generals.edit', $general->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('general_delete')
                                    <form action="{{ route('admin.generals.destroy', $general->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <input type="submit" class="btn btn-xs btn-danger" value="{{ trans('global.delete') }}">
                                    </form>
                                @endcan

                            </td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>



@endsection
@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('general_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.generals.massDestroy') }}",
    className: 'btn-danger',
    action: function (e, dt, node, config) {
      var ids = $.map(dt.rows({ selected: true }).nodes(), function (entry) {
          return $(entry).data('entry-id')
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

  $.extend(true, $.fn.dataTable.defaults, {
    orderCellsTop: true,
    order: [[ 1, 'desc' ]],
    pageLength: 100,
  });
  let table = $('.datatable-General:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection