@extends('layouts.admin')
@section('content')
<div class="content">

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('global.show') }} {{ trans('cruds.subCostCenter.title') }}
                </div>
                <div class="panel-body">
                    <div class="form-group">
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('admin.sub-cost-centers.index') }}">
                                {{ trans('global.back_to_list') }}
                            </a>
                        </div>
                        <table class="table table-bordered table-striped">
                            <tbody>
                                <tr>
                                    <th>
                                        {{ trans('cruds.subCostCenter.fields.id') }}
                                    </th>
                                    <td>
                                        {{ $subCostCenter->id }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.subCostCenter.fields.main_cost_center') }}
                                    </th>
                                    <td>
                                        {{ $subCostCenter->main_cost_center->cost_center_name ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.subCostCenter.fields.sub_cost_center_name') }}
                                    </th>
                                    <td>
                                        {{ $subCostCenter->sub_cost_center_name }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.subCostCenter.fields.unique_code') }}
                                    </th>
                                    <td>
                                        {{ $subCostCenter->unique_code }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.subCostCenter.fields.details_of_sub_cost_center') }}
                                    </th>
                                    <td>
                                        {!! $subCostCenter->details_of_sub_cost_center !!}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.subCostCenter.fields.responsible_manager') }}
                                    </th>
                                    <td>
                                        {{ $subCostCenter->responsible_manager }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.subCostCenter.fields.budget_allocated') }}
                                    </th>
                                    <td>
                                        {{ $subCostCenter->budget_allocated }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.subCostCenter.fields.actual_expense') }}
                                    </th>
                                    <td>
                                        {{ $subCostCenter->actual_expense }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.subCostCenter.fields.start_date') }}
                                    </th>
                                    <td>
                                        {{ $subCostCenter->start_date }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.subCostCenter.fields.status') }}
                                    </th>
                                    <td>
                                        {{ App\Models\SubCostCenter::STATUS_SELECT[$subCostCenter->status] ?? '' }}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('admin.sub-cost-centers.index') }}">
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