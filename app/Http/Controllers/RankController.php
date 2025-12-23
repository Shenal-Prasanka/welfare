<?php

namespace App\Http\Controllers;
use App\Models\Rank;
use App\Services\NotificationService;
use Illuminate\Http\Request;

class RankController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $ranks = Rank::where('is_deleted', 0)->get(); // Return all non-deleted records
        return view('ranks.index', compact('ranks'));
    }

    //Active Deactive section
    public function active($rankId)
    {
       $rank = Rank::find($rankId); // Find the rank by ID
        if ($rank)
         {
            if($rank->active)
                {
                    $rank->active = 0;
                }
            else
                {
                    $rank->active = 1; 
                }
            $rank->save();
         }
            return back()->with('info', 'Rank created successfully.');      
    }

  
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
         $request->validate([
            'rank' => 'required|string|unique:ranks,rank',
            'type' => 'required|string',
            'active' => 'required|boolean',
        ]);

        $rank = Rank::create([
            'rank' => $request->rank,
            'type' => $request->type,
            'active' => $request->active,
        ]);

        // Send notification to all staff
        NotificationService::rankAdded($rank->rank);

        return redirect()->route('ranks.index')->with('success', 'Rank created successfully.');
    }

    

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
         $request->validate([
            'rank' => 'required|string|unique:ranks,rank',
            'type' => 'required|string',
            'active' => 'required|boolean',
        ]);

        $rank = Rank::find($id);

        $rank->rank = $request->rank;
        $rank->type = $request->type;
        $rank->active =$request->active;
        $rank->save();

        return redirect()->route('ranks.index')->with('warning', 'Rank updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $rank = Rank::findOrFail($id);
        $rank->is_deleted = 1;
        $rank->save();

    return redirect()->route('ranks.index')->with('error', 'Rank deleted successfully!');
    }
}
