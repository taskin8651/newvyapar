@extends('layouts.admin')
@section('content')
<div class="content">

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('global.edit') }} {{ trans('cruds.subCostCenter.title_singular') }}
                </div>
                <div class="panel-body">
                    <form method="POST" action="{{ route("admin.sub-cost-centers.update", [$subCostCenter->id]) }}" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="form-group {{ $errors->has('main_cost_center') ? 'has-error' : '' }}">
                            <label class="required" for="main_cost_center_id">{{ trans('cruds.subCostCenter.fields.main_cost_center') }}</label>
                            <select class="form-control select2" name="main_cost_center_id" id="main_cost_center_id" required>
                                @foreach($main_cost_centers as $id => $entry)
                                    <option value="{{ $id }}" {{ (old('main_cost_center_id') ? old('main_cost_center_id') : $subCostCenter->main_cost_center->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('main_cost_center'))
                                <span class="help-block" role="alert">{{ $errors->first('main_cost_center') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.subCostCenter.fields.main_cost_center_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('sub_cost_center_name') ? 'has-error' : '' }}">
                            <label class="required" for="sub_cost_center_name">{{ trans('cruds.subCostCenter.fields.sub_cost_center_name') }}</label>
                            <input class="form-control" type="text" name="sub_cost_center_name" id="sub_cost_center_name" value="{{ old('sub_cost_center_name', $subCostCenter->sub_cost_center_name) }}" required>
                            @if($errors->has('sub_cost_center_name'))
                                <span class="help-block" role="alert">{{ $errors->first('sub_cost_center_name') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.subCostCenter.fields.sub_cost_center_name_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('unique_code') ? 'has-error' : '' }}">
                            <label for="unique_code">{{ trans('cruds.subCostCenter.fields.unique_code') }}</label>
                            <input class="form-control" type="text" name="unique_code" id="unique_code" value="{{ old('unique_code', $subCostCenter->unique_code) }}">
                            @if($errors->has('unique_code'))
                                <span class="help-block" role="alert">{{ $errors->first('unique_code') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.subCostCenter.fields.unique_code_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('details_of_sub_cost_center') ? 'has-error' : '' }}">
                            <label for="details_of_sub_cost_center">{{ trans('cruds.subCostCenter.fields.details_of_sub_cost_center') }}</label>
                            <textarea class="form-control ckeditor" name="details_of_sub_cost_center" id="details_of_sub_cost_center">{!! old('details_of_sub_cost_center', $subCostCenter->details_of_sub_cost_center) !!}</textarea>
                            @if($errors->has('details_of_sub_cost_center'))
                                <span class="help-block" role="alert">{{ $errors->first('details_of_sub_cost_center') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.subCostCenter.fields.details_of_sub_cost_center_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('responsible_manager') ? 'has-error' : '' }}">
                            <label class="required" for="responsible_manager">{{ trans('cruds.subCostCenter.fields.responsible_manager') }}</label>
                            <input class="form-control" type="text" name="responsible_manager" id="responsible_manager" value="{{ old('responsible_manager', $subCostCenter->responsible_manager) }}" required>
                            @if($errors->has('responsible_manager'))
                                <span class="help-block" role="alert">{{ $errors->first('responsible_manager') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.subCostCenter.fields.responsible_manager_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('budget_allocated') ? 'has-error' : '' }}">
                            <label for="budget_allocated">{{ trans('cruds.subCostCenter.fields.budget_allocated') }}</label>
                            <input class="form-control" type="text" name="budget_allocated" id="budget_allocated" value="{{ old('budget_allocated', $subCostCenter->budget_allocated) }}">
                            @if($errors->has('budget_allocated'))
                                <span class="help-block" role="alert">{{ $errors->first('budget_allocated') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.subCostCenter.fields.budget_allocated_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('actual_expense') ? 'has-error' : '' }}">
                            <label for="actual_expense">{{ trans('cruds.subCostCenter.fields.actual_expense') }}</label>
                            <input class="form-control" type="text" name="actual_expense" id="actual_expense" value="{{ old('actual_expense', $subCostCenter->actual_expense) }}">
                            @if($errors->has('actual_expense'))
                                <span class="help-block" role="alert">{{ $errors->first('actual_expense') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.subCostCenter.fields.actual_expense_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('start_date') ? 'has-error' : '' }}">
                            <label for="start_date">{{ trans('cruds.subCostCenter.fields.start_date') }}</label>
                            <input class="form-control date" type="text" name="start_date" id="start_date" value="{{ old('start_date', $subCostCenter->start_date) }}">
                            @if($errors->has('start_date'))
                                <span class="help-block" role="alert">{{ $errors->first('start_date') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.subCostCenter.fields.start_date_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('status') ? 'has-error' : '' }}">
                            <label>{{ trans('cruds.subCostCenter.fields.status') }}</label>
                            <select class="form-control" name="status" id="status">
                                <option value disabled {{ old('status', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                                @foreach(App\Models\SubCostCenter::STATUS_SELECT as $key => $label)
                                    <option value="{{ $key }}" {{ old('status', $subCostCenter->status) === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('status'))
                                <span class="help-block" role="alert">{{ $errors->first('status') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.subCostCenter.fields.status_helper') }}</span>
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
                xhr.open('POST', '{{ route('admin.sub-cost-centers.storeCKEditorImages') }}', true);
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
                data.append('crud_id', '{{ $subCostCenter->id ?? 0 }}');
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