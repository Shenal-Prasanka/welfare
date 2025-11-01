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
        
        // Unit Clerk and Unit OC see only their unit's applications
        if ($user->hasRole('Unit Clerk') || $user->hasRole('Unit OC')) {
            $itemLoans = ItemLoan::with(['welfare', 'creator', 'approver', 'rejecter'])
                ->where('unit_id', $user->unit_id)
                ->latest()
                ->get();
        } else {
            // Admin sees all
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
        
        return view('itemloans.create', compact('welfares', 'categories', 'ranks'));
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
        if (!Auth::user()->hasRole('Unit Clerk') || $itemLoan->status != 'rejected') {
            return redirect()->route('itemloans.index')->with('error', 'You can only edit rejected applications.');
        }
        
        $welfares = Welfare::where('delete', 0)->orderBy('name')->get();
        $categories = Category::where('is_deleted', 0)->orderBy('category')->get();
        $ranks = \App\Models\Rank::where('is_deleted', 0)->orderBy('rank')->get();
        
        return view('itemloans.edit', compact('itemLoan', 'welfares', 'categories', 'ranks'));
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
        
        // Only Shop Coord Clerk can check membership
        if (!Auth::user()->hasRole('Shop Coord Clerk')) {
            return back()->with('error', 'Only Shop Coord Clerk can check membership.');
        }
        
        if ($itemLoan->status != 'oc_approved') {
            return back()->with('error', 'Only OC approved applications can be checked.');
        }
        
        $itemLoan->update([
            'membership_checked' => true,
        ]);
        
        return back()->with('success', 'Membership checked successfully.');
    }

    public function shopCoordApprove($id)
    {
        $itemLoan = ItemLoan::findOrFail($id);
        
        // Only Shop Coord Clerk can final approve
        if (!Auth::user()->hasRole('Shop Coord Clerk')) {
            return back()->with('error', 'Only Shop Coord Clerk can approve applications.');
        }
        
        if ($itemLoan->status != 'oc_approved') {
            return back()->with('error', 'Only OC approved applications can be approved.');
        }
        
        $itemLoan->update([
            'status' => 'approved',
            'shop_coord_approved_by' => Auth::id(),
            'shop_coord_approved_at' => now(),
        ]);
        
        return redirect()->route('itemloans.index')->with('success', 'Item loan application finally approved.');
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
            'status' => 'rejected',
            'rejected_by' => Auth::id(),
            'rejection_reason' => $request->rejection_reason,
            'rejected_at' => now(),
        ]);
        
        return redirect()->route('itemloans.index')->with('success', 'Item loan application rejected.');
    }
}
