@extends('layouts.admin')
@section('content')
<div class="content">

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('global.show') }} {{ trans('cruds.taxRate.title') }}
                </div>
                <div class="panel-body">
                    <div class="form-group">
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('admin.tax-rates.index') }}">
                                {{ trans('global.back_to_list') }}
                            </a>
                        </div>
                        <table class="table table-bordered table-striped">
                            <tbody>
                                <tr>
                                    <th>
                                        {{ trans('cruds.taxRate.fields.id') }}
                                    </th>
                                    <td>
                                        {{ $taxRate->id }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.taxRate.fields.name') }}
                                    </th>
                                    <td>
                                        {{ $taxRate->name }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.taxRate.fields.parcentage') }}
                                    </th>
                                    <td>
                                        {{ $taxRate->parcentage }}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('admin.tax-rates.index') }}">
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
                        <a href="#select_tax_add_items" aria-controls="select_tax_add_items" role="tab" data-toggle="tab">
                            {{ trans('cruds.addItem.title') }}
                        </a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane" role="tabpanel" id="select_tax_add_items">
                        @includeIf('admin.taxRates.relationships.selectTaxAddItems', ['addItems' => $taxRate->selectTaxAddItems])
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection