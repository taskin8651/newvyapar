<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TermAndCondition;
use Illuminate\Http\Request;

class TermAndConditionController extends Controller
{
    // List all terms
    public function index()
    {
        $terms = TermAndCondition::all();
        return view('admin.terms.index', compact('terms'));
    }

    // Show create form
    public function create()
    {
        return view('admin.terms.create');
    }

    // Store new term
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required',
            'status' => 'required|in:active,inactive',
        ]);

        TermAndCondition::create($request->all());

        return redirect()->route('admin.terms.index')->with('success', 'Term added successfully.');
    }

    // Show edit form
    public function edit(TermAndCondition $term)
    {
        return view('admin.terms.edit', compact('term'));
    }

    // Update term
    public function update(Request $request, TermAndCondition $term)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required',
            'status' => 'required|in:active,inactive',
        ]);

        $term->update($request->all());

        return redirect()->route('admin.terms.index')->with('success', 'Term updated successfully.');
    }

    // Delete term
    public function destroy(TermAndCondition $term)
    {
        $term->delete();
        return redirect()->route('admin.terms.index')->with('success', 'Term deleted successfully.');
    }
}
