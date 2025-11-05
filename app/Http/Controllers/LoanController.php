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
        
        if ($user->hasRole('Loan Clerk')) {
            // Loan Clerk: Show NOTHING (after submit, they don't see it)
            $loans = collect(); // Empty collection
        } elseif ($user->hasRole('Loan OC')) {
            // Loan OC: Show only pending loans (submitted by Loan Clerk, not yet approved by OC)
            $loans = Loan::with(['creator', 'approver', 'rejecter'])
                ->where('status', 'pending')
                ->orderBy('created_at', 'desc')
                ->get();
        } elseif ($user->hasRole('Staff Officer')) {
            // Staff Officer: Show pending and rejected loans that are NOT in rejected_loans table
            $rejectedLoanIds = \App\Models\RejectedLoan::pluck('loan_id')->toArray();
            $loans = Loan::with(['creator', 'approver', 'rejecter'])
                ->whereIn('status', ['pending', 'rejected'])
                ->whereNotIn('id', $rejectedLoanIds)
                ->orderBy('created_at', 'desc')
                ->get();
        } elseif ($user->hasRole('Account SO')) {
            // Account SO: Show only oc_approved loans that are NOT in approved_loans table
            $approvedLoanIds = \App\Models\ApprovedLoan::pluck('loan_id')->toArray();
            $loans = Loan::with(['creator', 'approver', 'rejecter'])
                ->where('status', 'oc_approved')
                ->whereNotIn('id', $approvedLoanIds)
                ->orderBy('created_at', 'desc')
                ->get();
        } else {
            // Other roles: Show all loans
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
        $loanInterests = \App\Models\LoanInterest::orderBy('months', 'asc')->get();
        
        return view('loans.create', compact('ranks', 'units', 'loanInterests'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'loan_type' => 'required|in:100000,300000',
            'deduct_time_period' => 'required|in:4,8,12,24,36',
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
        $user = Auth::user();
        
        // Loan OC approval - changes status to 'oc_approved'
        if ($user->hasRole('Loan OC')) {
            if ($loan->status != 'pending') {
                return back()->with('error', 'Only pending applications can be approved.');
            }
            
            $loan->update([
                'status' => 'oc_approved',
                'oc_approved_by' => $user->id,
                'oc_approved_at' => now(),
            ]);
            
            return redirect()->route('loans.index')->with('success', 'Loan application approved and forwarded to Account SO.');
        }
        
        // Account SO approval - changes status to 'approved'
        if ($user->hasRole('Account SO')) {
            if ($loan->status != 'oc_approved') {
                return back()->with('error', 'Only OC approved applications can be approved by Account SO.');
            }
            
            // Get interest percentage from loan_interests table
            $loanInterest = \App\Models\LoanInterest::where('months', $loan->deduct_time_period)->first();
            $interestPercentage = $loanInterest ? $loanInterest->interest : 0;
            
            // Calculate amounts
            $loanAmount = floatval($loan->loan_type);
            $interestAmount = ($loanAmount * $interestPercentage) / 100;
            $totalAmount = $loanAmount + $interestAmount;
            $monthlyAmount = $totalAmount / intval($loan->deduct_time_period);
            
            // Initialize deductions array (all unchecked initially)
            $deductions = [];
            for ($i = 1; $i <= intval($loan->deduct_time_period); $i++) {
                $deductions[] = [
                    'month' => $i,
                    'checked' => false,
                    'amount' => round($monthlyAmount, 2)
                ];
            }
            
            // Create approved loan record
            \App\Models\ApprovedLoan::create([
                'loan_id' => $loan->id,
                'loan_method' => 'Cash',
                'loan_type' => $loanAmount,
                'deduct_time_period' => $loan->deduct_time_period,
                'interest_percentage' => $interestPercentage,
                'interest_amount' => $interestAmount,
                'total_amount' => $totalAmount,
                'monthly_amount' => $monthlyAmount,
                'member_name' => $loan->name,
                'member_enlisted_no' => $loan->enlisted_no,
                'member_regiment_no' => $loan->regiment_no,
                'member_army_id' => $loan->army_id,
                'guarantor1_name' => $loan->guarantor1_name,
                'guarantor1_enlisted_no' => $loan->guarantor1_enlisted_no,
                'guarantor1_regiment_no' => $loan->guarantor1_regiment_no,
                'guarantor1_army_id' => $loan->guarantor1_army_id,
                'guarantor2_name' => $loan->guarantor2_name,
                'guarantor2_enlisted_no' => $loan->guarantor2_enlisted_no,
                'guarantor2_regiment_no' => $loan->guarantor2_regiment_no,
                'guarantor2_army_id' => $loan->guarantor2_army_id,
                'deductions' => $deductions,
            ]);
            
            $loan->update([
                'status' => 'approved',
                'approved_by' => $user->id,
                'approved_at' => now(),
            ]);
            
            return redirect()->route('loans.index')->with('success', 'Loan application approved successfully.');
        }
        
        return back()->with('error', 'You do not have permission to approve applications.');
    }

    public function reject(Request $request, $id)
    {
        $request->validate([
            'rejection_reason' => 'required|string|max:1000',
        ]);
        
        $loan = Loan::findOrFail($id);
        $user = Auth::user();
        
        // Loan OC and Staff Officer can reject
        if (!$user->hasRole('Loan OC') && !$user->hasRole('Staff Officer')) {
            return back()->with('error', 'Only Loan OC and Staff Officer can reject applications.');
        }
        
        // For Staff Officer: Allow rejected status to store in rejected_loans table
        if ($user->hasRole('Staff Officer') && $loan->status == 'rejected') {
            // Check if already exists in rejected_loans table
            $existingRejection = \App\Models\RejectedLoan::where('loan_id', $loan->id)->first();
            
            if ($existingRejection) {
                return back()->with('error', 'This loan has already been stored in the Rejected Loans table.');
            }
            
            // Create rejected loan record
            \App\Models\RejectedLoan::create([
                'loan_id' => $loan->id,
                'loan_method' => 'Cash',
                'loan_type' => $loan->loan_type,
                'member_name' => $loan->name,
                'member_enlisted_no' => $loan->enlisted_no,
                'member_regiment_no' => $loan->regiment_no,
                'member_army_id' => $loan->army_id,
                'guarantor1_name' => $loan->guarantor1_name,
                'guarantor1_enlisted_no' => $loan->guarantor1_enlisted_no,
                'guarantor1_regiment_no' => $loan->guarantor1_regiment_no,
                'guarantor1_army_id' => $loan->guarantor1_army_id,
                'guarantor2_name' => $loan->guarantor2_name,
                'guarantor2_enlisted_no' => $loan->guarantor2_enlisted_no,
                'guarantor2_regiment_no' => $loan->guarantor2_regiment_no,
                'guarantor2_army_id' => $loan->guarantor2_army_id,
                'rejection_reason' => $loan->rejection_reason ?? $request->rejection_reason,
                'rejected_by' => $loan->rejected_by ?? Auth::id(),
                'rejected_at' => $loan->rejected_at ?? now(),
            ]);
            
            return redirect()->route('loans.index')->with('success', 'Rejected loan stored in Rejected Loans table successfully.');
        }
        
        // For pending loans
        if ($loan->status != 'pending') {
            return back()->with('error', 'Only pending applications can be rejected.');
        }
        
        // Update loan status
        $loan->update([
            'status' => 'rejected',
            'rejected_by' => Auth::id(),
            'rejection_reason' => $request->rejection_reason,
            'rejected_at' => now(),
        ]);
        
        // If rejected by Staff Officer, create rejected loan record
        if ($user->hasRole('Staff Officer')) {
            \App\Models\RejectedLoan::create([
                'loan_id' => $loan->id,
                'loan_method' => 'Cash',
                'loan_type' => $loan->loan_type,
                'member_name' => $loan->name,
                'member_enlisted_no' => $loan->enlisted_no,
                'member_regiment_no' => $loan->regiment_no,
                'member_army_id' => $loan->army_id,
                'guarantor1_name' => $loan->guarantor1_name,
                'guarantor1_enlisted_no' => $loan->guarantor1_enlisted_no,
                'guarantor1_regiment_no' => $loan->guarantor1_regiment_no,
                'guarantor1_army_id' => $loan->guarantor1_army_id,
                'guarantor2_name' => $loan->guarantor2_name,
                'guarantor2_enlisted_no' => $loan->guarantor2_enlisted_no,
                'guarantor2_regiment_no' => $loan->guarantor2_regiment_no,
                'guarantor2_army_id' => $loan->guarantor2_army_id,
                'rejection_reason' => $request->rejection_reason,
                'rejected_by' => Auth::id(),
                'rejected_at' => now(),
            ]);
        }
        
        return redirect()->route('loans.index')->with('success', 'Loan application rejected.');
    }

    public function check($id)
    {
        $loan = Loan::with(['creator', 'approver', 'rejecter'])->findOrFail($id);
        
        // All roles can view loans
        return view('loans.check', compact('loan'));
    }

    public function search(Request $request)
    {
        $enlistedNo = $request->input('enlisted_no');
        $armyId = $request->input('army_id');
        $excludeId = $request->input('exclude_id');
        
        if (!$enlistedNo && !$armyId) {
            return response()->json([
                'success' => false,
                'message' => 'Please provide either Enlisted No or Army ID'
            ]);
        }
        
        // Search in approved_loans table
        $query = \App\Models\ApprovedLoan::query();
        $searchCriteria = [];
        
        // Exclude current loan if specified
        if ($excludeId) {
            $query->where('loan_id', '!=', $excludeId);
        }
        
        if ($enlistedNo) {
            $query->where(function($q) use ($enlistedNo) {
                $q->where('member_enlisted_no', $enlistedNo)
                  ->orWhere('guarantor1_enlisted_no', $enlistedNo)
                  ->orWhere('guarantor2_enlisted_no', $enlistedNo);
            });
            $searchCriteria[] = "Enlisted No: $enlistedNo";
        }
        
        if ($armyId) {
            $query->where(function($q) use ($armyId) {
                $q->where('member_army_id', $armyId)
                  ->orWhere('guarantor1_army_id', $armyId)
                  ->orWhere('guarantor2_army_id', $armyId);
            });
            $searchCriteria[] = "Army ID: $armyId";
        }
        
        $approvedLoans = $query->with('loan')->orderBy('created_at', 'desc')->get();
        
        $results = $approvedLoans->map(function($approvedLoan) use ($enlistedNo, $armyId) {
            // Determine role
            $role = 'Unknown';
            $name = '';
            
            if (($enlistedNo && $approvedLoan->member_enlisted_no == $enlistedNo) || ($armyId && $approvedLoan->member_army_id == $armyId)) {
                $role = 'Member';
                $name = $approvedLoan->member_name;
            } elseif (($enlistedNo && $approvedLoan->guarantor1_enlisted_no == $enlistedNo) || ($armyId && $approvedLoan->guarantor1_army_id == $armyId)) {
                $role = 'Guarantor 1';
                $name = $approvedLoan->guarantor1_name;
            } elseif (($enlistedNo && $approvedLoan->guarantor2_enlisted_no == $enlistedNo) || ($armyId && $approvedLoan->guarantor2_army_id == $armyId)) {
                $role = 'Guarantor 2';
                $name = $approvedLoan->guarantor2_name;
            }
            
            // Calculate deduction status
            $deductions = $approvedLoan->deductions ?? [];
            $totalMonths = count($deductions);
            $paidMonths = collect($deductions)->where('checked', true)->count();
            $deductionStatus = "$paidMonths/$totalMonths";
            
            return [
                'id' => $approvedLoan->loan_id,
                'application_id' => $approvedLoan->loan ? $approvedLoan->loan->application_id : 'N/A',
                'name' => $name,
                'loan_type' => $approvedLoan->loan_type,
                'loan_type_formatted' => number_format($approvedLoan->loan_type),
                'total_amount' => number_format($approvedLoan->total_amount, 2),
                'monthly_amount' => number_format($approvedLoan->monthly_amount, 2),
                'deduct_time_period' => $approvedLoan->deduct_time_period,
                'interest_percentage' => $approvedLoan->interest_percentage,
                'role' => $role,
                'status' => 'Approved',
                'date' => $approvedLoan->created_at->format('Y-m-d'),
                'deduction_status' => $deductionStatus,
                'paid_months' => $paidMonths,
                'total_months' => $totalMonths,
            ];
        });
        
        return response()->json([
            'success' => true,
            'search_criteria' => implode(', ', $searchCriteria),
            'loans' => $results
        ]);
    }

    public function checkMembership($id)
    {
        $loan = Loan::with(['creator', 'approver', 'rejecter'])->findOrFail($id);
        
        // Get membership details using army_id (memberships table doesn't have enlisted_no)
        $memberMembership = \App\Models\Membership::where('army_id', $loan->army_id)->first();
        $guarantor1Membership = \App\Models\Membership::where('army_id', $loan->guarantor1_army_id)->first();
        $guarantor2Membership = \App\Models\Membership::where('army_id', $loan->guarantor2_army_id)->first();
        
        return view('loans.checkmembership', compact('loan', 'memberMembership', 'guarantor1Membership', 'guarantor2Membership'));
    }

    public function staffReview($id)
    {
        $loan = Loan::with(['creator', 'approver', 'rejecter'])->findOrFail($id);
        
        return view('loans.staffreview', compact('loan'));
    }
}
