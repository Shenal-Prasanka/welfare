<?php

namespace App\Http\Controllers;
use App\Models\Regement;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class RegementController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $regements = Regement::where('is_deleted', 0)->get(); // Return all non-deleted records
        return view('regements.index', compact('regements'));
    }

    //Active Deactive section
    public function active($regementId)
    {
       $regement = Regement::find($regementId); // Find the rank by ID
        if ($regement)
         {
            if($regement->active)
                {
                    $regement->active = 0;
                }
            else
                {
                    $regement->active = 1; 
                }
            $regement->save(); // Save the changes
         }
            return back()->with('info', 'Regement Approved successfully.');       
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
 
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
         $request->validate([
            'regement' => 'required|string|unique:regements,regement',
            'active' => 'required|boolean',
        ]);

        Regement::create([
            'regement' => $request->regement,
            'active' => $request->active,
        ]);

        return redirect()->route('regements.index')->with('success', 'Regement created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
         $request->validate([
            'regement' => 'required|unique:regements,regement',
            'active' => 'required|boolean',
        ]);

        $regement = Regement::find($id);

        $regement->regement = $request->regement;
        $regement->active =$request->active;
        $regement->save();

        return redirect()->route('regements.index')->with('warning', 'Regement updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $regement = Regement::findOrFail($id);
        $regement->is_deleted = 1;
        $regement->save();

    return redirect()->route('regements.index')->with('error', 'Regement deleted successfully!');
    }
    
}
