<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StoreExpenseListRequest;
use App\Http\Requests\UpdateExpenseListRequest;
use App\Http\Resources\Admin\ExpenseListResource;
use App\Models\ExpenseList;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ExpenseListApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('expense_list_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new ExpenseListResource(ExpenseList::with(['category', 'payment', 'created_by'])->get());
    }

    public function store(StoreExpenseListRequest $request)
    {
        $expenseList = ExpenseList::create($request->all());

        return (new ExpenseListResource($expenseList))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(ExpenseList $expenseList)
    {
        abort_if(Gate::denies('expense_list_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new ExpenseListResource($expenseList->load(['category', 'payment', 'created_by']));
    }

    public function update(UpdateExpenseListRequest $request, ExpenseList $expenseList)
    {
        $expenseList->update($request->all());

        return (new ExpenseListResource($expenseList))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(ExpenseList $expenseList)
    {
        abort_if(Gate::denies('expense_list_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $expenseList->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
