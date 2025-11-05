<?php

namespace App\Http\Controllers;

use App\Models\LoanInterest;
use Illuminate\Http\Request;

class LoanInterestController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $loanInterests = LoanInterest::orderBy('months', 'asc')->get();
        return view('loaninterests.index', compact('loanInterests'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('loaninterests.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'months' => 'required|in:4,8,12,24,36|unique:loan_interests,months',
            'interest' => 'required|numeric|min:0|max:100',
        ]);

        LoanInterest::create($validated);

        return redirect()->route('loaninterests.index')->with('success', 'Loan interest created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(LoanInterest $loaninterest)
    {
        return view('loaninterests.show', compact('loaninterest'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(LoanInterest $loaninterest)
    {
        return view('loaninterests.edit', compact('loaninterest'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, LoanInterest $loaninterest)
    {
        $validated = $request->validate([
            'months' => 'required|in:4,8,12,24,36|unique:loan_interests,months,' . $loaninterest->id,
            'interest' => 'required|numeric|min:0|max:100',
        ]);

        $loaninterest->update($validated);

        return redirect()->route('loaninterests.index')->with('success', 'Loan interest updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(LoanInterest $loaninterest)
    {
        $loaninterest->delete();
        return redirect()->route('loaninterests.index')->with('success', 'Loan interest deleted successfully.');
    }
}
