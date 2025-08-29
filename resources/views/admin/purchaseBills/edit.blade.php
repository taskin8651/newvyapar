@extends('layouts.admin')
@section('content')
<div class="content">

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('global.edit') }} {{ trans('cruds.purchaseBill.title_singular') }}
                </div>
                <div class="panel-body">
                    <form method="POST" action="{{ route("admin.purchase-bills.update", [$purchaseBill->id]) }}" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="form-group {{ $errors->has('select_customer') ? 'has-error' : '' }}">
                            <label class="required" for="select_customer_id">{{ trans('cruds.purchaseBill.fields.select_customer') }}</label>
                            <select class="form-control select2" name="select_customer_id" id="select_customer_id" required>
                                @foreach($select_customers as $id => $entry)
                                    <option value="{{ $id }}" {{ (old('select_customer_id') ? old('select_customer_id') : $purchaseBill->select_customer->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('select_customer'))
                                <span class="help-block" role="alert">{{ $errors->first('select_customer') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.purchaseBill.fields.select_customer_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('billing_name') ? 'has-error' : '' }}">
                            <label for="billing_name">{{ trans('cruds.purchaseBill.fields.billing_name') }}</label>
                            <input class="form-control" type="text" name="billing_name" id="billing_name" value="{{ old('billing_name', $purchaseBill->billing_name) }}">
                            @if($errors->has('billing_name'))
                                <span class="help-block" role="alert">{{ $errors->first('billing_name') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.purchaseBill.fields.billing_name_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('phone_number') ? 'has-error' : '' }}">
                            <label for="phone_number">{{ trans('cruds.purchaseBill.fields.phone_number') }}</label>
                            <input class="form-control" type="text" name="phone_number" id="phone_number" value="{{ old('phone_number', $purchaseBill->phone_number) }}">
                            @if($errors->has('phone_number'))
                                <span class="help-block" role="alert">{{ $errors->first('phone_number') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.purchaseBill.fields.phone_number_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('e_way_bill_no') ? 'has-error' : '' }}">
                            <label for="e_way_bill_no">{{ trans('cruds.purchaseBill.fields.e_way_bill_no') }}</label>
                            <input class="form-control" type="text" name="e_way_bill_no" id="e_way_bill_no" value="{{ old('e_way_bill_no', $purchaseBill->e_way_bill_no) }}">
                            @if($errors->has('e_way_bill_no'))
                                <span class="help-block" role="alert">{{ $errors->first('e_way_bill_no') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.purchaseBill.fields.e_way_bill_no_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('billing_address') ? 'has-error' : '' }}">
                            <label for="billing_address">{{ trans('cruds.purchaseBill.fields.billing_address') }}</label>
                            <textarea class="form-control ckeditor" name="billing_address" id="billing_address">{!! old('billing_address', $purchaseBill->billing_address) !!}</textarea>
                            @if($errors->has('billing_address'))
                                <span class="help-block" role="alert">{{ $errors->first('billing_address') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.purchaseBill.fields.billing_address_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('shipping_address') ? 'has-error' : '' }}">
                            <label for="shipping_address">{{ trans('cruds.purchaseBill.fields.shipping_address') }}</label>
                            <textarea class="form-control ckeditor" name="shipping_address" id="shipping_address">{!! old('shipping_address', $purchaseBill->shipping_address) !!}</textarea>
                            @if($errors->has('shipping_address'))
                                <span class="help-block" role="alert">{{ $errors->first('shipping_address') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.purchaseBill.fields.shipping_address_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('po_no') ? 'has-error' : '' }}">
                            <label for="po_no">{{ trans('cruds.purchaseBill.fields.po_no') }}</label>
                            <input class="form-control" type="text" name="po_no" id="po_no" value="{{ old('po_no', $purchaseBill->po_no) }}">
                            @if($errors->has('po_no'))
                                <span class="help-block" role="alert">{{ $errors->first('po_no') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.purchaseBill.fields.po_no_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('po_date') ? 'has-error' : '' }}">
                            <label for="po_date">{{ trans('cruds.purchaseBill.fields.po_date') }}</label>
                            <input class="form-control date" type="text" name="po_date" id="po_date" value="{{ old('po_date', $purchaseBill->po_date) }}">
                            @if($errors->has('po_date'))
                                <span class="help-block" role="alert">{{ $errors->first('po_date') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.purchaseBill.fields.po_date_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('items') ? 'has-error' : '' }}">
                            <label for="items">{{ trans('cruds.purchaseBill.fields.item') }}</label>
                            <div style="padding-bottom: 4px">
                                <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                                <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                            </div>
                            <select class="form-control select2" name="items[]" id="items" multiple>
                                @foreach($items as $id => $item)
                                    <option value="{{ $id }}" {{ (in_array($id, old('items', [])) || $purchaseBill->items->contains($id)) ? 'selected' : '' }}>{{ $item }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('items'))
                                <span class="help-block" role="alert">{{ $errors->first('items') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.purchaseBill.fields.item_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('qty') ? 'has-error' : '' }}">
                            <label class="required" for="qty">{{ trans('cruds.purchaseBill.fields.qty') }}</label>
                            <input class="form-control" type="number" name="qty" id="qty" value="{{ old('qty', $purchaseBill->qty) }}" step="1" required>
                            @if($errors->has('qty'))
                                <span class="help-block" role="alert">{{ $errors->first('qty') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.purchaseBill.fields.qty_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('description') ? 'has-error' : '' }}">
                            <label for="description">{{ trans('cruds.purchaseBill.fields.description') }}</label>
                            <textarea class="form-control ckeditor" name="description" id="description">{!! old('description', $purchaseBill->description) !!}</textarea>
                            @if($errors->has('description'))
                                <span class="help-block" role="alert">{{ $errors->first('description') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.purchaseBill.fields.description_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('image') ? 'has-error' : '' }}">
                            <label for="image">{{ trans('cruds.purchaseBill.fields.image') }}</label>
                            <div class="needsclick dropzone" id="image-dropzone">
                            </div>
                            @if($errors->has('image'))
                                <span class="help-block" role="alert">{{ $errors->first('image') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.purchaseBill.fields.image_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('document') ? 'has-error' : '' }}">
                            <label for="document">{{ trans('cruds.purchaseBill.fields.document') }}</label>
                            <div class="needsclick dropzone" id="document-dropzone">
                            </div>
                            @if($errors->has('document'))
                                <span class="help-block" role="alert">{{ $errors->first('document') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.purchaseBill.fields.document_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('payment_type') ? 'has-error' : '' }}">
                            <label for="payment_type_id">{{ trans('cruds.purchaseBill.fields.payment_type') }}</label>
                            <select class="form-control select2" name="payment_type_id" id="payment_type_id">
                                @foreach($payment_types as $id => $entry)
                                    <option value="{{ $id }}" {{ (old('payment_type_id') ? old('payment_type_id') : $purchaseBill->payment_type->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('payment_type'))
                                <span class="help-block" role="alert">{{ $errors->first('payment_type') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.purchaseBill.fields.payment_type_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('reference_no') ? 'has-error' : '' }}">
                            <label for="reference_no">{{ trans('cruds.purchaseBill.fields.reference_no') }}</label>
                            <input class="form-control" type="text" name="reference_no" id="reference_no" value="{{ old('reference_no', $purchaseBill->reference_no) }}">
                            @if($errors->has('reference_no'))
                                <span class="help-block" role="alert">{{ $errors->first('reference_no') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.purchaseBill.fields.reference_no_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <button class="btn btn-danger" type="submit">
                                {{ trans('global.save') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>



        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    $(document).ready(function () {
  function SimpleUploadAdapter(editor) {
    editor.plugins.get('FileRepository').createUploadAdapter = function(loader) {
      return {
        upload: function() {
          return loader.file
            .then(function (file) {
              return new Promise(function(resolve, reject) {
                // Init request
                var xhr = new XMLHttpRequest();
                xhr.open('POST', '{{ route('admin.purchase-bills.storeCKEditorImages') }}', true);
                xhr.setRequestHeader('x-csrf-token', window._token);
                xhr.setRequestHeader('Accept', 'application/json');
                xhr.responseType = 'json';

                // Init listeners
                var genericErrorText = `Couldn't upload file: ${ file.name }.`;
                xhr.addEventListener('error', function() { reject(genericErrorText) });
                xhr.addEventListener('abort', function() { reject() });
                xhr.addEventListener('load', function() {
                  var response = xhr.response;

                  if (!response || xhr.status !== 201) {
                    return reject(response && response.message ? `${genericErrorText}\n${xhr.status} ${response.message}` : `${genericErrorText}\n ${xhr.status} ${xhr.statusText}`);
                  }

                  $('form').append('<input type="hidden" name="ck-media[]" value="' + response.id + '">');

                  resolve({ default: response.url });
                });

                if (xhr.upload) {
                  xhr.upload.addEventListener('progress', function(e) {
                    if (e.lengthComputable) {
                      loader.uploadTotal = e.total;
                      loader.uploaded = e.loaded;
                    }
                  });
                }

                // Send request
                var data = new FormData();
                data.append('upload', file);
                data.append('crud_id', '{{ $purchaseBill->id ?? 0 }}');
                xhr.send(data);
              });
            })
        }
      };
    }
  }

  var allEditors = document.querySelectorAll('.ckeditor');
  for (var i = 0; i < allEditors.length; ++i) {
    ClassicEditor.create(
      allEditors[i], {
        extraPlugins: [SimpleUploadAdapter]
      }
    );
  }
});
</script>

<script>
    Dropzone.options.imageDropzone = {
    url: '{{ route('admin.purchase-bills.storeMedia') }}',
    maxFilesize: 20, // MB
    acceptedFiles: '.jpeg,.jpg,.png,.gif',
    maxFiles: 1,
    addRemoveLinks: true,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    params: {
      size: 20,
      width: 4096,
      height: 4096
    },
    success: function (file, response) {
      $('form').find('input[name="image"]').remove()
      $('form').append('<input type="hidden" name="image" value="' + response.name + '">')
    },
    removedfile: function (file) {
      file.previewElement.remove()
      if (file.status !== 'error') {
        $('form').find('input[name="image"]').remove()
        this.options.maxFiles = this.options.maxFiles + 1
      }
    },
    init: function () {
@if(isset($purchaseBill) && $purchaseBill->image)
      var file = {!! json_encode($purchaseBill->image) !!}
          this.options.addedfile.call(this, file)
      this.options.thumbnail.call(this, file, file.preview ?? file.preview_url)
      file.previewElement.classList.add('dz-complete')
      $('form').append('<input type="hidden" name="image" value="' + file.file_name + '">')
      this.options.maxFiles = this.options.maxFiles - 1
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
<script>
    Dropzone.options.documentDropzone = {
    url: '{{ route('admin.purchase-bills.storeMedia') }}',
    maxFilesize: 20, // MB
    maxFiles: 1,
    addRemoveLinks: true,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    params: {
      size: 20
    },
    success: function (file, response) {
      $('form').find('input[name="document"]').remove()
      $('form').append('<input type="hidden" name="document" value="' + response.name + '">')
    },
    removedfile: function (file) {
      file.previewElement.remove()
      if (file.status !== 'error') {
        $('form').find('input[name="document"]').remove()
        this.options.maxFiles = this.options.maxFiles + 1
      }
    },
    init: function () {
@if(isset($purchaseBill) && $purchaseBill->document)
      var file = {!! json_encode($purchaseBill->document) !!}
          this.options.addedfile.call(this, file)
      file.previewElement.classList.add('dz-complete')
      $('form').append('<input type="hidden" name="document" value="' + file.file_name + '">')
      this.options.maxFiles = this.options.maxFiles - 1
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