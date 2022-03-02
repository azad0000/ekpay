@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.settlement.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.settlements.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="company_id">{{ trans('cruds.settlement.fields.company') }}</label>
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
                <span class="help-block">{{ trans('cruds.settlement.fields.company_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="transactions">{{ trans('cruds.settlement.fields.transaction') }}</label>
                <div style="padding-bottom: 4px">
                    <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                    <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                </div>
                <select class="form-control select2 {{ $errors->has('transactions') ? 'is-invalid' : '' }}" name="transactions[]" id="transactions" multiple required>
                    @foreach($transactions as $id => $transaction)
                        <option value="{{ $id }}" {{ in_array($id, old('transactions', [])) ? 'selected' : '' }}>{{ $transaction }}</option>
                    @endforeach
                </select>
                @if($errors->has('transactions'))
                    <div class="invalid-feedback">
                        {{ $errors->first('transactions') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.settlement.fields.transaction_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="total_pabl_amount">{{ trans('cruds.settlement.fields.total_pabl_amount') }}</label>
                <input class="form-control {{ $errors->has('total_pabl_amount') ? 'is-invalid' : '' }}" type="text" name="total_pabl_amount" id="total_pabl_amount" value="{{ old('total_pabl_amount', '') }}" required>
                @if($errors->has('total_pabl_amount'))
                    <div class="invalid-feedback">
                        {{ $errors->first('total_pabl_amount') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.settlement.fields.total_pabl_amount_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="total_paid_amount">{{ trans('cruds.settlement.fields.total_paid_amount') }}</label>
                <input class="form-control {{ $errors->has('total_paid_amount') ? 'is-invalid' : '' }}" type="text" name="total_paid_amount" id="total_paid_amount" value="{{ old('total_paid_amount', '') }}" required>
                @if($errors->has('total_paid_amount'))
                    <div class="invalid-feedback">
                        {{ $errors->first('total_paid_amount') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.settlement.fields.total_paid_amount_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="paid_by">{{ trans('cruds.settlement.fields.paid_by') }}</label>
                <input class="form-control {{ $errors->has('paid_by') ? 'is-invalid' : '' }}" type="text" name="paid_by" id="paid_by" value="{{ old('paid_by', '') }}" required>
                @if($errors->has('paid_by'))
                    <div class="invalid-feedback">
                        {{ $errors->first('paid_by') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.settlement.fields.paid_by_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="payment_medium">{{ trans('cruds.settlement.fields.payment_medium') }}</label>
                <input class="form-control {{ $errors->has('payment_medium') ? 'is-invalid' : '' }}" type="text" name="payment_medium" id="payment_medium" value="{{ old('payment_medium', '') }}" required>
                @if($errors->has('payment_medium'))
                    <div class="invalid-feedback">
                        {{ $errors->first('payment_medium') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.settlement.fields.payment_medium_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="payment_ref">{{ trans('cruds.settlement.fields.payment_ref') }}</label>
                <textarea class="form-control {{ $errors->has('payment_ref') ? 'is-invalid' : '' }}" name="payment_ref" id="payment_ref">{{ old('payment_ref') }}</textarea>
                @if($errors->has('payment_ref'))
                    <div class="invalid-feedback">
                        {{ $errors->first('payment_ref') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.settlement.fields.payment_ref_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="attachments">{{ trans('cruds.settlement.fields.attachments') }}</label>
                <div class="needsclick dropzone {{ $errors->has('attachments') ? 'is-invalid' : '' }}" id="attachments-dropzone">
                </div>
                @if($errors->has('attachments'))
                    <div class="invalid-feedback">
                        {{ $errors->first('attachments') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.settlement.fields.attachments_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required">{{ trans('cruds.settlement.fields.status') }}</label>
                <select class="form-control {{ $errors->has('status') ? 'is-invalid' : '' }}" name="status" id="status" required>
                    <option value disabled {{ old('status', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\Settlement::STATUS_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('status', 'settled') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('status'))
                    <div class="invalid-feedback">
                        {{ $errors->first('status') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.settlement.fields.status_helper') }}</span>
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

@section('scripts')
<script>
    var uploadedAttachmentsMap = {}
Dropzone.options.attachmentsDropzone = {
    url: '{{ route('admin.settlements.storeMedia') }}',
    maxFilesize: 2, // MB
    addRemoveLinks: true,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    params: {
      size: 2
    },
    success: function (file, response) {
      $('form').append('<input type="hidden" name="attachments[]" value="' + response.name + '">')
      uploadedAttachmentsMap[file.name] = response.name
    },
    removedfile: function (file) {
      file.previewElement.remove()
      var name = ''
      if (typeof file.file_name !== 'undefined') {
        name = file.file_name
      } else {
        name = uploadedAttachmentsMap[file.name]
      }
      $('form').find('input[name="attachments[]"][value="' + name + '"]').remove()
    },
    init: function () {
@if(isset($settlement) && $settlement->attachments)
          var files =
            {!! json_encode($settlement->attachments) !!}
              for (var i in files) {
              var file = files[i]
              this.options.addedfile.call(this, file)
              file.previewElement.classList.add('dz-complete')
              $('form').append('<input type="hidden" name="attachments[]" value="' + file.file_name + '">')
            }
@endif
    },
     error: function (file, response) {
         if ($.type(response) === 'string') {
             var message = response //dropzone sends it's own error messages in string
         } else {
             var message = response.errors.file
         }
         file.previewElement.classList.add('dz-error')
         _ref = file.previewElement.querySelectorAll('[data-dz-errormessage]')
         _results = []
         for (_i = 0, _len = _ref.length; _i < _len; _i++) {
             node = _ref[_i]
             _results.push(node.textContent = message)
         }

         return _results
     }
}
</script>
@endsection