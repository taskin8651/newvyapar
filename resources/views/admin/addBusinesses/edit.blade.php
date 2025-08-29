@extends('layouts.admin')
@section('content')
<div class="content">

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('global.edit') }} {{ trans('cruds.addBusiness.title_singular') }}
                </div>
                <div class="panel-body">
                    <form method="POST" action="{{ route("admin.add-businesses.update", [$addBusiness->id]) }}" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="form-group {{ $errors->has('company_name') ? 'has-error' : '' }}">
                            <label class="required" for="company_name">{{ trans('cruds.addBusiness.fields.company_name') }}</label>
                            <input class="form-control" type="text" name="company_name" id="company_name" value="{{ old('company_name', $addBusiness->company_name) }}" required>
                            @if($errors->has('company_name'))
                                <span class="help-block" role="alert">{{ $errors->first('company_name') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.addBusiness.fields.company_name_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('legal_name') ? 'has-error' : '' }}">
                            <label class="required" for="legal_name">{{ trans('cruds.addBusiness.fields.legal_name') }}</label>
                            <input class="form-control" type="text" name="legal_name" id="legal_name" value="{{ old('legal_name', $addBusiness->legal_name) }}" required>
                            @if($errors->has('legal_name'))
                                <span class="help-block" role="alert">{{ $errors->first('legal_name') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.addBusiness.fields.legal_name_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('business_type') ? 'has-error' : '' }}">
                            <label>{{ trans('cruds.addBusiness.fields.business_type') }}</label>
                            <select class="form-control" name="business_type" id="business_type">
                                <option value disabled {{ old('business_type', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                                @foreach(App\Models\AddBusiness::BUSINESS_TYPE_SELECT as $key => $label)
                                    <option value="{{ $key }}" {{ old('business_type', $addBusiness->business_type) === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('business_type'))
                                <span class="help-block" role="alert">{{ $errors->first('business_type') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.addBusiness.fields.business_type_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('industry_type') ? 'has-error' : '' }}">
                            <label>{{ trans('cruds.addBusiness.fields.industry_type') }}</label>
                            <select class="form-control" name="industry_type" id="industry_type">
                                <option value disabled {{ old('industry_type', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                                @foreach(App\Models\AddBusiness::INDUSTRY_TYPE_SELECT as $key => $label)
                                    <option value="{{ $key }}" {{ old('industry_type', $addBusiness->industry_type) === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('industry_type'))
                                <span class="help-block" role="alert">{{ $errors->first('industry_type') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.addBusiness.fields.industry_type_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('logo_upload') ? 'has-error' : '' }}">
                            <label for="logo_upload">{{ trans('cruds.addBusiness.fields.logo_upload') }}</label>
                            <div class="needsclick dropzone" id="logo_upload-dropzone">
                            </div>
                            @if($errors->has('logo_upload'))
                                <span class="help-block" role="alert">{{ $errors->first('logo_upload') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.addBusiness.fields.logo_upload_helper') }}</span>
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
    var uploadedLogoUploadMap = {}
Dropzone.options.logoUploadDropzone = {
    url: '{{ route('admin.add-businesses.storeMedia') }}',
    maxFilesize: 20, // MB
    acceptedFiles: '.jpeg,.jpg,.png,.gif',
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
      $('form').append('<input type="hidden" name="logo_upload[]" value="' + response.name + '">')
      uploadedLogoUploadMap[file.name] = response.name
    },
    removedfile: function (file) {
      console.log(file)
      file.previewElement.remove()
      var name = ''
      if (typeof file.file_name !== 'undefined') {
        name = file.file_name
      } else {
        name = uploadedLogoUploadMap[file.name]
      }
      $('form').find('input[name="logo_upload[]"][value="' + name + '"]').remove()
    },
    init: function () {
@if(isset($addBusiness) && $addBusiness->logo_upload)
      var files = {!! json_encode($addBusiness->logo_upload) !!}
          for (var i in files) {
          var file = files[i]
          this.options.addedfile.call(this, file)
          this.options.thumbnail.call(this, file, file.preview ?? file.preview_url)
          file.previewElement.classList.add('dz-complete')
          $('form').append('<input type="hidden" name="logo_upload[]" value="' + file.file_name + '">')
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