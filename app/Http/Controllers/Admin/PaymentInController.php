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
use App\Models\BankAccount;
use DB;
use Illuminate\Support\Facades\DB as FacadesDB;

class PaymentInController extends Controller
{
    public function index()
    {
        $paymentIns = PaymentIn::with(['parties', 'payment_type'])->get();
        return view('admin.paymentIns.index', compact('paymentIns'));
    }

    public function create()
    {
        abort_if(Gate::denies('payment_in_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $userId = auth()->id();

        $parties = PartyDetail::where('created_by_id', $userId)
            ->get()
            ->mapWithKeys(function ($party) {
                $balance = $party->current_balance ?? $party->opening_balance ?? 0;
                $type    = $party->current_balance_type ?? $party->opening_balance_type;
                $display = number_format($balance, 2);
                $suffix  = $type === 'Debit' ? 'Dr' : 'Cr';

                return [$party->id => "{$party->party_name} (₹{$display} {$suffix})"];
            });

        $payment_types = BankAccount::where('created_by_id', $userId)
            ->pluck('account_name', 'id')
            ->prepend(trans('global.pleaseSelect'), '');

        return view('admin.paymentIns.create', compact('parties', 'payment_types'));
    }

    public function store(StorePaymentInRequest $request)
    {
        DB::transaction(function () use ($request) {

            $data = $request->all();
            $data['created_by_id'] = auth()->id();
            $data['updated_by_id'] = auth()->id();

            $paymentIn = PaymentIn::create($data);

            if ($request->input('attechment')) {
                $paymentIn->addMedia(storage_path('tmp/uploads/' . basename($request->attechment)))
                    ->toMediaCollection('attechment');
            }

            if ($media = $request->input('ck-media')) {
                Media::whereIn('id', $media)->update(['model_id' => $paymentIn->id]);
            }

            $party = $paymentIn->parties;
            $bank  = $paymentIn->payment_type;

            // Bank Transaction
            BankTransaction::create([
                'payment_in_id'  => $paymentIn->id,
                'party_id'       => $party->id,
                'party_name'     => $party->party_name,
                'payment_type_id'=> $bank->id,
                'amount'         => $paymentIn->amount,
                'created_by_id'  => auth()->id(),
                'updated_by_id'  => auth()->id(),
                'description'    => $paymentIn->description,
                'json'           => json_encode(compact('paymentIn', 'party', 'bank')),
            ]);

            // ✅ Bank + Amount
            $bank->opening_balance = ($bank->opening_balance ?? 0) + $paymentIn->amount;
            $bank->save();

            // ✅ Party - Amount
            $party->current_balance = ($party->current_balance ?? $party->opening_balance ?? 0) - $paymentIn->amount;
            $party->save();
        });

        return redirect()->route('admin.payment-ins.index')
            ->with('success', 'Payment In successfully recorded.');
    }

public function edit(PaymentIn $paymentIn)
{
    $parties = PartyDetail::where('created_by_id', auth()->id())->get();
    $payment_types = BankAccount::where('created_by_id', auth()->id())->get();

    return view('admin.paymentIns.edit', compact(
        'paymentIn',
        'parties',
        'payment_types'
    ));
}


public function update( $request, PaymentIn $paymentIn)
{
    DB::transaction(function () use ($request, $paymentIn) {

        /** ===============================
         * 1️⃣ OLD (LAST SAVED) DATA
         * =============================== */
        $oldAmount = $paymentIn->amount;
        $oldParty  = $paymentIn->parties;
        $oldBank   = $paymentIn->payment_type;

        /** ===============================
         * 2️⃣ REVERSE OLD EFFECT
         * =============================== */
        // Reverse from OLD bank
        if ($oldBank) {
            $oldBank->opening_balance =
                ($oldBank->opening_balance ?? 0) - $oldAmount;
            $oldBank->save();
        }

        // Reverse to OLD party
        if ($oldParty) {
            $oldParty->current_balance =
                ($oldParty->current_balance ?? 0) + $oldAmount;
            $oldParty->save();
        }

        /** ===============================
         * 3️⃣ UPDATE PAYMENT IN
         * =============================== */
        $data = $request->all();
        $data['updated_by_id'] = auth()->id();
        $paymentIn->update($data);

        // Attachment update
        if ($request->input('attechment')) {
            $paymentIn->clearMediaCollection('attechment');
            $paymentIn->addMedia(
                storage_path('tmp/uploads/' . basename($request->attechment))
            )->toMediaCollection('attechment');
        }

        /** ===============================
         * 4️⃣ NEW (UPDATED) DATA
         * =============================== */
        $newAmount = $paymentIn->amount;
        $newParty  = $paymentIn->parties;
        $newBank   = $paymentIn->payment_type;

        /** ===============================
         * 5️⃣ APPLY NEW EFFECT
         * =============================== */
        // Add to NEW bank
        if ($newBank) {
            $newBank->opening_balance =
                ($newBank->opening_balance ?? 0) + $newAmount;
            $newBank->save();
        }

        // Minus from NEW party
        if ($newParty) {
            $newParty->current_balance =
                ($newParty->current_balance ?? 0) - $newAmount;
            $newParty->save();
        }

        /** ===============================
         * 6️⃣ BANK TRANSACTION UPDATE
         * =============================== */
        BankTransaction::updateOrCreate(
            ['payment_in_id' => $paymentIn->id],
            [
                'party_id'        => $newParty?->id,
                'party_name'      => $newParty?->party_name,
                'payment_type_id' => $newBank?->id,
                'amount'          => $newAmount,
                'updated_by_id'   => auth()->id(),
                'description'     => $paymentIn->description,
                'json'            => json_encode([
                    'payment_in' => $paymentIn->toArray(),
                    'old' => [
                        'bank_id'  => $oldBank?->id,
                        'party_id' => $oldParty?->id,
                        'amount'   => $oldAmount,
                    ],
                    'new' => [
                        'bank_id'  => $newBank?->id,
                        'party_id' => $newParty?->id,
                        'amount'   => $newAmount,
                    ],
                ]),
            ]
        );
    });

    return redirect()
        ->route('admin.payment-ins.index')
        ->with('success', 'Payment In updated successfully. Bank & Party balances adjusted correctly.');
}


    public function destroy(PaymentIn $paymentIn)
    {
        $paymentIn->delete();
        return back()->with('success', 'Payment In deleted successfully.');
    }
}
