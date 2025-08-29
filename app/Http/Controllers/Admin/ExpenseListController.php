<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyExpenseListRequest;
use App\Http\Requests\StoreExpenseListRequest;
use App\Http\Requests\UpdateExpenseListRequest;
use App\Models\BankAccount;
use App\Models\ExpenseCategory;
use App\Models\ExpenseList;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class ExpenseListController extends Controller
{
    use MediaUploadingTrait, CsvImportTrait;

    public function index()
    {
        abort_if(Gate::denies('expense_list_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $expenseLists = ExpenseList::with(['category', 'payment', 'created_by'])->get();

        return view('admin.expenseLists.index', compact('expenseLists'));
    }

    public function create()
    {
        abort_if(Gate::denies('expense_list_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $categories = ExpenseCategory::pluck('expense_category', 'id')->prepend(trans('global.pleaseSelect'), '');

        $payments = BankAccount::pluck('account_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.expenseLists.create', compact('categories', 'payments'));
    }

    public function store(StoreExpenseListRequest $request)
    {
        $expenseList = ExpenseList::create($request->all());

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $expenseList->id]);
        }

        return redirect()->route('admin.expense-lists.index');
    }

    public function edit(ExpenseList $expenseList)
    {
        abort_if(Gate::denies('expense_list_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $categories = ExpenseCategory::pluck('expense_category', 'id')->prepend(trans('global.pleaseSelect'), '');

        $payments = BankAccount::pluck('account_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $expenseList->load('category', 'payment', 'created_by');

        return view('admin.expenseLists.edit', compact('categories', 'expenseList', 'payments'));
    }

    public function update(UpdateExpenseListRequest $request, ExpenseList $expenseList)
    {
        $expenseList->update($request->all());

        return redirect()->route('admin.expense-lists.index');
    }

    public function show(ExpenseList $expenseList)
    {
        abort_if(Gate::denies('expense_list_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $expenseList->load('category', 'payment', 'created_by');

        return view('admin.expenseLists.show', compact('expenseList'));
    }

    public function destroy(ExpenseList $expenseList)
    {
        abort_if(Gate::denies('expense_list_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $expenseList->delete();

        return back();
    }

    public function massDestroy(MassDestroyExpenseListRequest $request)
    {
        $expenseLists = ExpenseList::find(request('ids'));

        foreach ($expenseLists as $expenseList) {
            $expenseList->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('expense_list_create') && Gate::denies('expense_list_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new ExpenseList();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
