<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyCashInHandRequest;
use App\Http\Requests\StoreCashInHandRequest;
use App\Http\Requests\UpdateCashInHandRequest;
use App\Models\CashInHand;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class CashInHandController extends Controller
{
    use MediaUploadingTrait, CsvImportTrait;

    public function index()
    {
        abort_if(Gate::denies('cash_in_hand_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $cashInHands = CashInHand::with(['created_by'])->get();

        return view('admin.cashInHands.index', compact('cashInHands'));
    }

    public function create()
    {
        abort_if(Gate::denies('cash_in_hand_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.cashInHands.create');
    }

    public function store(StoreCashInHandRequest $request)
    {
        $cashInHand = CashInHand::create($request->all());

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $cashInHand->id]);
        }

        return redirect()->route('admin.cash-in-hands.index');
    }

    public function edit(CashInHand $cashInHand)
    {
        abort_if(Gate::denies('cash_in_hand_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $cashInHand->load('created_by');

        return view('admin.cashInHands.edit', compact('cashInHand'));
    }

    public function update(UpdateCashInHandRequest $request, CashInHand $cashInHand)
    {
        $cashInHand->update($request->all());

        return redirect()->route('admin.cash-in-hands.index');
    }

    public function show(CashInHand $cashInHand)
    {
        abort_if(Gate::denies('cash_in_hand_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $cashInHand->load('created_by');

        return view('admin.cashInHands.show', compact('cashInHand'));
    }

    public function destroy(CashInHand $cashInHand)
    {
        abort_if(Gate::denies('cash_in_hand_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $cashInHand->delete();

        return back();
    }

    public function massDestroy(MassDestroyCashInHandRequest $request)
    {
        $cashInHands = CashInHand::find(request('ids'));

        foreach ($cashInHands as $cashInHand) {
            $cashInHand->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('cash_in_hand_create') && Gate::denies('cash_in_hand_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new CashInHand();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
