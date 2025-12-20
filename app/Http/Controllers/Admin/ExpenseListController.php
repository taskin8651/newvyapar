<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyExpenseListRequest;
use App\Http\Requests\StoreExpenseListRequest;
use App\Http\Requests\UpdateExpenseListRequest;
use App\Models\BankAccount;
use App\Models\ExpenseList;
use App\Models\Ledger;
use App\Models\MainCostCenter;
use App\Models\SubCostCenter;
use App\Traits\CompanyScopeTrait;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class ExpenseListController extends Controller
{
    use MediaUploadingTrait, CsvImportTrait, CompanyScopeTrait;

    protected function formData()
    {
        $allowedUserIds = $this->getCompanyAllowedUserIds();

        return [
            'ledgers' => Ledger::with('expense_category')
                ->whereIn('created_by_id', $allowedUserIds)
                ->get(),

            'accounts' => BankAccount::whereIn('created_by_id', $allowedUserIds)
                ->select('id', 'bank_name as name', 'opening_balance')
                ->get()
                ->map(fn ($b) => [
                    'id' => $b->id,
                    'name' => $b->name,
                    'opening_balance' => $b->opening_balance,
                ]),

            'mainCostCenters' => MainCostCenter::whereIn('created_by_id', $allowedUserIds)
                ->pluck('cost_center_name', 'id')
                ->prepend(trans('global.pleaseSelect'), ''),

            'subCostCenters' => SubCostCenter::whereIn('created_by_id', $allowedUserIds)
                ->pluck('sub_cost_center_name', 'id')
                ->prepend(trans('global.pleaseSelect'), ''),
        ];
    }

public function index()
{
    abort_if(Gate::denies('expense_list_access'), Response::HTTP_FORBIDDEN);

    $expenseLists = ExpenseList::with([
            'category',
            'payment',
            'created_by'
        ])
        ->whereIn('created_by_id', $this->getCompanyAllowedUserIds())
        ->get();

    return view('admin.expenseLists.index', compact('expenseLists'));
}

    public function create()
    {
        abort_if(Gate::denies('expense_list_create'), Response::HTTP_FORBIDDEN);

        return view('admin.expenseLists.create', $this->formData());
    }

    public function store(StoreExpenseListRequest $request)
    {
        $allowedUserIds = $this->getCompanyAllowedUserIds();

        $data = $request->validated();
        $data['created_by_id'] = auth()->id();

        $bank = BankAccount::whereIn('created_by_id', $allowedUserIds)
            ->findOrFail($data['payment_id']);

        if ($bank->opening_balance < $data['amount']) {
            return back()->withErrors(['payment_id' => 'Insufficient bank balance'])->withInput();
        }

        $bank->decrement('opening_balance', $data['amount']);

        $expenseList = ExpenseList::create($data);

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $expenseList->id]);
        }

        return redirect()->route('admin.expense-lists.index');
    }

    public function edit(ExpenseList $expenseList)
    {
        abort_if(Gate::denies('expense_list_edit'), Response::HTTP_FORBIDDEN);

        abort_if(
            ! in_array($expenseList->created_by_id, $this->getCompanyAllowedUserIds()),
            Response::HTTP_FORBIDDEN
        );

        return view('admin.expenseLists.edit', array_merge(
            ['expenseList' => $expenseList],
            $this->formData()
        ));
    }

    public function update(UpdateExpenseListRequest $request, ExpenseList $expenseList)
    {
        $allowedUserIds = $this->getCompanyAllowedUserIds();

        $oldAmount = $expenseList->amount;
        $oldBankId = $expenseList->payment_id;

        $data = $request->validated();

        if ($oldBankId != $data['payment_id']) {
            BankAccount::whereIn('created_by_id', $allowedUserIds)
                ->findOrFail($oldBankId)
                ->increment('opening_balance', $oldAmount);

            $newBank = BankAccount::whereIn('created_by_id', $allowedUserIds)
                ->findOrFail($data['payment_id']);

            if ($newBank->opening_balance < $data['amount']) {
                return back()->withErrors(['payment_id' => 'Insufficient bank balance'])->withInput();
            }

            $newBank->decrement('opening_balance', $data['amount']);
        } else {
            $diff = $data['amount'] - $oldAmount;

            if ($diff > 0) {
                $bank = BankAccount::whereIn('created_by_id', $allowedUserIds)
                    ->findOrFail($oldBankId);

                if ($bank->opening_balance < $diff) {
                    return back()->withErrors(['amount' => 'Insufficient bank balance'])->withInput();
                }

                $bank->decrement('opening_balance', $diff);
            } elseif ($diff < 0) {
                BankAccount::whereIn('created_by_id', $allowedUserIds)
                    ->findOrFail($oldBankId)
                    ->increment('opening_balance', abs($diff));
            }
        }

        $expenseList->update($data);

        return redirect()->route('admin.expense-lists.index');
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

    public function destroy(ExpenseList $expenseList)
    {
        abort_if(Gate::denies('expense_list_delete'), Response::HTTP_FORBIDDEN);

        abort_if(
            ! in_array($expenseList->created_by_id, $this->getCompanyAllowedUserIds()),
            Response::HTTP_FORBIDDEN
        );

        BankAccount::find($expenseList->payment_id)
            ?->increment('opening_balance', $expenseList->amount);

        $expenseList->delete();

        return back();
    }

    public function massDestroy(MassDestroyExpenseListRequest $request)
    {
        ExpenseList::whereIn('id', $request->ids)->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
