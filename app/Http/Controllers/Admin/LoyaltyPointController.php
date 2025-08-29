<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyLoyaltyPointRequest;
use App\Http\Requests\StoreLoyaltyPointRequest;
use App\Http\Requests\UpdateLoyaltyPointRequest;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class LoyaltyPointController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('loyalty_point_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.loyaltyPoints.index');
    }

    public function create()
    {
        abort_if(Gate::denies('loyalty_point_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.loyaltyPoints.create');
    }

    public function store(StoreLoyaltyPointRequest $request)
    {
        $loyaltyPoint = LoyaltyPoint::create($request->all());

        return redirect()->route('admin.loyalty-points.index');
    }

    public function edit(LoyaltyPoint $loyaltyPoint)
    {
        abort_if(Gate::denies('loyalty_point_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.loyaltyPoints.edit', compact('loyaltyPoint'));
    }

    public function update(UpdateLoyaltyPointRequest $request, LoyaltyPoint $loyaltyPoint)
    {
        $loyaltyPoint->update($request->all());

        return redirect()->route('admin.loyalty-points.index');
    }

    public function show(LoyaltyPoint $loyaltyPoint)
    {
        abort_if(Gate::denies('loyalty_point_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.loyaltyPoints.show', compact('loyaltyPoint'));
    }

    public function destroy(LoyaltyPoint $loyaltyPoint)
    {
        abort_if(Gate::denies('loyalty_point_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $loyaltyPoint->delete();

        return back();
    }

    public function massDestroy(MassDestroyLoyaltyPointRequest $request)
    {
        $loyaltyPoints = LoyaltyPoint::find(request('ids'));

        foreach ($loyaltyPoints as $loyaltyPoint) {
            $loyaltyPoint->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
