@extends('layouts.admin')
@section('content')
<div class="content">

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('global.edit') }} {{ trans('cruds.expenseCategory.title_singular') }}
                </div>
                <div class="panel-body">
                    <form method="POST" action="{{ route("admin.expense-categories.update", [$expenseCategory->id]) }}" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="form-group {{ $errors->has('expense_category') ? 'has-error' : '' }}">
                            <label class="required" for="expense_category">{{ trans('cruds.expenseCategory.fields.expense_category') }}</label>
                            <input class="form-control" type="text" name="expense_category" id="expense_category" value="{{ old('expense_category', $expenseCategory->expense_category) }}" required>
                            @if($errors->has('expense_category'))
                                <span class="help-block" role="alert">{{ $errors->first('expense_category') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.expenseCategory.fields.expense_category_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('type') ? 'has-error' : '' }}">
                            <label>{{ trans('cruds.expenseCategory.fields.type') }}</label>
                            <select class="form-control" name="type" id="type">
                                <option value disabled {{ old('type', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                                @foreach(App\Models\ExpenseCategory::TYPE_SELECT as $key => $label)
                                    <option value="{{ $key }}" {{ old('type', $expenseCategory->type) === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('type'))
                                <span class="help-block" role="alert">{{ $errors->first('type') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.expenseCategory.fields.type_helper') }}</span>
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