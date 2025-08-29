<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyDayBookRequest;
use App\Http\Requests\StoreDayBookRequest;
use App\Http\Requests\UpdateDayBookRequest;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class DayBookController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('day_book_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.dayBooks.index');
    }

    public function create()
    {
        abort_if(Gate::denies('day_book_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.dayBooks.create');
    }

    public function store(StoreDayBookRequest $request)
    {
        $dayBook = DayBook::create($request->all());

        return redirect()->route('admin.day-books.index');
    }

    public function edit(DayBook $dayBook)
    {
        abort_if(Gate::denies('day_book_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.dayBooks.edit', compact('dayBook'));
    }

    public function update(UpdateDayBookRequest $request, DayBook $dayBook)
    {
        $dayBook->update($request->all());

        return redirect()->route('admin.day-books.index');
    }

    public function show(DayBook $dayBook)
    {
        abort_if(Gate::denies('day_book_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.dayBooks.show', compact('dayBook'));
    }

    public function destroy(DayBook $dayBook)
    {
        abort_if(Gate::denies('day_book_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $dayBook->delete();

        return back();
    }

    public function massDestroy(MassDestroyDayBookRequest $request)
    {
        $dayBooks = DayBook::find(request('ids'));

        foreach ($dayBooks as $dayBook) {
            $dayBook->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
