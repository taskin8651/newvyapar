<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyWhatsappConnectRequest;
use App\Http\Requests\StoreWhatsappConnectRequest;
use App\Http\Requests\UpdateWhatsappConnectRequest;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class WhatsappConnectController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('whatsapp_connect_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.whatsappConnects.index');
    }

    public function create()
    {
        abort_if(Gate::denies('whatsapp_connect_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.whatsappConnects.create');
    }

    public function store(StoreWhatsappConnectRequest $request)
    {
        $whatsappConnect = WhatsappConnect::create($request->all());

        return redirect()->route('admin.whatsapp-connects.index');
    }

    public function edit(WhatsappConnect $whatsappConnect)
    {
        abort_if(Gate::denies('whatsapp_connect_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.whatsappConnects.edit', compact('whatsappConnect'));
    }

    public function update(UpdateWhatsappConnectRequest $request, WhatsappConnect $whatsappConnect)
    {
        $whatsappConnect->update($request->all());

        return redirect()->route('admin.whatsapp-connects.index');
    }

    public function show(WhatsappConnect $whatsappConnect)
    {
        abort_if(Gate::denies('whatsapp_connect_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.whatsappConnects.show', compact('whatsappConnect'));
    }

    public function destroy(WhatsappConnect $whatsappConnect)
    {
        abort_if(Gate::denies('whatsapp_connect_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $whatsappConnect->delete();

        return back();
    }

    public function massDestroy(MassDestroyWhatsappConnectRequest $request)
    {
        $whatsappConnects = WhatsappConnect::find(request('ids'));

        foreach ($whatsappConnects as $whatsappConnect) {
            $whatsappConnect->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
