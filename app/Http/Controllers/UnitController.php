<?php

namespace App\Http\Controllers;
use App\Models\Unit;
use App\Models\Regement;
use App\Services\NotificationService;
use Illuminate\Http\Request;

class UnitController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
         // Fetch all units with their regements
        $units = Unit::with('regement')->get(); // eager load regement
        $regements = Regement::with('units')->get(); // Fetch all regements

        $units = Unit::where('is_deleted', 0)->get(); // Return all non-deleted records
        return view('units.index', compact('units','regements'));
    }

    //Active Deactive section
    public function active($unitId)
    {
       $unit = Unit::find($unitId); // Find the rank by ID
        if ($unit)
         {
            if($unit->active)
                {
                    $unit->active = 0;
                }
            else
                {
                    $unit->active = 1; 
                }
            $unit->save(); // Save the changes
         }
            return back()->with('info', 'Unit created successfully.');       
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $regements = Regement::all();
        return view('units.add', compact('regements'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
         $request->validate([
            'unit' => 'required|string|unique:units,unit',
            'regement_id' => 'required|exists:regements,id',
        ]);

        $unit = Unit::create([
            'unit' => $request->unit,
            'regement_id' => $request->regement_id,
            'active' => 1,
        ]);

        // Send notification to all staff
        NotificationService::unitAdded($unit->unit);

        return redirect()->route('units.index')->with('success', 'Unit created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
         $unit = Unit::find($id);
        return view('units.show', compact('unit'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $regements = Regement::all();
        $unit = Unit::find($id);
        return view('units.edit', compact('unit', 'regements'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
         $request->validate([
            'unit' => 'required|string|unique:units,unit,' . $id,
            'regement_id' => 'required|exists:regements,id',
        ]);


        $unit = Unit::find($id);

        $unit->unit = $request->unit;
        $unit->regement_id = $request->regement_id;
        $unit->active = 1;
        $unit->save();

        return redirect()->route('units.index')->with('warning', 'Unit updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $unit = Unit::findOrFail($id);
        $unit->is_deleted = 1;
        $unit->save();

    return redirect()->route('units.index')->with('error', 'Unit deleted successfully!');
    }
}
