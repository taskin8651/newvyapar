<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyBankToBankRequest;
use App\Http\Requests\StoreBankToBankRequest;
use App\Http\Requests\UpdateBankToBankRequest;
use App\Models\BankAccount;
use App\Models\BankToBank;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class BankToBankController extends Controller
{
    use MediaUploadingTrait, CsvImportTrait;

    public function index()
    {
        abort_if(Gate::denies('bank_to_bank_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $bankToBanks = BankToBank::with(['from', 'to', 'created_by', 'media'])->get();

        return view('admin.bankToBanks.index', compact('bankToBanks'));
    }

    public function create()
    {
        abort_if(Gate::denies('bank_to_bank_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $froms = BankAccount::pluck('account_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $tos = BankAccount::pluck('account_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.bankToBanks.create', compact('froms', 'tos'));
    }

    public function store(StoreBankToBankRequest $request)
    {
        $bankToBank = BankToBank::create($request->all());

        if ($request->input('attechment', false)) {
            $bankToBank->addMedia(storage_path('tmp/uploads/' . basename($request->input('attechment'))))->toMediaCollection('attechment');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $bankToBank->id]);
        }

        return redirect()->route('admin.bank-to-banks.index');
    }

    public function edit(BankToBank $bankToBank)
    {
        abort_if(Gate::denies('bank_to_bank_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $froms = BankAccount::pluck('account_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $tos = BankAccount::pluck('account_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $bankToBank->load('from', 'to', 'created_by');

        return view('admin.bankToBanks.edit', compact('bankToBank', 'froms', 'tos'));
    }

    public function update(UpdateBankToBankRequest $request, BankToBank $bankToBank)
    {
        $bankToBank->update($request->all());

        if ($request->input('attechment', false)) {
            if (! $bankToBank->attechment || $request->input('attechment') !== $bankToBank->attechment->file_name) {
                if ($bankToBank->attechment) {
                    $bankToBank->attechment->delete();
                }
                $bankToBank->addMedia(storage_path('tmp/uploads/' . basename($request->input('attechment'))))->toMediaCollection('attechment');
            }
        } elseif ($bankToBank->attechment) {
            $bankToBank->attechment->delete();
        }

        return redirect()->route('admin.bank-to-banks.index');
    }

    public function show(BankToBank $bankToBank)
    {
        abort_if(Gate::denies('bank_to_bank_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $bankToBank->load('from', 'to', 'created_by');

        return view('admin.bankToBanks.show', compact('bankToBank'));
    }

    public function destroy(BankToBank $bankToBank)
    {
        abort_if(Gate::denies('bank_to_bank_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $bankToBank->delete();

        return back();
    }

    public function massDestroy(MassDestroyBankToBankRequest $request)
    {
        $bankToBanks = BankToBank::find(request('ids'));

        foreach ($bankToBanks as $bankToBank) {
            $bankToBank->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('bank_to_bank_create') && Gate::denies('bank_to_bank_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new BankToBank();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
