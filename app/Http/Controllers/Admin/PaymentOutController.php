<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyPaymentOutRequest;
use App\Http\Requests\StorePaymentOutRequest;
use App\Http\Requests\UpdatePaymentOutRequest;
use App\Models\BankAccount;
use App\Models\PartyDetail;
use App\Models\PaymentOut;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;
use App\Models\BankTransaction;
class PaymentOutController extends Controller
{
    use MediaUploadingTrait, CsvImportTrait;

    public function index()
    {
        abort_if(Gate::denies('payment_out_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $paymentOuts = PaymentOut::with(['parties', 'payment_type', 'created_by', 'media'])->get();

        return view('admin.paymentOuts.index', compact('paymentOuts'));
    }

    public function create()
    {
        abort_if(Gate::denies('payment_out_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $parties = PartyDetail::pluck('party_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $payment_types = BankAccount::pluck('account_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.paymentOuts.create', compact('parties', 'payment_types'));
    }

  public function store(StorePaymentOutRequest $request)
{
    // Step 1️⃣: PaymentOut create karo
    $paymentOut = PaymentOut::create($request->all());

    // Step 2️⃣: Attachment save karna
    if ($request->input('attechment', false)) {
        $paymentOut->addMedia(storage_path('tmp/uploads/' . basename($request->input('attechment'))))
            ->toMediaCollection('attechment');
    }

    if ($media = $request->input('ck-media', false)) {
        Media::whereIn('id', $media)->update(['model_id' => $paymentOut->id]);
    }

    // Step 3️⃣: Related data fetch karo
    $party = $paymentOut->parties; // Relation from PaymentOut -> PartyDetail
    $bank  = $paymentOut->payment_type; // Relation from PaymentOut -> BankAccount

    // Step 4️⃣: BankTransaction me insert karo
    if ($party && $bank) {
        $transactionData = [
            'party_id'              => $party->id,
            'party_name'            => $party->party_name,
            // 👇 Ab Bank ke opening balance aur type se lenge
            'opening_balance_type'  => $bank->opening_balance_type ?? null,
            'opening_balance'       => $bank->opening_balance ?? 0,
            'current_balance'       => $party->current_balance,
            'current_balance_type'  => $party->current_balance_type,
            'payment_type_id'       => $bank->id,
            'amount'                => $paymentOut->amount,
            'created_by_id'         => auth()->id(),
            'updated_by_id'         => auth()->id(),
            'description'           => $paymentOut->description,
        ];

        // 👇 JSON me poora data bhi save karo
        $transactionData['json'] = json_encode([
            'payment_out' => $paymentOut->toArray(),
            'party'       => $party->toArray(),
            'bank'        => $bank->toArray(),
            'user'        => auth()->user()->only(['id', 'name', 'email']),
        ]);
    

        BankTransaction::create($transactionData);
    }

    // Step 5️⃣: Bank balance update karo (opening_balance me se minus)
    if ($bank) {
        $bank->opening_balance = $bank->opening_balance - $paymentOut->amount;
        $bank->save();
    }

    // Step 6️⃣: Party ka current balance update karo
    if ($party) {
        if ($party->current_balance_type == 'debit') {
            $party->current_balance -= $paymentOut->amount;
        } else {
            $party->current_balance += $paymentOut->amount;
        }

        // Auto balance type adjust
        if ($party->current_balance < 0) {
            $party->current_balance = abs($party->current_balance);
            $party->current_balance_type = $party->current_balance_type == 'debit' ? 'credit' : 'debit';
        }

        $party->save();
    }

    // Step 7️⃣: Redirect
    return redirect()->route('admin.payment-outs.index')
        ->with('success', 'Payment Out successfully recorded, balances updated, and JSON log saved.');
}





    public function edit(PaymentOut $paymentOut)
    {
        abort_if(Gate::denies('payment_out_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $parties = PartyDetail::pluck('party_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $payment_types = BankAccount::pluck('account_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $paymentOut->load('parties', 'payment_type', 'created_by');

        return view('admin.paymentOuts.edit', compact('parties', 'paymentOut', 'payment_types'));
    }

   public function update(UpdatePaymentOutRequest $request, PaymentOut $paymentOut)
{
    // Step 1️⃣: Old data store kar lo comparison ke liye
    $oldAmount = $paymentOut->amount;
    $oldBank   = $paymentOut->payment_type;
    $oldParty  = $paymentOut->parties;

    // Step 2️⃣: PaymentOut update karo
    $paymentOut->update($request->all());

    // Step 3️⃣: Attachment update
    if ($request->input('attechment', false)) {
        if (!$paymentOut->getMedia('attechment')->first() ||
            $request->input('attechment') !== $paymentOut->getMedia('attechment')->first()->file_name) {
            $paymentOut->clearMediaCollection('attechment');
            $paymentOut->addMedia(storage_path('tmp/uploads/' . basename($request->input('attechment'))))
                ->toMediaCollection('attechment');
        }
    } elseif ($paymentOut->getMedia('attechment')->first()) {
        $paymentOut->clearMediaCollection('attechment');
    }

    if ($media = $request->input('ck-media', false)) {
        Media::whereIn('id', $media)->update(['model_id' => $paymentOut->id]);
    }

    // Step 4️⃣: Naye relations fetch karo
    $party = $paymentOut->parties;
    $bank  = $paymentOut->payment_type;

    // Step 5️⃣: Pichle balance ko revert karo (old bank aur party ko restore)
    if ($oldBank) {
        $oldBank->opening_balance += $oldAmount;
        $oldBank->save();
    }

    if ($oldParty) {
        if ($oldParty->current_balance_type == 'debit') {
            $oldParty->current_balance += $oldAmount;
        } else {
            $oldParty->current_balance -= $oldAmount;
        }

        if ($oldParty->current_balance < 0) {
            $oldParty->current_balance = abs($oldParty->current_balance);
            $oldParty->current_balance_type = $oldParty->current_balance_type == 'debit' ? 'credit' : 'debit';
        }

        $oldParty->save();
    }

    // Step 6️⃣: Naye amount ke hisab se update karo
    if ($bank) {
        $bank->opening_balance -= $paymentOut->amount;
        $bank->save();
    }

    if ($party) {
        if ($party->current_balance_type == 'debit') {
            $party->current_balance -= $paymentOut->amount;
        } else {
            $party->current_balance += $paymentOut->amount;
        }

        if ($party->current_balance < 0) {
            $party->current_balance = abs($party->current_balance);
            $party->current_balance_type = $party->current_balance_type == 'debit' ? 'credit' : 'debit';
        }

        $party->save();
    }

    // Step 7️⃣: BankTransaction record update ya create karo
    $transaction = BankTransaction::where('description', $oldParty?->party_name)
        ->where('amount', $oldAmount)
        ->where('party_id', $oldParty?->id)
        ->latest()
        ->first();

    $transactionData = [
        'party_id'              => $party?->id,
        'party_name'            => $party?->party_name,
        'opening_balance_type'  => $bank?->opening_balance_type ?? null,
        'opening_balance'       => $bank?->opening_balance ?? 0,
        'current_balance'       => $party?->current_balance ?? 0,
        'current_balance_type'  => $party?->current_balance_type ?? null,
        'payment_type_id'       => $bank?->id,
        'amount'                => $paymentOut->amount,
        'updated_by_id'         => auth()->id(),
        'description'           => $paymentOut->description,
        'json'                  => json_encode([
            'payment_out' => $paymentOut->toArray(),
            'party'       => $party?->toArray(),
            'bank'        => $bank?->toArray(),
            'user'        => auth()->user()->only(['id', 'name', 'email']),
        ]),
    ];

    if ($transaction) {
        $transaction->update($transactionData);
    } else {
        $transactionData['created_by_id'] = auth()->id();
        BankTransaction::create($transactionData);
    }

    // Step 8️⃣: Redirect
    return redirect()->route('admin.payment-outs.index')
        ->with('success', 'Payment Out successfully updated, balances adjusted, and JSON log refreshed.');
}


    public function show(PaymentOut $paymentOut)
    {
        abort_if(Gate::denies('payment_out_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $paymentOut->load('parties', 'payment_type', 'created_by');

        return view('admin.paymentOuts.show', compact('paymentOut'));
    }

    public function destroy(PaymentOut $paymentOut)
    {
        abort_if(Gate::denies('payment_out_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $paymentOut->delete();

        return back();
    }

    public function massDestroy(MassDestroyPaymentOutRequest $request)
    {
        $paymentOuts = PaymentOut::find(request('ids'));

        foreach ($paymentOuts as $paymentOut) {
            $paymentOut->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('payment_out_create') && Gate::denies('payment_out_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new PaymentOut();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
