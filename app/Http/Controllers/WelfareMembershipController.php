<?php

namespace App\Http\Controllers;

use App\Models\WelfareMembership;
use Illuminate\Http\Request;
use Carbon\Carbon;

class WelfareMembershipController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $welfarememberships = WelfareMembership::where('is_deleted', 0)->get();
        return view('welfarememberships.index', compact('welfarememberships'));
    }

    /**
     * Toggle membership status (Pending / Approved)
     */
    public function toggleStatus($id)
    {
        $welfaremembership = WelfareMembership::findOrFail($id);

        if ($welfaremembership->active) {
            // Currently active → deactivate (approve)
            $welfaremembership->active = 0;
            $welfaremembership->membership_date = Carbon::now();
        } else {
            // Currently inactive → activate (pending)
            $welfaremembership->active = 1;
            // Optionally clear date
            // $welfaremembership->membership_date = null;
        }

        $welfaremembership->save();

        return back()->with('info', 'Welfare Welfare membership status updated successfully.');
    }

    /**
     * Store a newly created resource.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'nullable|email|unique:welfare_memberships,email',
            'mobile' => 'required|string|max:20',
            'address' => 'nullable|string',
            'membership_date' => 'nullable|date',
            'army_id' => 'required|string|max:255|unique:welfare_memberships,army_id',
            'regiment_no' => 'nullable|string|max:255',
            'nic' => 'required|string|max:15|unique:welfare_memberships,nic',
            'active' => 'required|boolean',
        ]);

        WelfareMembership::create($request->all());

        return redirect()->route('welfarememberships.index')->with('success', 'welfare Membership created successfully.');
    }

    /**
     * Update the specified resource.
     */
    public function update(Request $request, string $id)
    {
        $welfaremembership = WelfareMembership::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'nullable|email|unique:welfare_memberships,email,' . $id,
            'mobile' => 'required|string|max:20',
            'address' => 'nullable|string',
            'membership_date' => 'nullable|date',
            'army_id' => 'required|string|max:255|unique:welfare_memberships,army_id,' . $id,
            'regiment_no' => 'nullable|string|max:255',
            'nic' => 'required|string|max:15|unique:welfare_memberships,nic,' . $id,
            'active' => 'required|boolean',
        ]);

        $welfaremembership->update($request->all());

        return redirect()->route('welfarememberships.index')->with('warning', 'Welfare Membership updated successfully.');
    }

    /**
     * Soft delete a record.
     */
    public function destroy(string $id)
    {
        $welfaremembership = WelfareMembership::findOrFail($id);
        $welfaremembership->is_deleted = 1;
        $welfaremembership->save();

        return redirect()->route('welfarememberships.index')->with('error', 'Welfare Membership deleted successfully!');
    }
}
