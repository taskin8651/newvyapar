@extends('layouts.admin')
@section('content')
<div class="content">

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('global.show') }} {{ trans('cruds.mainCostCenter.title') }}
                </div>
                <div class="panel-body">
                    <div class="form-group">
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('admin.main-cost-centers.index') }}">
                                {{ trans('global.back_to_list') }}
                            </a>
                        </div>
                        <table class="table table-bordered table-striped">
                            <tbody>
                                <tr>
                                    <th>
                                        {{ trans('cruds.mainCostCenter.fields.id') }}
                                    </th>
                                    <td>
                                        {{ $mainCostCenter->id }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.mainCostCenter.fields.cost_center_name') }}
                                    </th>
                                    <td>
                                        {{ $mainCostCenter->cost_center_name }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.mainCostCenter.fields.unique_code') }}
                                    </th>
                                    <td>
                                        {{ $mainCostCenter->unique_code }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.mainCostCenter.fields.details_of_cost_center') }}
                                    </th>
                                    <td>
                                        {!! $mainCostCenter->details_of_cost_center !!}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.mainCostCenter.fields.link_with_company') }}
                                    </th>
                                    <td>
                                        {{ $mainCostCenter->link_with_company->company_name ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.mainCostCenter.fields.responsible_manager') }}
                                    </th>
                                    <td>
                                        {{ $mainCostCenter->responsible_manager->name ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.mainCostCenter.fields.location') }}
                                    </th>
                                    <td>
                                        {!! $mainCostCenter->location !!}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.mainCostCenter.fields.budget_amount') }}
                                    </th>
                                    <td>
                                        {{ $mainCostCenter->budget_amount }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.mainCostCenter.fields.actual_amount') }}
                                    </th>
                                    <td>
                                        {{ $mainCostCenter->actual_amount }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.mainCostCenter.fields.start_date') }}
                                    </th>
                                    <td>
                                        {{ $mainCostCenter->start_date }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.mainCostCenter.fields.status') }}
                                    </th>
                                    <td>
                                        {{ App\Models\MainCostCenter::STATUS_SELECT[$mainCostCenter->status] ?? '' }}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('admin.main-cost-centers.index') }}">
                                {{ trans('global.back_to_list') }}
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('global.relatedData') }}
                </div>
                <ul class="nav nav-tabs" role="tablist" id="relationship-tabs">
                    <li role="presentation">
                        <a href="#main_cost_center_sub_cost_centers" aria-controls="main_cost_center_sub_cost_centers" role="tab" data-toggle="tab">
                            {{ trans('cruds.subCostCenter.title') }}
                        </a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane" role="tabpanel" id="main_cost_center_sub_cost_centers">
                        @includeIf('admin.mainCostCenters.relationships.mainCostCenterSubCostCenters', ['subCostCenters' => $mainCostCenter->mainCostCenterSubCostCenters])
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection