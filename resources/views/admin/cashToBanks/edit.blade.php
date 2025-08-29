@extends('layouts.admin')
@section('content')
<div class="content">

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('global.edit') }} {{ trans('cruds.cashToBank.title_singular') }}
                </div>
                <div class="panel-body">
                    <form method="POST" action="{{ route("admin.cash-to-banks.update", [$cashToBank->id]) }}" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="form-group {{ $errors->has('from') ? 'has-error' : '' }}">
                            <label for="from">{{ trans('cruds.cashToBank.fields.from') }}</label>
                            <input class="form-control" type="text" name="from" id="from" value="{{ old('from', $cashToBank->from) }}">
                            @if($errors->has('from'))
                                <span class="help-block" role="alert">{{ $errors->first('from') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.cashToBank.fields.from_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('to') ? 'has-error' : '' }}">
                            <label for="to_id">{{ trans('cruds.cashToBank.fields.to') }}</label>
                            <select class="form-control select2" name="to_id" id="to_id">
                                @foreach($tos as $id => $entry)
                                    <option value="{{ $id }}" {{ (old('to_id') ? old('to_id') : $cashToBank->to->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('to'))
                                <span class="help-block" role="alert">{{ $errors->first('to') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.cashToBank.fields.to_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('amount') ? 'has-error' : '' }}">
                            <label class="required" for="amount">{{ trans('cruds.cashToBank.fields.amount') }}</label>
                            <input class="form-control" type="number" name="amount" id="amount" value="{{ old('amount', $cashToBank->amount) }}" step="0.01" required>
                            @if($errors->has('amount'))
                                <span class="help-block" role="alert">{{ $errors->first('amount') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.cashToBank.fields.amount_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('adjustment_date') ? 'has-error' : '' }}">
                            <label for="adjustment_date">{{ trans('cruds.cashToBank.fields.adjustment_date') }}</label>
                            <input class="form-control date" type="text" name="adjustment_date" id="adjustment_date" value="{{ old('adjustment_date', $cashToBank->adjustment_date) }}">
                            @if($errors->has('adjustment_date'))
                                <span class="help-block" role="alert">{{ $errors->first('adjustment_date') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.cashToBank.fields.adjustment_date_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('description') ? 'has-error' : '' }}">
                            <label for="description">{{ trans('cruds.cashToBank.fields.description') }}</label>
                            <textarea class="form-control ckeditor" name="description" id="description">{!! old('description', $cashToBank->description) !!}</textarea>
                            @if($errors->has('description'))
                                <span class="help-block" role="alert">{{ $errors->first('description') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.cashToBank.fields.description_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('attechment') ? 'has-error' : '' }}">
                            <label for="attechment">{{ trans('cruds.cashToBank.fields.attechment') }}</label>
                            <div class="needsclick dropzone" id="attechment-dropzone">
                            </div>
                            @if($errors->has('attechment'))
                                <span class="help-block" role="alert">{{ $errors->first('attechment') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.cashToBank.fields.attechment_helper') }}</span>
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
                xhr.open('POST', '{{ route('admin.cash-to-banks.storeCKEditorImages') }}', true);
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
                data.append('crud_id', '{{ $cashToBank->id ?? 0 }}');
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
    url: '{{ route('admin.cash-to-banks.storeMedia') }}',
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
@if(isset($cashToBank) && $cashToBank->attechment)
      var file = {!! json_encode($cashToBank->attechment) !!}
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