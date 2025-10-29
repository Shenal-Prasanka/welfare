<?php

namespace App\Http\Controllers;

use App\Models\Membership;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission; 
use Carbon\Carbon;

class MembershipController extends Controller
{ 
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $memberships = Membership::where('is_deleted', 0)->get(); 
        return view('memberships.index', compact('memberships'));
    }

    public function toggleStatus($membershipId)
    {
        $membership = Membership::findOrFail($membershipId); 
        
        if ($membership)
        {
            // Check the current status before toggling
            if($membership->active)
            {
                // Current state is 1 (Pending/Active) -> Change to 0 (Approved)
                $membership->active = 0;
                
                // Store the current date when APPROVED
                $membership->membership_date = Carbon::now(); 
            }
            else
            {
                // Current state is 0 (Approved) -> Change to 1 (Pending/Active)
                $membership->active = 1; 
                
                // Optional: set the date back to null if membership is pending again
                // $membership->membership_date = null;
            }
            $membership->save(); 
        }
        return back()->with('info', 'Membership status updated successfully.'); 
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'nullable|email|unique:memberships,email', 
            'mobile' => 'required|string|max:20',
            'address' => 'nullable|string',
            'membership_date' => 'nullable|date',
            'army_id' => 'required|string|max:255|unique:memberships,army_id',
            'regiment_no' => 'nullable|string|max:255',
            'nic' => 'required|string|max:15|unique:memberships,nic',
            'active' => 'required|boolean',
        ]);

        Membership::create($request->all());

        return redirect()->route('memberships.index')->with('success', 'Membership created successfully.');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $membership = Membership::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'nullable|email|unique:memberships,email,' . $id, 
            'mobile' => 'required|string|max:20',
            'address' => 'nullable|string',
            'membership_date' => 'nullable|date',
            'army_id' => 'required|string|max:255|unique:memberships,army_id,' . $id, 
            'regiment_no' => 'nullable|string|max:255',
            'nic' => 'required|string|max:15|unique:memberships,nic,' . $id, 
            'active' => 'required|boolean',
        ]);


        // FIX APPLIED HERE: Use the instance method $membership->update()
        $membership->update($request->all());

        return redirect()->route('memberships.index')->with('warning', 'Membership updated successfully.');
    }

    /**
     * Remove the specified resource from storage (Soft Delete).
     */
    public function destroy(string $id)
    {
        $membership = Membership::findOrFail($id);
        $membership->is_deleted = 1;
        $membership->save();

        return redirect()->route('memberships.index')->with('error', 'Membership deleted successfully!');
    }
}