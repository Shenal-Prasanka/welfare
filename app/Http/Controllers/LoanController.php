<?php

namespace App\Http\Controllers;

use App\Models\Loan;
use App\Models\Rank;
use App\Models\Unit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        
        if ($user->hasRole('Loan Clerk') || $user->hasRole('Loan OC')) {
            $loans = Loan::with(['creator', 'approver', 'rejecter'])
                ->where('unit_id', $user->unit_id)
                ->orderBy('created_at', 'desc')
                ->get();
        } else {
            $loans = Loan::with(['creator', 'approver', 'rejecter'])
                ->orderBy('created_at', 'desc')
                ->get();
        }
        
        return view('loans.index', compact('loans'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $ranks = Rank::where('active', 1)->orderBy('rank')->get();
        $units = Unit::where('active', 1)->orderBy('unit')->get();
        
        return view('loans.create', compact('ranks', 'units'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'loan_type' => 'required|in:100000,300000',
            'enlisted_no' => 'required|string|max:255',
            'regiment_no' => 'required|string|max:255',
            'rank' => 'required|string|max:255',
            'name' => 'required|string|max:255',
            'nic' => 'required|string|max:255',
            'army_id' => 'required|string|max:255',
            'office_address' => 'required|string',
            'previous_unit' => 'nullable|string|max:255',
            'welfare_membership' => 'required|in:Yes,No',
            'welfare_membership_date' => 'nullable|date',
            'bill_no' => 'nullable|string|max:255',
            'bill_date' => 'nullable|date',
            'enlisted_date' => 'required|date',
            'retire_date' => 'nullable|date',
            'paying_installments' => 'required|in:Yes,No',
            'bank_name' => 'required|string|max:255',
            'branch' => 'required|string|max:255',
            'account_no' => 'required|string|max:255',
            'mobile_no' => 'required|string|max:255',
            'land_no' => 'nullable|string|max:255',
            'consent_agreement' => 'required|accepted',
            'soldier_statement' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
            'guarantor1_enlisted_no' => 'required|string|max:255',
            'guarantor1_regiment_no' => 'required|string|max:255',
            'guarantor1_rank' => 'required|string|max:255',
            'guarantor1_name' => 'required|string|max:255',
            'guarantor1_nic' => 'required|string|max:255',
            'guarantor1_army_id' => 'required|string|max:255',
            'guarantor1_office_address' => 'required|string',
            'guarantor1_previous_unit' => 'nullable|string|max:255',
            'guarantor1_welfare_membership' => 'required|in:Yes,No',
            'guarantor1_enlisted_date' => 'required|date',
            'guarantor1_retire_date' => 'nullable|date',
            'guarantor2_enlisted_no' => 'required|string|max:255',
            'guarantor2_regiment_no' => 'required|string|max:255',
            'guarantor2_rank' => 'required|string|max:255',
            'guarantor2_name' => 'required|string|max:255',
            'guarantor2_nic' => 'required|string|max:255',
            'guarantor2_army_id' => 'required|string|max:255',
            'guarantor2_office_address' => 'required|string',
            'guarantor2_previous_unit' => 'nullable|string|max:255',
            'guarantor2_welfare_membership' => 'required|in:Yes,No',
            'guarantor2_enlisted_date' => 'required|date',
            'guarantor2_retire_date' => 'nullable|date',
        ]);

        // Handle file upload
        if ($request->hasFile('soldier_statement')) {
            $validated['soldier_statement'] = $request->file('soldier_statement')->store('loan_statements', 'public');
        }

        $validated['created_by'] = Auth::id();
        $validated['unit_id'] = Auth::user()->unit_id;
        $validated['status'] = 'pending';

        Loan::create($validated);

        return redirect()->route('loans.index')->with('success', 'Loan application submitted successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $loan = Loan::with(['creator', 'approver', 'rejecter'])->findOrFail($id);
        
        // Check access
        $user = Auth::user();
        if (($user->hasRole('Loan Clerk') || $user->hasRole('Loan OC')) && $loan->unit_id != $user->unit_id) {
            return redirect()->route('loans.index')->with('error', 'You can only view applications from your own unit.');
        }
        
        return view('loans.show', compact('loan'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $loan = Loan::findOrFail($id);
        
        // Only Loan Clerk can edit rejected applications
        if (!Auth::user()->hasRole('Loan Clerk')) {
            return redirect()->route('loans.index')->with('error', 'Only Loan Clerk can edit applications.');
        }
        
        if ($loan->status != 'rejected') {
            return redirect()->route('loans.index')->with('error', 'Only rejected applications can be edited.');
        }
        
        $ranks = Rank::where('active', 1)->orderBy('rank')->get();
        $units = Unit::where('active', 1)->orderBy('unit')->get();
        return view('loans.edit', compact('loan', 'ranks', 'units'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $loan = Loan::findOrFail($id);
        
        $validated = $request->validate([
            'loan_type' => 'required|in:100000,300000',
            'enlisted_no' => 'required|string|max:255',
            'regiment_no' => 'required|string|max:255',
            'rank' => 'required|string|max:255',
            'name' => 'required|string|max:255',
            'nic' => 'required|string|max:255',
            'army_id' => 'required|string|max:255',
            'office_address' => 'required|string',
            'previous_unit' => 'nullable|string|max:255',
            'welfare_membership' => 'required|in:Yes,No',
            'welfare_membership_date' => 'nullable|date',
            'bill_no' => 'nullable|string|max:255',
            'bill_date' => 'nullable|date',
            'enlisted_date' => 'required|date',
            'retire_date' => 'nullable|date',
            'paying_installments' => 'required|in:Yes,No',
            'bank_name' => 'required|string|max:255',
            'branch' => 'required|string|max:255',
            'account_no' => 'required|string|max:255',
            'mobile_no' => 'required|string|max:255',
            'land_no' => 'nullable|string|max:255',
            'consent_agreement' => 'required|accepted',
            'soldier_statement' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
            'guarantor1_enlisted_no' => 'required|string|max:255',
            'guarantor1_regiment_no' => 'required|string|max:255',
            'guarantor1_rank' => 'required|string|max:255',
            'guarantor1_name' => 'required|string|max:255',
            'guarantor1_nic' => 'required|string|max:255',
            'guarantor1_army_id' => 'required|string|max:255',
            'guarantor1_office_address' => 'required|string',
            'guarantor1_previous_unit' => 'nullable|string|max:255',
            'guarantor1_welfare_membership' => 'required|in:Yes,No',
            'guarantor1_enlisted_date' => 'required|date',
            'guarantor1_retire_date' => 'nullable|date',
            'guarantor2_enlisted_no' => 'required|string|max:255',
            'guarantor2_regiment_no' => 'required|string|max:255',
            'guarantor2_rank' => 'required|string|max:255',
            'guarantor2_name' => 'required|string|max:255',
            'guarantor2_nic' => 'required|string|max:255',
            'guarantor2_army_id' => 'required|string|max:255',
            'guarantor2_office_address' => 'required|string',
            'guarantor2_previous_unit' => 'nullable|string|max:255',
            'guarantor2_welfare_membership' => 'required|in:Yes,No',
            'guarantor2_enlisted_date' => 'required|date',
            'guarantor2_retire_date' => 'nullable|date',
        ]);

        // Handle file upload
        if ($request->hasFile('soldier_statement')) {
            $validated['soldier_statement'] = $request->file('soldier_statement')->store('loan_statements', 'public');
        }

        // Reset status to pending and clear rejection data
        $validated['status'] = 'pending';
        $validated['rejected_by'] = null;
        $validated['rejection_reason'] = null;
        $validated['rejected_at'] = null;

        $loan->update($validated);

        return redirect()->route('loans.index')->with('success', 'Loan application resubmitted successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function approve($id)
    {
        $loan = Loan::findOrFail($id);
        
        // Only Loan OC can approve
        if (!Auth::user()->hasRole('Loan OC')) {
            return back()->with('error', 'Only Loan OC can approve applications.');
        }
        
        if ($loan->status != 'pending') {
            return back()->with('error', 'Only pending applications can be approved.');
        }
        
        $loan->update([
            'status' => 'approved',
            'approved_by' => Auth::id(),
            'approved_at' => now(),
        ]);
        
        return redirect()->route('loans.index')->with('success', 'Loan application approved successfully.');
    }

    public function reject(Request $request, $id)
    {
        $request->validate([
            'rejection_reason' => 'required|string|max:1000',
        ]);
        
        $loan = Loan::findOrFail($id);
        
        // Only Loan OC can reject
        if (!Auth::user()->hasRole('Loan OC')) {
            return back()->with('error', 'Only Loan OC can reject applications.');
        }
        
        if ($loan->status != 'pending') {
            return back()->with('error', 'Only pending applications can be rejected.');
        }
        
        $loan->update([
            'status' => 'rejected',
            'rejected_by' => Auth::id(),
            'rejection_reason' => $request->rejection_reason,
            'rejected_at' => now(),
        ]);
        
        return redirect()->route('loans.index')->with('success', 'Loan application rejected.');
    }

    public function check($id)
    {
        $loan = Loan::with(['creator', 'approver', 'rejecter'])->findOrFail($id);
        
        // Check access
        $user = Auth::user();
        if (($user->hasRole('Loan Clerk') || $user->hasRole('Loan OC')) && $loan->unit_id != $user->unit_id) {
            return redirect()->route('loans.index')->with('error', 'You can only view applications from your own unit.');
        }
        
        return view('loans.check', compact('loan'));
    }
}
