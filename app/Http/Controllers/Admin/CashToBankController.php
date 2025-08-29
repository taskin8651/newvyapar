<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyCashToBankRequest;
use App\Http\Requests\StoreCashToBankRequest;
use App\Http\Requests\UpdateCashToBankRequest;
use App\Models\BankAccount;
use App\Models\CashToBank;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class CashToBankController extends Controller
{
    use MediaUploadingTrait, CsvImportTrait;

    public function index()
    {
        abort_if(Gate::denies('cash_to_bank_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $cashToBanks = CashToBank::with(['to', 'created_by', 'media'])->get();

        return view('admin.cashToBanks.index', compact('cashToBanks'));
    }

    public function create()
    {
        abort_if(Gate::denies('cash_to_bank_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $tos = BankAccount::pluck('account_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.cashToBanks.create', compact('tos'));
    }

    public function store(StoreCashToBankRequest $request)
    {
        $cashToBank = CashToBank::create($request->all());

        if ($request->input('attechment', false)) {
            $cashToBank->addMedia(storage_path('tmp/uploads/' . basename($request->input('attechment'))))->toMediaCollection('attechment');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $cashToBank->id]);
        }

        return redirect()->route('admin.cash-to-banks.index');
    }

    public function edit(CashToBank $cashToBank)
    {
        abort_if(Gate::denies('cash_to_bank_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $tos = BankAccount::pluck('account_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $cashToBank->load('to', 'created_by');

        return view('admin.cashToBanks.edit', compact('cashToBank', 'tos'));
    }

    public function update(UpdateCashToBankRequest $request, CashToBank $cashToBank)
    {
        $cashToBank->update($request->all());

        if ($request->input('attechment', false)) {
            if (! $cashToBank->attechment || $request->input('attechment') !== $cashToBank->attechment->file_name) {
                if ($cashToBank->attechment) {
                    $cashToBank->attechment->delete();
                }
                $cashToBank->addMedia(storage_path('tmp/uploads/' . basename($request->input('attechment'))))->toMediaCollection('attechment');
            }
        } elseif ($cashToBank->attechment) {
            $cashToBank->attechment->delete();
        }

        return redirect()->route('admin.cash-to-banks.index');
    }

    public function show(CashToBank $cashToBank)
    {
        abort_if(Gate::denies('cash_to_bank_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $cashToBank->load('to', 'created_by');

        return view('admin.cashToBanks.show', compact('cashToBank'));
    }

    public function destroy(CashToBank $cashToBank)
    {
        abort_if(Gate::denies('cash_to_bank_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $cashToBank->delete();

        return back();
    }

    public function massDestroy(MassDestroyCashToBankRequest $request)
    {
        $cashToBanks = CashToBank::find(request('ids'));

        foreach ($cashToBanks as $cashToBank) {
            $cashToBank->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('cash_to_bank_create') && Gate::denies('cash_to_bank_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new CashToBank();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
