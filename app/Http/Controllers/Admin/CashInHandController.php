<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCashInHandRequest;
use App\Http\Requests\UpdateCashInHandRequest;
use App\Models\CashInHand;
use App\Models\BankAccount;
use App\Traits\CompanyScopeTrait;
use Gate;
use Symfony\Component\HttpFoundation\Response;

class CashInHandController extends Controller
{
    use CompanyScopeTrait;

    public function index()
    {
        abort_if(Gate::denies('cash_in_hand_access'), Response::HTTP_FORBIDDEN);

        $allowedUserIds = $this->getCompanyAllowedUserIds();

        $cashInHands = CashInHand::with(['bankAccount', 'created_by'])
            ->whereIn('created_by_id', $allowedUserIds)
            ->get();

        return view('admin.cashInHands.index', compact('cashInHands'));
    }

    public function create()
    {
        abort_if(Gate::denies('cash_in_hand_create'), Response::HTTP_FORBIDDEN);

        $allowedUserIds = $this->getCompanyAllowedUserIds();

        // ✅ Only company admin + logged-in user's bank accounts
        $bankAccounts = BankAccount::whereIn('created_by_id', $allowedUserIds)
            ->get();

        return view('admin.cashInHands.create', compact('bankAccounts'));
    }

    public function store(StoreCashInHandRequest $request)
    {
        $data = $request->validated();
        $data['created_by_id'] = auth()->id();
        $data['status'] = 'pending';

        $cashInHand = CashInHand::create($data);

        // ✅ Opening balance update
        $bank = BankAccount::whereIn('created_by_id', $this->getCompanyAllowedUserIds())
            ->findOrFail($data['bank_account_id']);

        $bank->increment('opening_balance', $data['amount']);

        return redirect()
            ->route('admin.cash-in-hands.index')
            ->with('success', 'Cash In Hand entry created successfully.');
    }

    public function show(CashInHand $cashInHand)
    {
        abort_if(Gate::denies('cash_in_hand_show'), Response::HTTP_FORBIDDEN);

        // ✅ Security check
        abort_if(
            ! in_array($cashInHand->created_by_id, $this->getCompanyAllowedUserIds()),
            Response::HTTP_FORBIDDEN
        );

        $cashInHand->load(['bankAccount', 'created_by']);

        return view('admin.cashInHands.show', compact('cashInHand'));
    }

    public function edit(CashInHand $cashInHand)
    {
        abort_if(Gate::denies('cash_in_hand_edit'), Response::HTTP_FORBIDDEN);

        abort_if(
            ! in_array($cashInHand->created_by_id, $this->getCompanyAllowedUserIds()),
            Response::HTTP_FORBIDDEN
        );

        $bankAccounts = BankAccount::whereIn(
            'created_by_id',
            $this->getCompanyAllowedUserIds()
        )->get();

        return view('admin.cashInHands.edit', compact('cashInHand', 'bankAccounts'));
    }

    public function update(UpdateCashInHandRequest $request, CashInHand $cashInHand)
    {
        abort_if(
            ! in_array($cashInHand->created_by_id, $this->getCompanyAllowedUserIds()),
            Response::HTTP_FORBIDDEN
        );

        $oldAmount = $cashInHand->amount;

        $cashInHand->update($request->validated());

        // ✅ Adjust opening balance
        $difference = $cashInHand->amount - $oldAmount;
        $cashInHand->bankAccount->increment('opening_balance', $difference);

        return redirect()->route('admin.cash-in-hands.index');
    }

    public function destroy(CashInHand $cashInHand)
    {
        abort_if(Gate::denies('cash_in_hand_delete'), Response::HTTP_FORBIDDEN);

        abort_if(
            ! in_array($cashInHand->created_by_id, $this->getCompanyAllowedUserIds()),
            Response::HTTP_FORBIDDEN
        );

        $cashInHand->bankAccount->decrement('opening_balance', $cashInHand->amount);
        $cashInHand->delete();

        return back();
    }
}
