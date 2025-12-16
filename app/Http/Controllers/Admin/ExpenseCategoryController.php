<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyExpenseCategoryRequest;
use App\Http\Requests\StoreExpenseCategoryRequest;
use App\Http\Requests\UpdateExpenseCategoryRequest;
use App\Models\ExpenseCategory;
use App\Traits\CompanyScopeTrait;
use Gate;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class ExpenseCategoryController extends Controller
{
    use CsvImportTrait, CompanyScopeTrait;

    public function index()
    {
        abort_if(Gate::denies('expense_category_access'), Response::HTTP_FORBIDDEN);

        $user = auth()->user();
        $role = $user->roles->pluck('title')->first();

        if ($role === 'Super Admin') {
            $expenseCategories = ExpenseCategory::withoutGlobalScopes()
                ->with(['created_by', 'ledgers'])
                ->get();
        } else {
            $allowedUserIds = $this->getCompanyAllowedUserIds();

            $expenseCategories = ExpenseCategory::with(['created_by', 'ledgers'])
                ->whereIn('created_by_id', $allowedUserIds)
                ->get();
        }

        return view('admin.expenseCategories.index', compact('expenseCategories'));
    }

    public function create()
    {
        abort_if(Gate::denies('expense_category_create'), Response::HTTP_FORBIDDEN);

        return view('admin.expenseCategories.create');
    }

    public function store(StoreExpenseCategoryRequest $request)
    {
        $data = $request->validated();
        $data['created_by_id'] = Auth::id();

        ExpenseCategory::create($data);

        return redirect()->route('admin.expense-categories.index');
    }

    public function show(ExpenseCategory $expenseCategory)
    {
        abort_if(Gate::denies('expense_category_show'), Response::HTTP_FORBIDDEN);

        if (! auth()->user()->hasRole('Super Admin')) {
            abort_if(
                ! in_array($expenseCategory->created_by_id, $this->getCompanyAllowedUserIds()),
                Response::HTTP_FORBIDDEN
            );
        }

        $expenseCategory->load(['created_by', 'ledgers']);

        return view('admin.expenseCategories.show', compact('expenseCategory'));
    }

    public function edit(ExpenseCategory $expenseCategory)
    {
        abort_if(Gate::denies('expense_category_edit'), Response::HTTP_FORBIDDEN);

        if (! auth()->user()->hasRole('Super Admin')) {
            abort_if(
                ! in_array($expenseCategory->created_by_id, $this->getCompanyAllowedUserIds()),
                Response::HTTP_FORBIDDEN
            );
        }

        return view('admin.expenseCategories.edit', compact('expenseCategory'));
    }

    public function update(UpdateExpenseCategoryRequest $request, ExpenseCategory $expenseCategory)
    {
        $expenseCategory->update($request->validated());

        return redirect()->route('admin.expense-categories.index');
    }

    public function destroy(ExpenseCategory $expenseCategory)
    {
        abort_if(Gate::denies('expense_category_delete'), Response::HTTP_FORBIDDEN);

        if (! auth()->user()->hasRole('Super Admin')) {
            abort_if(
                ! in_array($expenseCategory->created_by_id, $this->getCompanyAllowedUserIds()),
                Response::HTTP_FORBIDDEN
            );
        }

        $expenseCategory->delete();

        return back();
    }

    public function massDestroy(MassDestroyExpenseCategoryRequest $request)
    {
        ExpenseCategory::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
