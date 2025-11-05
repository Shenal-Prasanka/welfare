<?php

namespace App\Http\Controllers;

use App\Models\ItemLoan;
use App\Models\Welfare;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ItemLoanController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        
        // Unit Clerk sees only shop_coord_oc_rejected applications from their unit
        if ($user->hasRole('Unit Clerk')) {
            $itemLoans = ItemLoan::with(['welfare', 'creator', 'approver', 'rejecter'])
                ->where('unit_id', $user->unit_id)
                ->where('status', 'shop_coord_oc_rejected')
                ->latest()
                ->get();
        }
        // Unit OC sees only pending applications from their unit (not shop_coord_rejected)
        elseif ($user->hasRole('Unit OC')) {
            $itemLoans = ItemLoan::with(['welfare', 'creator', 'approver', 'rejecter'])
                ->where('unit_id', $user->unit_id)
                ->where('status', 'pending')
                ->latest()
                ->get();
        }
        // Shop Coord Clerk sees only oc_approved applications
        elseif ($user->hasRole('Shop Coord Clerk')) {
            $itemLoans = ItemLoan::with(['welfare', 'creator', 'approver', 'rejecter'])
                ->where('status', 'oc_approved')
                ->latest()
                ->get();
        }
        // Shop Coord OC sees only shop_coord_clerk_approved applications
        elseif ($user->hasRole('Shop Coord OC')) {
            $itemLoans = ItemLoan::with(['welfare', 'creator', 'approver', 'rejecter'])
                ->where('status', 'shop_coord_clerk_approved')
                ->latest()
                ->get();
        }
        // Welfare Shop Clerk sees only shop_coord_oc_approved applications from their welfare shop
        elseif ($user->hasRole('Welfare Shop Clerk')) {
            $itemLoans = ItemLoan::with(['welfare', 'creator', 'approver', 'rejecter'])
                ->where('status', 'shop_coord_oc_approved')
                ->where('welfare_id', $user->welfare_id)
                ->latest()
                ->get();
        }
        // Staff Officer sees only rejected applications from Shop Coord
        elseif ($user->hasRole('Staff Officer')) {
            $itemLoans = ItemLoan::with(['welfare', 'creator', 'approver', 'rejecter'])
                ->where('status', 'shop_coord_rejected')
                ->latest()
                ->get();
        }
        else {
            // Admin and others see all
            $itemLoans = ItemLoan::with(['welfare', 'creator', 'approver', 'rejecter'])
                ->latest()
                ->get();
        }
        
        return view('itemloans.index', compact('itemLoans'));
    }

    public function create()
    {
        $welfares = Welfare::where('delete', 0)->orderBy('name')->get();
        $categories = Category::where('is_deleted', 0)->orderBy('category')->get();
        $ranks = \App\Models\Rank::where('is_deleted', 0)->orderBy('rank')->get();
        $units = \App\Models\Unit::where('is_deleted', 0)->orderBy('unit')->get();
        $loanInterests = \App\Models\LoanInterest::orderBy('months')->get();
        
        return view('itemloans.create', compact('welfares', 'categories', 'ranks', 'units', 'loanInterests'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
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
            'required_welfare_item_category' => 'nullable|string|max:255',
            'welfare_id' => 'nullable|exists:welfares,id',
            'item_name' => 'nullable|string|max:255',
            'item_type' => 'nullable|string|max:255',
            'model_no' => 'nullable|string|max:255',
            'mobile_no' => 'required|string|max:255',
            'land_no' => 'nullable|string|max:255',
            'paying_installments' => 'required|in:Yes,No',
            'deduct_time_period' => 'nullable|string|max:255',
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
            $validated['soldier_statement'] = $request->file('soldier_statement')->store('soldier_statements', 'public');
        }

        $validated['created_by'] = Auth::id();
        $validated['unit_id'] = Auth::user()->unit_id;
        $validated['status'] = 'pending';

        ItemLoan::create($validated);

        return redirect()->route('itemloans.index')->with('success', 'Item loan application submitted successfully.');
    }

    public function show($id)
    {
        $itemLoan = ItemLoan::with(['welfare', 'creator', 'approver', 'rejecter'])->findOrFail($id);
        
        // Check access
        $user = Auth::user();
        if (($user->hasRole('Unit Clerk') || $user->hasRole('Unit OC')) && $itemLoan->unit_id != $user->unit_id) {
            return redirect()->route('itemloans.index')->with('error', 'You can only view applications from your own unit.');
        }
        
        return view('itemloans.show', compact('itemLoan'));
    }

    public function edit($id)
    {
        $itemLoan = ItemLoan::findOrFail($id);
        
        // Only Unit Clerk can edit rejected applications
        if (!Auth::user()->hasRole('Unit Clerk') || !in_array($itemLoan->status, ['rejected', 'shop_coord_oc_rejected'])) {
            return redirect()->route('itemloans.index')->with('error', 'You can only edit rejected applications.');
        }
        
        $welfares = Welfare::where('delete', 0)->orderBy('name')->get();
        $categories = Category::where('is_deleted', 0)->orderBy('category')->get();
        $ranks = \App\Models\Rank::where('is_deleted', 0)->orderBy('rank')->get();
        $units = \App\Models\Unit::where('is_deleted', 0)->orderBy('unit')->get();
        
        return view('itemloans.edit', compact('itemLoan', 'welfares', 'categories', 'ranks', 'units'));
    }

    public function update(Request $request, $id)
    {
        $itemLoan = ItemLoan::findOrFail($id);
        
        $validated = $request->validate([
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
            'required_welfare_item_category' => 'nullable|string|max:255',
            'welfare_id' => 'nullable|exists:welfares,id',
            'item_name' => 'nullable|string|max:255',
            'item_type' => 'nullable|string|max:255',
            'model_no' => 'nullable|string|max:255',
            'mobile_no' => 'required|string|max:255',
            'land_no' => 'nullable|string|max:255',
            'paying_installments' => 'required|in:Yes,No',
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
            // Delete old file
            if ($itemLoan->soldier_statement) {
                Storage::disk('public')->delete($itemLoan->soldier_statement);
            }
            $validated['soldier_statement'] = $request->file('soldier_statement')->store('soldier_statements', 'public');
        }

        // Reset status to pending when resubmitting
        $validated['status'] = 'pending';
        $validated['rejected_by'] = null;
        $validated['rejection_reason'] = null;
        $validated['rejected_at'] = null;

        $itemLoan->update($validated);

        return redirect()->route('itemloans.index')->with('success', 'Item loan application resubmitted successfully.');
    }

    public function approve($id)
    {
        $itemLoan = ItemLoan::findOrFail($id);
        
        // Only Unit OC can approve
        if (!Auth::user()->hasRole('Unit OC')) {
            return back()->with('error', 'Only Unit OC can approve applications.');
        }
        
        if ($itemLoan->status != 'pending') {
            return back()->with('error', 'Only pending applications can be approved.');
        }
        
        $itemLoan->update([
            'status' => 'oc_approved',
            'approved_by' => Auth::id(),
            'approved_at' => now(),
        ]);
        
        return redirect()->route('itemloans.index')->with('success', 'Item loan application approved and sent to Shop Coord Clerk.');
    }

    public function reject(Request $request, $id)
    {
        $request->validate([
            'rejection_reason' => 'required|string|max:1000',
        ]);
        
        $itemLoan = ItemLoan::findOrFail($id);
        
        // Only Unit OC can reject
        if (!Auth::user()->hasRole('Unit OC')) {
            return back()->with('error', 'Only Unit OC can reject applications.');
        }
        
        if ($itemLoan->status != 'pending') {
            return back()->with('error', 'Only pending applications can be rejected.');
        }
        
        $itemLoan->update([
            'status' => 'rejected',
            'rejected_by' => Auth::id(),
            'rejection_reason' => $request->rejection_reason,
            'rejected_at' => now(),
        ]);
        
        return redirect()->route('itemloans.index')->with('success', 'Item loan application rejected.');
    }

    public function checkLoan($id)
    {
        $itemLoan = ItemLoan::with(['welfare', 'creator', 'approver', 'rejecter'])->findOrFail($id);
        
        // Only Shop Coord Clerk can check loan
        if (!Auth::user()->hasRole('Shop Coord Clerk')) {
            return back()->with('error', 'Only Shop Coord Clerk can check loan.');
        }
        
        if ($itemLoan->status != 'oc_approved') {
            return back()->with('error', 'Only OC approved applications can be checked.');
        }
        
        // Mark loan as checked
        $itemLoan->update([
            'loan_checked' => true,
        ]);
        
        // Redirect to check loan view
        return view('itemloans.checkloan', compact('itemLoan'));
    }

    public function checkMembership($id)
    {
        $itemLoan = ItemLoan::findOrFail($id);
        
        // Get membership details from welfare_memberships table using army_id
        $memberMembership = \App\Models\WelfareMembership::where('army_id', $itemLoan->army_id)->first();
        $guarantor1Membership = \App\Models\WelfareMembership::where('army_id', $itemLoan->guarantor1_army_id)->first();
        $guarantor2Membership = \App\Models\WelfareMembership::where('army_id', $itemLoan->guarantor2_army_id)->first();
        
        return view('itemloans.checkmembership', compact('itemLoan', 'memberMembership', 'guarantor1Membership', 'guarantor2Membership'));
    }

    public function shopCoordApprove($id)
    {
        $itemLoan = ItemLoan::findOrFail($id);
        
        // Only Shop Coord Clerk can approve
        if (!Auth::user()->hasRole('Shop Coord Clerk')) {
            return back()->with('error', 'Only Shop Coord Clerk can approve applications.');
        }
        
        if ($itemLoan->status != 'oc_approved') {
            return back()->with('error', 'Only OC approved applications can be approved.');
        }
        
        $itemLoan->update([
            'status' => 'shop_coord_clerk_approved',
            'shop_coord_approved_by' => Auth::id(),
            'shop_coord_approved_at' => now(),
        ]);
        
        return redirect()->route('itemloans.index')->with('success', 'Item loan application approved and sent to Shop Coord OC.');
    }

    public function shopCoordOCApprove($id)
    {
        $itemLoan = ItemLoan::findOrFail($id);
        
        // Only Shop Coord OC can approve
        if (!Auth::user()->hasRole('Shop Coord OC')) {
            return back()->with('error', 'Only Shop Coord OC can approve applications.');
        }
        
        if ($itemLoan->status != 'shop_coord_clerk_approved') {
            return back()->with('error', 'Only Shop Coord Clerk approved applications can be approved.');
        }
        
        $itemLoan->update([
            'status' => 'shop_coord_oc_approved',
            'shop_coord_oc_approved_by' => Auth::id(),
            'shop_coord_oc_approved_at' => now(),
        ]);
        
        return redirect()->route('itemloans.index')->with('success', 'Item loan application approved and sent to Welfare Shop Clerk.');
    }

    public function clerkApprove($id)
    {
        $itemLoan = ItemLoan::findOrFail($id);
        
        // Only Welfare Shop Clerk can approve
        if (!Auth::user()->hasRole('Welfare Shop Clerk')) {
            return back()->with('error', 'Only Welfare Shop Clerk can approve applications.');
        }
        
        if ($itemLoan->status != 'shop_coord_oc_approved') {
            return back()->with('error', 'Only Shop Coord OC approved applications can be approved.');
        }
        
        // Get loan interest details
        $loanInterest = \App\Models\LoanInterest::where('months', $itemLoan->deduct_time_period)->first();
        $interestPercentage = $loanInterest ? $loanInterest->interest : 0;
        
        // Use a default price for calculation (will be updated when item is issued)
        $itemPrice = 0; // Will be set to 0 until actual item is selected
        
        // Calculate interest and total
        $interestAmount = ($itemPrice * $interestPercentage) / 100;
        $totalAmount = $itemPrice + $interestAmount;
        $monthlyAmount = $itemLoan->deduct_time_period > 0 ? $totalAmount / $itemLoan->deduct_time_period : 0;
        
        // Create approved loan record
        \App\Models\ApprovedLoan::create([
            'item_loan_id' => $itemLoan->id,
            'loan_method' => 'Item',
            'loan_type' => $itemPrice,
            'deduct_time_period' => $itemLoan->deduct_time_period,
            'interest_percentage' => $interestPercentage,
            'interest_amount' => $interestAmount,
            'total_amount' => $totalAmount,
            'monthly_amount' => $monthlyAmount,
            
            // Member details
            'member_name' => $itemLoan->name,
            'member_enlisted_no' => $itemLoan->enlisted_no,
            'member_regiment_no' => $itemLoan->regiment_no,
            'member_army_id' => $itemLoan->army_id,
            
            // Guarantor 1 details
            'guarantor1_name' => $itemLoan->guarantor1_name,
            'guarantor1_enlisted_no' => $itemLoan->guarantor1_enlisted_no,
            'guarantor1_regiment_no' => $itemLoan->guarantor1_regiment_no,
            'guarantor1_army_id' => $itemLoan->guarantor1_army_id,
            
            // Guarantor 2 details
            'guarantor2_name' => $itemLoan->guarantor2_name,
            'guarantor2_enlisted_no' => $itemLoan->guarantor2_enlisted_no,
            'guarantor2_regiment_no' => $itemLoan->guarantor2_regiment_no,
            'guarantor2_army_id' => $itemLoan->guarantor2_army_id,
            
            // Deductions (initialize as empty array)
            'deductions' => [],
        ]);
        
        // Update item loan status to clerk_approved
        $itemLoan->update([
            'status' => 'clerk_approved',
            'final_approved_by' => Auth::id(),
            'final_approved_at' => now(),
        ]);
        
        return redirect()->route('itemloans.issue', $itemLoan->id)->with('success', 'Application approved successfully. Please select an item to issue.');
    }

    public function issue($id)
    {
        $itemLoan = ItemLoan::findOrFail($id);
        
        // Only Welfare Shop Clerk can issue
        if (!Auth::user()->hasRole('Welfare Shop Clerk')) {
            return back()->with('error', 'Only Welfare Shop Clerk can issue items.');
        }
        
        if (!in_array($itemLoan->status, ['shop_coord_oc_approved', 'clerk_approved'])) {
            return back()->with('error', 'Only approved applications can be issued.');
        }
        
        // Get stock items filtered by requested item name
        $requestedItemName = $itemLoan->item_name;
        
        $welfareItems = \App\Models\Stock::where('status', 'available')
            ->when($requestedItemName, function($query) use ($requestedItemName) {
                // Filter by item name (case-insensitive partial match)
                $query->where('item_name', 'LIKE', '%' . $requestedItemName . '%');
            })
            ->with(['product.category', 'welfare'])
            ->get();
        
        // Get all categories for filter
        $categories = \App\Models\Category::all();
        
        // Get loan interests
        $loanInterests = \App\Models\LoanInterest::all();
        
        return view('itemloans.issue', compact('itemLoan', 'welfareItems', 'categories', 'loanInterests'));
    }

    public function invoice(Request $request, $id)
    {
        $itemLoan = ItemLoan::findOrFail($id);
        
        // Get stock item from query parameter
        $stockId = $request->query('stock_id');
        $stock = \App\Models\Stock::findOrFail($stockId);
        
        // Get loan interest details
        $loanInterest = \App\Models\LoanInterest::where('months', $itemLoan->deduct_time_period)->first();
        $interestPercentage = $loanInterest ? $loanInterest->interest : 0;
        
        // Calculate amounts
        $itemPrice = $stock->item_welfare_price;
        $interestAmount = ($itemPrice * $interestPercentage) / 100;
        $totalAmount = $itemPrice + $interestAmount;
        $monthlyAmount = $itemLoan->deduct_time_period > 0 ? $totalAmount / $itemLoan->deduct_time_period : 0;
        
        return view('itemloans.invoice', compact(
            'itemLoan',
            'stock',
            'interestPercentage',
            'interestAmount',
            'totalAmount',
            'monthlyAmount'
        ));
    }

    public function processIssue(Request $request, $id)
    {
        $request->validate([
            'stock_id' => 'required|exists:stocks,id',
        ]);
        
        $itemLoan = ItemLoan::findOrFail($id);
        
        // Only Welfare Shop Clerk can process issue
        if (!Auth::user()->hasRole('Welfare Shop Clerk')) {
            return back()->with('error', 'Only Welfare Shop Clerk can process issue.');
        }
        
        if ($itemLoan->status != 'shop_coord_oc_approved') {
            return back()->with('error', 'Only Shop Coord OC approved applications can be processed.');
        }
        
        // Get selected stock item
        $stock = \App\Models\Stock::findOrFail($request->stock_id);
        
        // Check stock availability
        if ($stock->status != 'available') {
            return back()->with('error', 'Selected item is not available.');
        }
        
        // Get loan interest details
        $loanInterest = \App\Models\LoanInterest::where('months', $itemLoan->deduct_time_period)->first();
        $interestPercentage = $loanInterest ? $loanInterest->interest : 0;
        
        // Get item price from selected stock item
        $itemPrice = $stock->item_welfare_price;
        
        // Calculate interest and total
        $interestAmount = ($itemPrice * $interestPercentage) / 100;
        $totalAmount = $itemPrice + $interestAmount;
        $monthlyAmount = $itemLoan->deduct_time_period > 0 ? $totalAmount / $itemLoan->deduct_time_period : 0;
        
        // Create monthly deduction schedule
        $deductions = [];
        $startDate = now();
        for ($i = 1; $i <= $itemLoan->deduct_time_period; $i++) {
            $deductions[] = [
                'month' => $i,
                'due_date' => $startDate->copy()->addMonths($i)->format('Y-m-d'),
                'amount' => round($monthlyAmount, 2),
                'status' => 'pending',
                'paid_amount' => 0,
                'paid_date' => null,
            ];
        }
        
        // Create or update approved loan record
        $approvedLoan = \App\Models\ApprovedLoan::updateOrCreate(
            ['item_loan_id' => $itemLoan->id],
            [
                'loan_method' => 'Item',
                'user_id' => $itemLoan->created_by,
                'stock_id' => $stock->id,
                'member_name' => $itemLoan->name,
                'member_nic' => $itemLoan->nic,
                'member_army_id' => $itemLoan->army_id,
                'member_enlisted_no' => $itemLoan->enlisted_no,
                'member_regiment_no' => $itemLoan->regiment_no,
                'member_rank' => $itemLoan->rank,
                'guarantor1_name' => $itemLoan->guarantor1_name,
                'guarantor1_nic' => $itemLoan->guarantor1_nic,
                'guarantor1_army_id' => $itemLoan->guarantor1_army_id,
                'guarantor1_enlisted_no' => $itemLoan->guarantor1_enlisted_no,
                'guarantor1_regiment_no' => $itemLoan->guarantor1_regiment_no,
                'guarantor1_rank' => $itemLoan->guarantor1_rank,
                'guarantor2_name' => $itemLoan->guarantor2_name,
                'guarantor2_nic' => $itemLoan->guarantor2_nic,
                'guarantor2_army_id' => $itemLoan->guarantor2_army_id,
                'guarantor2_enlisted_no' => $itemLoan->guarantor2_enlisted_no,
                'guarantor2_regiment_no' => $itemLoan->guarantor2_regiment_no,
                'guarantor2_rank' => $itemLoan->guarantor2_rank,
                'loan_type' => $itemPrice,
                'interest_percentage' => $interestPercentage,
                'interest_amount' => $interestAmount,
                'total_amount' => $totalAmount,
                'monthly_amount' => $monthlyAmount,
                'deduct_time_period' => $itemLoan->deduct_time_period,
                'deductions' => json_encode($deductions),
                'status' => 'approved',
                'approved_by' => Auth::id(),
                'approved_at' => now(),
            ]
        );
        
        // Create PersonIssued record with all details
        \App\Models\PersonIssued::create([
            'item_loan_id' => $itemLoan->id,
            'approved_loan_id' => $approvedLoan->id,
            'stock_id' => $stock->id,
            // Member details
            'member_enlisted_no' => $itemLoan->enlisted_no,
            'member_enlisted_date' => $itemLoan->enlisted_date,
            'member_name' => $itemLoan->name,
            'member_rank' => $itemLoan->rank,
            'member_regiment_no' => $itemLoan->regiment_no,
            'member_nic' => $itemLoan->nic,
            'member_army_id' => $itemLoan->army_id,
            'member_previous_unit' => $itemLoan->previous_unit,
            // Guarantor 1 details
            'guarantor1_enlisted_no' => $itemLoan->guarantor1_enlisted_no,
            'guarantor1_enlisted_date' => $itemLoan->guarantor1_enlisted_date,
            'guarantor1_name' => $itemLoan->guarantor1_name,
            'guarantor1_rank' => $itemLoan->guarantor1_rank,
            'guarantor1_regiment_no' => $itemLoan->guarantor1_regiment_no,
            'guarantor1_nic' => $itemLoan->guarantor1_nic,
            'guarantor1_army_id' => $itemLoan->guarantor1_army_id,
            'guarantor1_previous_unit' => $itemLoan->guarantor1_previous_unit,
            // Guarantor 2 details
            'guarantor2_enlisted_no' => $itemLoan->guarantor2_enlisted_no,
            'guarantor2_enlisted_date' => $itemLoan->guarantor2_enlisted_date,
            'guarantor2_name' => $itemLoan->guarantor2_name,
            'guarantor2_rank' => $itemLoan->guarantor2_rank,
            'guarantor2_regiment_no' => $itemLoan->guarantor2_regiment_no,
            'guarantor2_nic' => $itemLoan->guarantor2_nic,
            'guarantor2_army_id' => $itemLoan->guarantor2_army_id,
            'guarantor2_previous_unit' => $itemLoan->guarantor2_previous_unit,
            // Item details
            'item_code' => $stock->item_code,
            'item_name' => $stock->item_name,
            'item_model' => $stock->item_model,
            'serial_number' => $stock->serial_number,
            'category' => $stock->item_category,
        ]);
        
        // Update stock status to issued
        $stock->update([
            'status' => 'issued',
        ]);
        
        // Update item loan status to approved (final approval)
        $itemLoan->update([
            'status' => 'approved',
            'final_approved_by' => Auth::id(),
            'final_approved_at' => now(),
        ]);
        
        return redirect()->route('itemloans.index')->with('success', 'Item loan approved successfully! Item has been issued and all records created.');
    }

    public function shopCoordOCReject(Request $request, $id)
    {
        $request->validate([
            'rejection_reason' => 'required|string|max:1000',
        ]);
        
        $itemLoan = ItemLoan::findOrFail($id);
        
        // Only Shop Coord OC can reject
        if (!Auth::user()->hasRole('Shop Coord OC')) {
            return back()->with('error', 'Only Shop Coord OC can reject applications.');
        }
        
        if ($itemLoan->status != 'shop_coord_clerk_approved') {
            return back()->with('error', 'Only Shop Coord Clerk approved applications can be rejected.');
        }
        
        $itemLoan->update([
            'status' => 'shop_coord_oc_rejected',
            'rejected_by' => Auth::id(),
            'rejection_reason' => $request->rejection_reason,
            'rejected_at' => now(),
        ]);
        
        return redirect()->route('itemloans.index')->with('success', 'Item loan application rejected and sent back to Unit Clerk.');
    }

    public function shopCoordReject(Request $request, $id)
    {
        $request->validate([
            'rejection_reason' => 'required|string|max:1000',
        ]);
        
        $itemLoan = ItemLoan::findOrFail($id);
        
        // Only Shop Coord Clerk can reject
        if (!Auth::user()->hasRole('Shop Coord Clerk')) {
            return back()->with('error', 'Only Shop Coord Clerk can reject applications.');
        }
        
        if ($itemLoan->status != 'oc_approved') {
            return back()->with('error', 'Only OC approved applications can be rejected.');
        }
        
        $itemLoan->update([
            'status' => 'shop_coord_rejected',
            'rejected_by' => Auth::id(),
            'rejection_reason' => $request->rejection_reason,
            'rejected_at' => now(),
        ]);
        
        return redirect()->route('itemloans.index')->with('success', 'Item loan application rejected and sent to Staff Officer.');
    }

    public function staffOfficerReject(Request $request, $id)
    {
        $itemLoan = ItemLoan::findOrFail($id);
        
        // Only Staff Officer can reject
        if (!Auth::user()->hasRole('Staff Officer')) {
            return back()->with('error', 'Only Staff Officer can reject applications.');
        }
        
        if ($itemLoan->status != 'shop_coord_rejected') {
            return back()->with('error', 'Only Shop Coord rejected applications can be rejected by Staff Officer.');
        }
        
        // Store in rejected_loans table using existing rejection reason from Shop Coord
        \App\Models\RejectedLoan::create([
            'item_loan_id' => $itemLoan->id,
            'loan_method' => 'Item',
            'loan_type' => 0, // Item loans don't have amount, set to 0
            'product_name' => $itemLoan->item_name, // Store item name as product name
            'member_name' => $itemLoan->name,
            'member_enlisted_no' => $itemLoan->enlisted_no,
            'member_regiment_no' => $itemLoan->regiment_no,
            'member_army_id' => $itemLoan->army_id,
            'guarantor1_name' => $itemLoan->guarantor1_name,
            'guarantor1_enlisted_no' => $itemLoan->guarantor1_enlisted_no,
            'guarantor1_regiment_no' => $itemLoan->guarantor1_regiment_no,
            'guarantor1_army_id' => $itemLoan->guarantor1_army_id,
            'guarantor2_name' => $itemLoan->guarantor2_name,
            'guarantor2_enlisted_no' => $itemLoan->guarantor2_enlisted_no,
            'guarantor2_regiment_no' => $itemLoan->guarantor2_regiment_no,
            'guarantor2_army_id' => $itemLoan->guarantor2_army_id,
            'rejection_reason' => $itemLoan->rejection_reason, // Use existing rejection reason from Shop Coord
            'rejected_by' => Auth::id(),
            'rejected_at' => now(),
        ]);
        
        // Update item loan status
        $itemLoan->update([
            'status' => 'rejected',
            'rejected_by' => Auth::id(),
            'rejected_at' => now(),
        ]);
        
        return redirect()->route('itemloans.index')->with('success', 'Item loan application rejected and stored in Rejected Loans table.');
    }
}
