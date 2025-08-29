@extends('layouts.admin')
@section('content')
<div class="content">

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('global.edit') }} {{ trans('cruds.cashInHand.title_singular') }}
                </div>
                <div class="panel-body">
                    <form method="POST" action="{{ route("admin.cash-in-hands.update", [$cashInHand->id]) }}" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="form-group {{ $errors->has('adjustment') ? 'has-error' : '' }}">
                            <label class="required">{{ trans('cruds.cashInHand.fields.adjustment') }}</label>
                            <select class="form-control" name="adjustment" id="adjustment" required>
                                <option value disabled {{ old('adjustment', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                                @foreach(App\Models\CashInHand::ADJUSTMENT_SELECT as $key => $label)
                                    <option value="{{ $key }}" {{ old('adjustment', $cashInHand->adjustment) === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('adjustment'))
                                <span class="help-block" role="alert">{{ $errors->first('adjustment') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.cashInHand.fields.adjustment_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('enter_amount') ? 'has-error' : '' }}">
                            <label class="required" for="enter_amount">{{ trans('cruds.cashInHand.fields.enter_amount') }}</label>
                            <input class="form-control" type="number" name="enter_amount" id="enter_amount" value="{{ old('enter_amount', $cashInHand->enter_amount) }}" step="0.01" required>
                            @if($errors->has('enter_amount'))
                                <span class="help-block" role="alert">{{ $errors->first('enter_amount') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.cashInHand.fields.enter_amount_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('adjustment_date') ? 'has-error' : '' }}">
                            <label for="adjustment_date">{{ trans('cruds.cashInHand.fields.adjustment_date') }}</label>
                            <input class="form-control date" type="text" name="adjustment_date" id="adjustment_date" value="{{ old('adjustment_date', $cashInHand->adjustment_date) }}">
                            @if($errors->has('adjustment_date'))
                                <span class="help-block" role="alert">{{ $errors->first('adjustment_date') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.cashInHand.fields.adjustment_date_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('description') ? 'has-error' : '' }}">
                            <label for="description">{{ trans('cruds.cashInHand.fields.description') }}</label>
                            <textarea class="form-control ckeditor" name="description" id="description">{!! old('description', $cashInHand->description) !!}</textarea>
                            @if($errors->has('description'))
                                <span class="help-block" role="alert">{{ $errors->first('description') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.cashInHand.fields.description_helper') }}</span>
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
                xhr.open('POST', '{{ route('admin.cash-in-hands.storeCKEditorImages') }}', true);
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
                data.append('crud_id', '{{ $cashInHand->id ?? 0 }}');
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

@endsection