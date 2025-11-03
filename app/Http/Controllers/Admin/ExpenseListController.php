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

    // 🔹 Ledger list
    $ledgers = Ledger::pluck('ledger_name', 'id')->prepend(trans('global.pleaseSelect'), '');

    // 🔹 Bank Accounts
    $bankAccounts = BankAccount::select('id', 'bank_name as name')->get();

    // 🔹 Cash In Hand
    $cashInHands = CashInHand::select('id', 'account_name as name')->get();

    // 🔹 Merge both (Bank + Cash)
    $accounts = $bankAccounts->map(function ($item) {
        return [
            'id' => 'bank_' . $item->id,
            'name' => $item->name . ' (Bank)'
        ];
    })->merge(
        $cashInHands->map(function ($item) {
            return [
                'id' => 'cash_' . $item->id,
                'name' => $item->name . ' (Cash)'
            ];
        })
    );

    // 🔹 Cost Centers
    $mainCostCenters = MainCostCenter::pluck('cost_center_name', 'id')->prepend(trans('global.pleaseSelect'), '');
    $subCostCenters = SubCostCenter::pluck('sub_cost_center_name', 'id')->prepend(trans('global.pleaseSelect'), '');

    return view('admin.expenseLists.create', compact(
        'ledgers',
        'accounts', // 👈 combined dropdown
        'mainCostCenters',
        'subCostCenters'
    ));
}


    public function store(StoreExpenseListRequest $request)
{
    // ✅ Format entry_date correctly
    if ($request->filled('entry_date')) {
        try {
            $request->merge([
                'entry_date' => \Carbon\Carbon::createFromFormat('Y-m-d', $request->entry_date)->format('Y-m-d')
            ]);
        } catch (\Exception $e) {
            // अगर गलत format आया तो null कर दो ताकि error ना फेंके
            $request->merge(['entry_date' => null]);
        }
    }

    // ✅ Handle combined payment_or_cash field
    $data = $request->all();
    if (!empty($data['payment_or_cash'])) {
        // अगर user ने cash चुना है तो cash_in_hand_id assign करो
        if (str_starts_with($data['payment_or_cash'], 'cash_')) {
            $data['cash_in_hand_id'] = str_replace('cash_', '', $data['payment_or_cash']);
            $data['payment_id'] = null;
        } 
        // अगर bank चुना है तो payment_id assign करो
        elseif (str_starts_with($data['payment_or_cash'], 'bank_')) {
            $data['payment_id'] = str_replace('bank_', '', $data['payment_or_cash']);
            $data['cash_in_hand_id'] = null;
        }
    }

    // ✅ Save record
    $expenseList = ExpenseList::create($data);

    // ✅ Handle media (ckeditor images)
    if ($media = $request->input('ck-media', false)) {
        \Spatie\MediaLibrary\MediaCollections\Models\Media::whereIn('id', $media)
            ->update(['model_id' => $expenseList->id]);
    }

    return redirect()->route('admin.expense-lists.index')
        ->with('success', 'Expense entry created successfully.');
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
