<?php

namespace App\Http\Controllers;
use App\Models\Supply;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;

class SupplyController extends Controller
{   
    public function __construct()
    {
    $this->middleware(['permission:supplier-list'],["only"=>['index', 'show']]);
    $this->middleware(['permission:supplier-create'],["only"=>['create', 'store']]);
    $this->middleware(['permission:supplier-edit'],["only"=>['edit', 'update']]);
    $this->middleware(['permission:supplier-delete'],["only"=>['destroy']]);
    $this->middleware(['permission:supplier-approve'],["only"=>['toggleStatus']]);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $supplys = Supply::where('is_deleted', 0)->get(); // only get not deleted
        return view('supplys.index', compact('supplys'));
    }

        //Active Deactive section
    public function toggleStatus($supplyId)
    {
       $supply = Supply::findOrFail($supplyId); // Find the rank by ID
        if ($supply)
         {
            if($supply->active)
                {
                    $supply->active = 0;
                }
            else
                {
                    $supply->active = 1; 
                }
            $supply->save(); // Save the changes
         }
            return back()->with('info', 'Supply created successfully.');      
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'supply' => 'required|string|unique:supplys,supply',
            'active' => 'required|boolean',
            'description' => 'nullable|string',
        ]);

        Supply::create([
            'supply' => $request->supply,
            'active' => $request->active,
            'description' => $request->description,
        ]);

        return redirect()->route('supplys.index')->with('success', 'Supply created successfully.');
    }


   

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'supply' => 'required|string|unique:supplys,supply',
            'active' => 'required|boolean',
            'description' => 'nullable|string',
        ]);

            $supply = Supply::find($id);

            $supply->supply = $request->supply;
            $supply->active = $request->active;
            $supply->description =$request->description;
            $supply->save();  

        return redirect()->route('supplys.index')->with('warning', 'Supply updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $supply = Supply::findOrFail($id);
        $supply->is_deleted = 1;
        $supply->save();

        return redirect()->route('supplys.index')->with('error', 'Supply deleted successfully!');
    }
}
