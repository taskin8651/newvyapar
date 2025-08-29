<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyTaxRateRequest;
use App\Http\Requests\StoreTaxRateRequest;
use App\Http\Requests\UpdateTaxRateRequest;
use App\Models\TaxRate;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TaxRateController extends Controller
{
    use CsvImportTrait;

    public function index()
    {
        abort_if(Gate::denies('tax_rate_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $taxRates = TaxRate::with(['created_by'])->get();

        return view('admin.taxRates.index', compact('taxRates'));
    }

    public function create()
    {
        abort_if(Gate::denies('tax_rate_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.taxRates.create');
    }

    public function store(StoreTaxRateRequest $request)
    {
        $taxRate = TaxRate::create($request->all());

        return redirect()->route('admin.tax-rates.index');
    }

    public function edit(TaxRate $taxRate)
    {
        abort_if(Gate::denies('tax_rate_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $taxRate->load('created_by');

        return view('admin.taxRates.edit', compact('taxRate'));
    }

    public function update(UpdateTaxRateRequest $request, TaxRate $taxRate)
    {
        $taxRate->update($request->all());

        return redirect()->route('admin.tax-rates.index');
    }

    public function show(TaxRate $taxRate)
    {
        abort_if(Gate::denies('tax_rate_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $taxRate->load('created_by', 'selectTaxAddItems');

        return view('admin.taxRates.show', compact('taxRate'));
    }

    public function destroy(TaxRate $taxRate)
    {
        abort_if(Gate::denies('tax_rate_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $taxRate->delete();

        return back();
    }

    public function massDestroy(MassDestroyTaxRateRequest $request)
    {
        $taxRates = TaxRate::find(request('ids'));

        foreach ($taxRates as $taxRate) {
            $taxRate->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
