<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyBankToCashRequest;
use App\Http\Requests\StoreBankToCashRequest;
use App\Http\Requests\UpdateBankToCashRequest;
use App\Models\BankAccount;
use App\Models\BankToCash;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class BankToCashController extends Controller
{
    use MediaUploadingTrait, CsvImportTrait;

    public function index()
    {
        abort_if(Gate::denies('bank_to_cash_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $bankToCashes = BankToCash::with(['from', 'created_by', 'media'])->get();

        return view('admin.bankToCashes.index', compact('bankToCashes'));
    }

    public function create()
    {
        abort_if(Gate::denies('bank_to_cash_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $froms = BankAccount::pluck('account_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.bankToCashes.create', compact('froms'));
    }

    public function store(StoreBankToCashRequest $request)
    {
        $bankToCash = BankToCash::create($request->all());

        if ($request->input('attechment', false)) {
            $bankToCash->addMedia(storage_path('tmp/uploads/' . basename($request->input('attechment'))))->toMediaCollection('attechment');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $bankToCash->id]);
        }

        return redirect()->route('admin.bank-to-cashes.index');
    }

    public function edit(BankToCash $bankToCash)
    {
        abort_if(Gate::denies('bank_to_cash_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $froms = BankAccount::pluck('account_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $bankToCash->load('from', 'created_by');

        return view('admin.bankToCashes.edit', compact('bankToCash', 'froms'));
    }

    public function update(UpdateBankToCashRequest $request, BankToCash $bankToCash)
    {
        $bankToCash->update($request->all());

        if ($request->input('attechment', false)) {
            if (! $bankToCash->attechment || $request->input('attechment') !== $bankToCash->attechment->file_name) {
                if ($bankToCash->attechment) {
                    $bankToCash->attechment->delete();
                }
                $bankToCash->addMedia(storage_path('tmp/uploads/' . basename($request->input('attechment'))))->toMediaCollection('attechment');
            }
        } elseif ($bankToCash->attechment) {
            $bankToCash->attechment->delete();
        }

        return redirect()->route('admin.bank-to-cashes.index');
    }

    public function show(BankToCash $bankToCash)
    {
        abort_if(Gate::denies('bank_to_cash_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $bankToCash->load('from', 'created_by');

        return view('admin.bankToCashes.show', compact('bankToCash'));
    }

    public function destroy(BankToCash $bankToCash)
    {
        abort_if(Gate::denies('bank_to_cash_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $bankToCash->delete();

        return back();
    }

    public function massDestroy(MassDestroyBankToCashRequest $request)
    {
        $bankToCashes = BankToCash::find(request('ids'));

        foreach ($bankToCashes as $bankToCash) {
            $bankToCash->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('bank_to_cash_create') && Gate::denies('bank_to_cash_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new BankToCash();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
