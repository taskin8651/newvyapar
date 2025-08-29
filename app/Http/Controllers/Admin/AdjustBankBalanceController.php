<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyAdjustBankBalanceRequest;
use App\Http\Requests\StoreAdjustBankBalanceRequest;
use App\Http\Requests\UpdateAdjustBankBalanceRequest;
use App\Models\AdjustBankBalance;
use App\Models\BankAccount;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class AdjustBankBalanceController extends Controller
{
    use MediaUploadingTrait, CsvImportTrait;

    public function index()
    {
        abort_if(Gate::denies('adjust_bank_balance_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $adjustBankBalances = AdjustBankBalance::with(['from', 'created_by', 'media'])->get();

        return view('admin.adjustBankBalances.index', compact('adjustBankBalances'));
    }

    public function create()
    {
        abort_if(Gate::denies('adjust_bank_balance_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $froms = BankAccount::pluck('account_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.adjustBankBalances.create', compact('froms'));
    }

    public function store(StoreAdjustBankBalanceRequest $request)
    {
        $adjustBankBalance = AdjustBankBalance::create($request->all());

        if ($request->input('attechment', false)) {
            $adjustBankBalance->addMedia(storage_path('tmp/uploads/' . basename($request->input('attechment'))))->toMediaCollection('attechment');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $adjustBankBalance->id]);
        }

        return redirect()->route('admin.adjust-bank-balances.index');
    }

    public function edit(AdjustBankBalance $adjustBankBalance)
    {
        abort_if(Gate::denies('adjust_bank_balance_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $froms = BankAccount::pluck('account_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $adjustBankBalance->load('from', 'created_by');

        return view('admin.adjustBankBalances.edit', compact('adjustBankBalance', 'froms'));
    }

    public function update(UpdateAdjustBankBalanceRequest $request, AdjustBankBalance $adjustBankBalance)
    {
        $adjustBankBalance->update($request->all());

        if ($request->input('attechment', false)) {
            if (! $adjustBankBalance->attechment || $request->input('attechment') !== $adjustBankBalance->attechment->file_name) {
                if ($adjustBankBalance->attechment) {
                    $adjustBankBalance->attechment->delete();
                }
                $adjustBankBalance->addMedia(storage_path('tmp/uploads/' . basename($request->input('attechment'))))->toMediaCollection('attechment');
            }
        } elseif ($adjustBankBalance->attechment) {
            $adjustBankBalance->attechment->delete();
        }

        return redirect()->route('admin.adjust-bank-balances.index');
    }

    public function show(AdjustBankBalance $adjustBankBalance)
    {
        abort_if(Gate::denies('adjust_bank_balance_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $adjustBankBalance->load('from', 'created_by');

        return view('admin.adjustBankBalances.show', compact('adjustBankBalance'));
    }

    public function destroy(AdjustBankBalance $adjustBankBalance)
    {
        abort_if(Gate::denies('adjust_bank_balance_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $adjustBankBalance->delete();

        return back();
    }

    public function massDestroy(MassDestroyAdjustBankBalanceRequest $request)
    {
        $adjustBankBalances = AdjustBankBalance::find(request('ids'));

        foreach ($adjustBankBalances as $adjustBankBalance) {
            $adjustBankBalance->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('adjust_bank_balance_create') && Gate::denies('adjust_bank_balance_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new AdjustBankBalance();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
