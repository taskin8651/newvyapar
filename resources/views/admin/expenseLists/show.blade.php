@extends('layouts.admin')
@section('content')
<div class="content">

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('global.show') }} {{ trans('cruds.expenseList.title') }}
                </div>
                <div class="panel-body">
                    <div class="form-group">
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('admin.expense-lists.index') }}">
                                {{ trans('global.back_to_list') }}
                            </a>
                        </div>
                        <table class="table table-bordered table-striped">
                            <tbody>
                                <tr>
                                    <th>
                                        {{ trans('cruds.expenseList.fields.id') }}
                                    </th>
                                    <td>
                                        {{ $expenseList->id }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.expenseList.fields.entry_date') }}
                                    </th>
                                    <td>
                                        {{ $expenseList->entry_date }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.expenseList.fields.category') }}
                                    </th>
                                    <td>
                                        {{ $expenseList->category->expense_category ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.expenseList.fields.amount') }}
                                    </th>
                                    <td>
                                        {{ $expenseList->amount }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.expenseList.fields.description') }}
                                    </th>
                                    <td>
                                        {{ $expenseList->description }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.expenseList.fields.payment') }}
                                    </th>
                                    <td>
                                        {{ $expenseList->payment->account_name ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.expenseList.fields.tax_include') }}
                                    </th>
                                    <td>
                                        {{ App\Models\ExpenseList::TAX_INCLUDE_RADIO[$expenseList->tax_include] ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.expenseList.fields.notes') }}
                                    </th>
                                    <td>
                                        {!! $expenseList->notes !!}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('admin.expense-lists.index') }}">
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