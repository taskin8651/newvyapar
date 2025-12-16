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
use App\Models\Ledger;
use App\Models\MainCostCenter;
use App\Models\SubCostCenter;
use App\Models\CashInHand;
use App\Traits\CompanyScopeTrait;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class ExpenseListController extends Controller
{
    use MediaUploadingTrait, CsvImportTrait, CompanyScopeTrait;

    public function index()
    {
        abort_if(Gate::denies('expense_list_access'), Response::HTTP_FORBIDDEN);

        $allowedUserIds = $this->getCompanyAllowedUserIds();

        $expenseLists = ExpenseList::with(['category', 'payment', 'created_by'])
            ->whereIn('created_by_id', $allowedUserIds)
            ->get();

        return view('admin.expenseLists.index', compact('expenseLists'));
    }

public function create()
{
    abort_if(Gate::denies('expense_list_create'), Response::HTTP_FORBIDDEN);

    $allowedUserIds = $this->getCompanyAllowedUserIds();
  
    // 🔹 Ledgers
    $ledgers = Ledger::with('expense_category')
        ->whereIn('created_by_id', $allowedUserIds)
        ->get();

    // 🔹 Bank Accounts ONLY
    $accounts = BankAccount::whereIn('created_by_id', $allowedUserIds)
        ->select('id', 'bank_name as name', 'opening_balance')
        ->get()
        ->map(fn ($b) => [
            'id' =>  $b->id,
            'name' => $b->name,
            'opening_balance' => $b->opening_balance,
        ]);

    // 🔹 Cost Centers
    $mainCostCenters = MainCostCenter::whereIn('created_by_id', $allowedUserIds)
        ->pluck('cost_center_name', 'id')
        ->prepend(trans('global.pleaseSelect'), '');

    $subCostCenters = SubCostCenter::whereIn('created_by_id', $allowedUserIds)
        ->pluck('sub_cost_center_name', 'id')
        ->prepend(trans('global.pleaseSelect'), '');

    return view('admin.expenseLists.create', compact(
        'ledgers',
        'accounts',
        'mainCostCenters',
        'subCostCenters'
    ));
}

public function store(StoreExpenseListRequest $request)
{
   
    $allowedUserIds = $this->getCompanyAllowedUserIds();

    // ✅ Validate data
    $data = $request->validated();
    $data['created_by_id'] = auth()->id();

    // ✅ Find Bank Account (payment_id is numeric now)
    $bank = BankAccount::whereIn('created_by_id', $allowedUserIds)
        ->findOrFail($data['payment_id']);

    // ❗ Optional safety: insufficient balance check
    if ($bank->opening_balance < $data['amount']) {
        return back()->withErrors([
            'payment_id' => 'Insufficient bank balance.'
        ])->withInput();
    }

    // 🔻 Minus opening balance
    $bank->decrement('opening_balance', $data['amount']);

    // ✅ Save expense
    $expenseList = ExpenseList::create($data);

    // ✅ CKEditor media
    if ($media = $request->input('ck-media', false)) {
        \Spatie\MediaLibrary\MediaCollections\Models\Media::whereIn('id', $media)
            ->update(['model_id' => $expenseList->id]);
    }

    return redirect()
        ->route('admin.expense-lists.index')
        ->with('success', 'Expense entry created successfully.');
}

    public function show(ExpenseList $expenseList)
    {
        abort_if(Gate::denies('expense_list_show'), Response::HTTP_FORBIDDEN);

        abort_if(
            ! in_array($expenseList->created_by_id, $this->getCompanyAllowedUserIds()),
            Response::HTTP_FORBIDDEN
        );

        $expenseList->load(['category', 'payment', 'created_by']);

        return view('admin.expenseLists.show', compact('expenseList'));
    }

    public function edit(ExpenseList $expenseList)
    {
        abort_if(Gate::denies('expense_list_edit'), Response::HTTP_FORBIDDEN);

        abort_if(
            ! in_array($expenseList->created_by_id, $this->getCompanyAllowedUserIds()),
            Response::HTTP_FORBIDDEN
        );

        return redirect()->route('admin.expense-lists.index');
    }

    public function update(UpdateExpenseListRequest $request, ExpenseList $expenseList)
    {
        $expenseList->update($request->all());

        return redirect()->route('admin.expense-lists.index');
    }

    public function destroy(ExpenseList $expenseList)
    {
        abort_if(Gate::denies('expense_list_delete'), Response::HTTP_FORBIDDEN);

        abort_if(
            ! in_array($expenseList->created_by_id, $this->getCompanyAllowedUserIds()),
            Response::HTTP_FORBIDDEN
        );

        $expenseList->delete();

        return back();
    }

    public function massDestroy(MassDestroyExpenseListRequest $request)
    {
        ExpenseList::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
