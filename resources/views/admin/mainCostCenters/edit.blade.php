@extends('layouts.admin')
@section('content')
<div class="content">

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('global.edit') }} {{ trans('cruds.mainCostCenter.title_singular') }}
                </div>
                <div class="panel-body">
                    <form method="POST" action="{{ route("admin.main-cost-centers.update", [$mainCostCenter->id]) }}" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="form-group {{ $errors->has('cost_center_name') ? 'has-error' : '' }}">
                            <label class="required" for="cost_center_name">{{ trans('cruds.mainCostCenter.fields.cost_center_name') }}</label>
                            <input class="form-control" type="text" name="cost_center_name" id="cost_center_name" value="{{ old('cost_center_name', $mainCostCenter->cost_center_name) }}" required>
                            @if($errors->has('cost_center_name'))
                                <span class="help-block" role="alert">{{ $errors->first('cost_center_name') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.mainCostCenter.fields.cost_center_name_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('unique_code') ? 'has-error' : '' }}">
                            <label for="unique_code">{{ trans('cruds.mainCostCenter.fields.unique_code') }}</label>
                            <input class="form-control" type="text" name="unique_code" id="unique_code" value="{{ old('unique_code', $mainCostCenter->unique_code) }}">
                            @if($errors->has('unique_code'))
                                <span class="help-block" role="alert">{{ $errors->first('unique_code') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.mainCostCenter.fields.unique_code_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('details_of_cost_center') ? 'has-error' : '' }}">
                            <label for="details_of_cost_center">{{ trans('cruds.mainCostCenter.fields.details_of_cost_center') }}</label>
                            <textarea class="form-control ckeditor" name="details_of_cost_center" id="details_of_cost_center">{!! old('details_of_cost_center', $mainCostCenter->details_of_cost_center) !!}</textarea>
                            @if($errors->has('details_of_cost_center'))
                                <span class="help-block" role="alert">{{ $errors->first('details_of_cost_center') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.mainCostCenter.fields.details_of_cost_center_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('link_with_company') ? 'has-error' : '' }}">
                            <label for="link_with_company_id">{{ trans('cruds.mainCostCenter.fields.link_with_company') }}</label>
                            <select class="form-control select2" name="link_with_company_id" id="link_with_company_id">
                                @foreach($link_with_companies as $id => $entry)
                                    <option value="{{ $id }}" {{ (old('link_with_company_id') ? old('link_with_company_id') : $mainCostCenter->link_with_company->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('link_with_company'))
                                <span class="help-block" role="alert">{{ $errors->first('link_with_company') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.mainCostCenter.fields.link_with_company_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('responsible_manager') ? 'has-error' : '' }}">
                            <label for="responsible_manager_id">{{ trans('cruds.mainCostCenter.fields.responsible_manager') }}</label>
                            <select class="form-control select2" name="responsible_manager_id" id="responsible_manager_id">
                                @foreach($responsible_managers as $id => $entry)
                                    <option value="{{ $id }}" {{ (old('responsible_manager_id') ? old('responsible_manager_id') : $mainCostCenter->responsible_manager->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('responsible_manager'))
                                <span class="help-block" role="alert">{{ $errors->first('responsible_manager') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.mainCostCenter.fields.responsible_manager_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('location') ? 'has-error' : '' }}">
                            <label for="location">{{ trans('cruds.mainCostCenter.fields.location') }}</label>
                            <textarea class="form-control ckeditor" name="location" id="location">{!! old('location', $mainCostCenter->location) !!}</textarea>
                            @if($errors->has('location'))
                                <span class="help-block" role="alert">{{ $errors->first('location') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.mainCostCenter.fields.location_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('budget_amount') ? 'has-error' : '' }}">
                            <label for="budget_amount">{{ trans('cruds.mainCostCenter.fields.budget_amount') }}</label>
                            <input class="form-control" type="number" name="budget_amount" id="budget_amount" value="{{ old('budget_amount', $mainCostCenter->budget_amount) }}" step="0.01">
                            @if($errors->has('budget_amount'))
                                <span class="help-block" role="alert">{{ $errors->first('budget_amount') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.mainCostCenter.fields.budget_amount_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('actual_amount') ? 'has-error' : '' }}">
                            <label for="actual_amount">{{ trans('cruds.mainCostCenter.fields.actual_amount') }}</label>
                            <input class="form-control" type="number" name="actual_amount" id="actual_amount" value="{{ old('actual_amount', $mainCostCenter->actual_amount) }}" step="0.01">
                            @if($errors->has('actual_amount'))
                                <span class="help-block" role="alert">{{ $errors->first('actual_amount') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.mainCostCenter.fields.actual_amount_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('start_date') ? 'has-error' : '' }}">
                            <label for="start_date">{{ trans('cruds.mainCostCenter.fields.start_date') }}</label>
                            <input class="form-control date" type="text" name="start_date" id="start_date" value="{{ old('start_date', $mainCostCenter->start_date) }}">
                            @if($errors->has('start_date'))
                                <span class="help-block" role="alert">{{ $errors->first('start_date') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.mainCostCenter.fields.start_date_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('status') ? 'has-error' : '' }}">
                            <label class="required">{{ trans('cruds.mainCostCenter.fields.status') }}</label>
                            <select class="form-control" name="status" id="status" required>
                                <option value disabled {{ old('status', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                                @foreach(App\Models\MainCostCenter::STATUS_SELECT as $key => $label)
                                    <option value="{{ $key }}" {{ old('status', $mainCostCenter->status) === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('status'))
                                <span class="help-block" role="alert">{{ $errors->first('status') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.mainCostCenter.fields.status_helper') }}</span>
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
                xhr.open('POST', '{{ route('admin.main-cost-centers.storeCKEditorImages') }}', true);
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
                data.append('crud_id', '{{ $mainCostCenter->id ?? 0 }}');
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