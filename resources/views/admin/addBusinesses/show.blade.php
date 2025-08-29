@extends('layouts.admin')
@section('content')
<div class="content">

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('global.show') }} {{ trans('cruds.addBusiness.title') }}
                </div>
                <div class="panel-body">
                    <div class="form-group">
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('admin.add-businesses.index') }}">
                                {{ trans('global.back_to_list') }}
                            </a>
                        </div>
                        <table class="table table-bordered table-striped">
                            <tbody>
                                <tr>
                                    <th>
                                        {{ trans('cruds.addBusiness.fields.id') }}
                                    </th>
                                    <td>
                                        {{ $addBusiness->id }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.addBusiness.fields.company_name') }}
                                    </th>
                                    <td>
                                        {{ $addBusiness->company_name }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.addBusiness.fields.legal_name') }}
                                    </th>
                                    <td>
                                        {{ $addBusiness->legal_name }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.addBusiness.fields.business_type') }}
                                    </th>
                                    <td>
                                        {{ App\Models\AddBusiness::BUSINESS_TYPE_SELECT[$addBusiness->business_type] ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.addBusiness.fields.industry_type') }}
                                    </th>
                                    <td>
                                        {{ App\Models\AddBusiness::INDUSTRY_TYPE_SELECT[$addBusiness->industry_type] ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.addBusiness.fields.logo_upload') }}
                                    </th>
                                    <td>
                                        @foreach($addBusiness->logo_upload as $key => $media)
                                            <a href="{{ $media->getUrl() }}" target="_blank" style="display: inline-block">
                                                <img src="{{ $media->getUrl('thumb') }}">
                                            </a>
                                        @endforeach
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('admin.add-businesses.index') }}">
                                {{ trans('global.back_to_list') }}
                            </a>
                        </div>
                    </div>
                </div>
            </div>



        </div>
    </div>
</div>
@endsection