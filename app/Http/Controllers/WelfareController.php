<?php

namespace App\Http\Controllers;
use App\Models\Welfare;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;

class WelfareController extends Controller
{   
    public function __construct()
    {
   
    $this->middleware(['permission:welfare-list'],["only"=>['index', 'show']]);
    $this->middleware(['permission:welfare-create'],["only"=>['create', 'store']]);
    $this->middleware(['permission:welfare-edit'],["only"=>['edit', 'update']]);
    $this->middleware(['permission:welfare-delete'],["only"=>['destroy']]);
    $this->middleware(['permission:welfare-approve'],["only"=>['toggleStatus']]);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $welfares = Welfare::where('delete', 0)->get(); // Return all non-deleted records
        return view('welfares.index', compact('welfares'));
    }

    //Active Deactive section
    public function toggleStatus($welfareId)
    {
       $welfare = Welfare::findOrFail($welfareId); // Find the welfare by ID
        if ($welfare)
         {
            if($welfare->active)
                {
                    $welfare->active = 0;
                }
            else
                {
                    $welfare->active = 1; 
                }
            $welfare->save(); // Save the changes
         }
            return back()->with('info', 'Welfare created successfully.');      
    }

    /**
     * Store a newly created resource in storage.
     */
  public function store(Request $request)
{
    $validated = $request->validate([
        'name' => 'required|string|unique:welfares,name',
        'location' => 'nullable|string',
    ]);

    $location = null;

    if (!empty($validated['location'])) {
        // Remove any spaces
        $location = str_replace(' ', '', $validated['location']);
        // Optional: validate format
        if (!preg_match('/^-?\d+(\.\d+)?,-?\d+(\.\d+)?$/', $location)) {
            return back()->withErrors(['location' => 'Invalid coordinates format']);
        }
    }

    Welfare::create([
        'name' => $validated['name'],
        'location' => $location,
    ]);

    return redirect()->route('welfares.index')->with('success', 'Welfare created successfully.');
}


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
         $request->validate([
            'name' => 'required|string|unique:welfares,name',
            'location' => 'nullable|string',
        ]);

        $welfare = Welfare::find($id);

        $welfare->name = $request->name;
        $welfare->location = $request->location;
        $welfare->save();
        return redirect()->route('welfares.index')->with('warning', 'welfare updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $welfare = Welfare::findOrFail($id);
        $welfare->delete = 1;
        $welfare->save();

    return redirect()->route('welfares.index')->with('error', 'Welfare deleted successfully!');
}
}
