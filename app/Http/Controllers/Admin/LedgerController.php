<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Ledger;
use App\Models\ExpenseCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LedgerController extends Controller
{
    public function index()
    {
        $ledgers = Ledger::with(['expense_category', 'created_by'])->latest()->get();
        return view('admin.ledgers.index', compact('ledgers'));
    }

    public function create()
    {
        $expenseCategories = ExpenseCategory::pluck('expense_category', 'id')->prepend('Please select', '');
        return view('admin.ledgers.create', compact('expenseCategories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'ledger_name' => 'required|string|max:255',
            'opening_balance' => 'nullable|numeric',
            'expense_category_id' => 'required|exists:expense_categories,id',
        ]);

        Ledger::create([
            'ledger_name' => $request->ledger_name,
            'opening_balance' => $request->opening_balance ?? 0,
            'expense_category_id' => $request->expense_category_id,
            'created_by_id' => Auth::id(),
        ]);

        return redirect()->route('admin.ledgers.index')->with('success', 'Ledger created successfully!');
    }

    public function edit(Ledger $ledger)
    {
        $expenseCategories = ExpenseCategory::pluck('expense_category', 'id')->prepend('Please select', '');
        return view('admin.ledgers.edit', compact('ledger', 'expenseCategories'));
    }

    public function update(Request $request, Ledger $ledger)
    {
        $request->validate([
            'ledger_name' => 'required|string|max:255',
            'opening_balance' => 'nullable|numeric',
            'expense_category_id' => 'required|exists:expense_categories,id',
        ]);

        $ledger->update([
            'ledger_name' => $request->ledger_name,
            'opening_balance' => $request->opening_balance ?? 0,
            'expense_category_id' => $request->expense_category_id,
            'updated_by_id' => Auth::id(),
        ]);

        return redirect()->route('admin.ledgers.index')->with('success', 'Ledger updated successfully!');
    }

    public function destroy(Ledger $ledger)
    {
        $ledger->delete();
        return back()->with('success', 'Ledger deleted successfully!');
    }
}
