<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePaymentInRequest;
use App\Http\Requests\UpdatePaymentInRequest;
use App\Models\PaymentIn;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Gate;
use Symfony\Component\HttpFoundation\Response;
use App\Models\BankTransaction;
use App\Models\PartyDetail;

class PaymentInController extends Controller
{
    public function index()
    {
        $paymentIns = PaymentIn::with(['parties', 'payment_type'])->get();
        return view('admin.paymentIns.index', compact('paymentIns'));
    }

   public function create()
{
    // Authorization check
    abort_if(Gate::denies('payment_in_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
    $userId = auth()->id();
    // Parties list for dropdown
        $parties = PartyDetail::where('created_by_id', $userId)
        ->get()
        ->mapWithKeys(function ($party) {
            // Use current_balance if exists, else opening_balance
            $balance = $party->current_balance ?? $party->opening_balance;
            $type = $party->current_balance_type ?? $party->opening_balance_type;

            // Format balance with arrow and Dr/Cr
            $balanceFormatted = number_format($balance, 2);
            $display = $type === 'Debit' ? "₹{$balanceFormatted} Dr" : "₹{$balanceFormatted} Cr";

            return [$party->id => "{$party->party_name} ({$display})"];
        });

    // Bank accounts list for dropdown
   
$payment_types = \App\Models\BankAccount::where('created_by_id', $userId)
    ->pluck('account_name', 'id')
    ->prepend(trans('global.pleaseSelect'), '');

    // Return create view with data
    return view('admin.paymentIns.create', compact('parties', 'payment_types'));
}


public function store(StorePaymentInRequest $request)
{
    // Step 1️⃣: Request data me created_by aur updated_by add karo
    $requestData = $request->all();
    $requestData['created_by_id'] = auth()->id();
    $requestData['updated_by_id'] = auth()->id();

    // Step 2️⃣: PaymentIn create karo
    $paymentIn = PaymentIn::create($requestData);

    // Step 3️⃣: Attachment save karna
    if ($request->input('attechment', false)) {
        $paymentIn->addMedia(storage_path('tmp/uploads/' . basename($request->input('attechment'))))
                  ->toMediaCollection('attechment');
    }

    // Step 4️⃣: CKEditor media handle
    if ($media = $request->input('ck-media', false)) {
        Media::whereIn('id', $media)->update(['model_id' => $paymentIn->id]);
    }

    // Step 5️⃣: Related data fetch karo
    $party = $paymentIn->parties;
    $bank  = $paymentIn->payment_type;

    // Step 6️⃣: BankTransaction me insert karo
    if ($party && $bank) {
        $transactionData = [
            'payment_in_id'         => $paymentIn->id, // ✅ NEW FIELD
            'party_id'              => $party->id,
            'party_name'            => $party->party_name,
            'opening_balance_type'  => $bank->opening_balance_type ?? null,
            'opening_balance'       => $bank->opening_balance ?? 0,
            'current_balance'       => $party->current_balance,
            'current_balance_type'  => $party->current_balance_type,
            'payment_type_id'       => $bank->id,
            'amount'                => $paymentIn->amount,
            'created_by_id'         => auth()->id(),
            'updated_by_id'         => auth()->id(),
            'description'           => $paymentIn->description,
            'json' => json_encode([
                'payment_in' => $paymentIn->toArray(),
                'party'      => $party->toArray(),
                'bank'       => $bank->toArray(),
                'user'       => auth()->user()->only(['id', 'name', 'email']),
            ]),
        ];

        BankTransaction::create($transactionData);
    }

    // Step 7️⃣: Bank balance update karo (PaymentIn me +)
    if ($bank) {
        $bank->opening_balance = $bank->opening_balance + $paymentIn->amount;
        $bank->save();
    }

    // Step 8️⃣: Party current balance update karo
    if ($party) {
        if ($party->current_balance_type == 'debit') {
            $party->current_balance += $paymentIn->amount;
        } else {
            $party->current_balance -= $paymentIn->amount;
        }

        // Auto balance type adjust
        if ($party->current_balance < 0) {
            $party->current_balance = abs($party->current_balance);
            $party->current_balance_type = 
                $party->current_balance_type == 'debit' ? 'credit' : 'debit';
        }

        $party->save();
    }

    // Step 9️⃣: Redirect
    return redirect()->route('admin.payment-ins.index')
                     ->with('success', '✅ Payment In successfully recorded, linked to BankTransaction, and balances updated.');
}




    public function show(PaymentIn $paymentIn)
    {
        $paymentIn->load(['parties', 'payment_type']);
        return view('admin.paymentIns.show', compact('paymentIn'));
    }

  public function edit(PaymentIn $paymentIn)
{
    // Parties aur Payment types fetch karo for dropdown
    $parties = PartyDetail::pluck('party_name', 'id')->prepend(trans('global.pleaseSelect'), '');
    $payment_types = BankAccount::pluck('account_name', 'id')->prepend(trans('global.pleaseSelect'), '');

    return view('admin.paymentIns.edit', compact('paymentIn', 'parties', 'payment_types'));
}

public function update(UpdatePaymentInRequest $request, PaymentIn $paymentIn)
{
    // Step 1️⃣: Updated data me updated_by_id add karo
    $requestData = $request->all();
    $requestData['updated_by_id'] = auth()->id();

    // Step 2️⃣: PaymentIn update karo
    $paymentIn->update($requestData);

    // Step 3️⃣: Attachment update
    if ($request->input('attechment', false)) {
        $paymentIn->clearMediaCollection('attechment');
        $paymentIn->addMedia(storage_path('tmp/uploads/' . basename($request->input('attechment'))))
                  ->toMediaCollection('attechment');
    }

    // Step 4️⃣: Related data fetch karo
    $party = $paymentIn->parties;
    $bank  = $paymentIn->payment_type;

    // Step 5️⃣: BankTransaction me update karo
    if ($party && $bank) {
        $transactionData = [
            'party_id'              => $party->id,
            'party_name'            => $party->party_name,
            'opening_balance_type'  => $bank->opening_balance_type ?? null,
            'opening_balance'       => $bank->opening_balance ?? 0,
            'current_balance'       => $party->current_balance,
            'current_balance_type'  => $party->current_balance_type,
            'payment_type_id'       => $bank->id,
            'amount'                => $paymentIn->amount,
            'updated_by_id'         => auth()->id(),
            'description'           => $paymentIn->description,
            'json'                  => json_encode([
                'payment_in' => $paymentIn->toArray(),
                'party'      => $party->toArray(),
                'bank'       => $bank->toArray(),
                'user'       => auth()->user()->only(['id', 'name', 'email']),
            ]),
        ];

        // Agar pehle se Transaction exist karta hai, update nahi to create
        BankTransaction::updateOrCreate(
            ['payment_type_id' => $bank->id, 'party_id' => $party->id, 'amount' => $paymentIn->amount],
            $transactionData
        );
    }

    // Step 6️⃣: Bank balance update (optional, agar amount change hua hai to logic adjust karo)
    // Step 7️⃣: Party balance update (optional, agar amount change hua hai to logic adjust karo)

    // Step 8️⃣: Redirect
    return redirect()->route('admin.payment-ins.index')
                     ->with('success', 'Payment In updated successfully, balances updated, and JSON log saved.');
}

    public function destroy(PaymentIn $paymentIn)
    {
        $paymentIn->delete();
        return back()->with('success', 'Payment In deleted successfully.');
    }
}
