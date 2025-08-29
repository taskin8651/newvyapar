@extends('layouts.admin')
@section('content')
<div class="content">

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('global.edit') }} {{ trans('cruds.paymentOut.title_singular') }}
                </div>
                <div class="panel-body">
                    <form method="POST" action="{{ route("admin.payment-outs.update", [$paymentOut->id]) }}" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="form-group {{ $errors->has('parties') ? 'has-error' : '' }}">
                            <label for="parties_id">{{ trans('cruds.paymentOut.fields.parties') }}</label>
                            <select class="form-control select2" name="parties_id" id="parties_id">
                                @foreach($parties as $id => $entry)
                                    <option value="{{ $id }}" {{ (old('parties_id') ? old('parties_id') : $paymentOut->parties->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('parties'))
                                <span class="help-block" role="alert">{{ $errors->first('parties') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.paymentOut.fields.parties_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('payment_type') ? 'has-error' : '' }}">
                            <label for="payment_type_id">{{ trans('cruds.paymentOut.fields.payment_type') }}</label>
                            <select class="form-control select2" name="payment_type_id" id="payment_type_id">
                                @foreach($payment_types as $id => $entry)
                                    <option value="{{ $id }}" {{ (old('payment_type_id') ? old('payment_type_id') : $paymentOut->payment_type->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('payment_type'))
                                <span class="help-block" role="alert">{{ $errors->first('payment_type') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.paymentOut.fields.payment_type_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('date') ? 'has-error' : '' }}">
                            <label for="date">{{ trans('cruds.paymentOut.fields.date') }}</label>
                            <input class="form-control date" type="text" name="date" id="date" value="{{ old('date', $paymentOut->date) }}">
                            @if($errors->has('date'))
                                <span class="help-block" role="alert">{{ $errors->first('date') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.paymentOut.fields.date_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('reference_no') ? 'has-error' : '' }}">
                            <label for="reference_no">{{ trans('cruds.paymentOut.fields.reference_no') }}</label>
                            <input class="form-control" type="text" name="reference_no" id="reference_no" value="{{ old('reference_no', $paymentOut->reference_no) }}">
                            @if($errors->has('reference_no'))
                                <span class="help-block" role="alert">{{ $errors->first('reference_no') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.paymentOut.fields.reference_no_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('amount') ? 'has-error' : '' }}">
                            <label for="amount">{{ trans('cruds.paymentOut.fields.amount') }}</label>
                            <input class="form-control" type="number" name="amount" id="amount" value="{{ old('amount', $paymentOut->amount) }}" step="0.01">
                            @if($errors->has('amount'))
                                <span class="help-block" role="alert">{{ $errors->first('amount') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.paymentOut.fields.amount_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('discount') ? 'has-error' : '' }}">
                            <label for="discount">{{ trans('cruds.paymentOut.fields.discount') }}</label>
                            <input class="form-control" type="text" name="discount" id="discount" value="{{ old('discount', $paymentOut->discount) }}">
                            @if($errors->has('discount'))
                                <span class="help-block" role="alert">{{ $errors->first('discount') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.paymentOut.fields.discount_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('total') ? 'has-error' : '' }}">
                            <label for="total">{{ trans('cruds.paymentOut.fields.total') }}</label>
                            <input class="form-control" type="number" name="total" id="total" value="{{ old('total', $paymentOut->total) }}" step="0.01">
                            @if($errors->has('total'))
                                <span class="help-block" role="alert">{{ $errors->first('total') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.paymentOut.fields.total_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('description') ? 'has-error' : '' }}">
                            <label for="description">{{ trans('cruds.paymentOut.fields.description') }}</label>
                            <textarea class="form-control ckeditor" name="description" id="description">{!! old('description', $paymentOut->description) !!}</textarea>
                            @if($errors->has('description'))
                                <span class="help-block" role="alert">{{ $errors->first('description') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.paymentOut.fields.description_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('attechment') ? 'has-error' : '' }}">
                            <label for="attechment">{{ trans('cruds.paymentOut.fields.attechment') }}</label>
                            <div class="needsclick dropzone" id="attechment-dropzone">
                            </div>
                            @if($errors->has('attechment'))
                                <span class="help-block" role="alert">{{ $errors->first('attechment') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.paymentOut.fields.attechment_helper') }}</span>
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
                xhr.open('POST', '{{ route('admin.payment-outs.storeCKEditorImages') }}', true);
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
                data.append('crud_id', '{{ $paymentOut->id ?? 0 }}');
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
    Dropzone.options.attechmentDropzone = {
    url: '{{ route('admin.payment-outs.storeMedia') }}',
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
      $('form').find('input[name="attechment"]').remove()
      $('form').append('<input type="hidden" name="attechment" value="' + response.name + '">')
    },
    removedfile: function (file) {
      file.previewElement.remove()
      if (file.status !== 'error') {
        $('form').find('input[name="attechment"]').remove()
        this.options.maxFiles = this.options.maxFiles + 1
      }
    },
    init: function () {
@if(isset($paymentOut) && $paymentOut->attechment)
      var file = {!! json_encode($paymentOut->attechment) !!}
          this.options.addedfile.call(this, file)
      this.options.thumbnail.call(this, file, file.preview ?? file.preview_url)
      file.previewElement.classList.add('dz-complete')
      $('form').append('<input type="hidden" name="attechment" value="' + file.file_name + '">')
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