<?php

namespace App\Http\Controllers;
use App\Models\Supply;
use App\Models\PurchaseOrder;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;

class PurchaseOrderController extends Controller
{
    public function __construct()
    {
    $this->middleware(['permission:order-list'],["only"=>['index', 'show']]);
    $this->middleware(['permission:order-create'],["only"=>['create', 'store']]);
    $this->middleware(['permission:order-edit'],["only"=>['edit', 'update']]);
    $this->middleware(['permission:order-reject'],["only"=>['reject']]);
    $this->middleware(['permission:order-approve'],["only"=>['aprove']]);
    }
   
    /**
     * Display a listing of the resource.
     */
public function index()
{
    $user = auth()->user();

    if ($user->hasRole('Welfare Shop Clerk') || $user->hasRole('Welfare Shop OC')) {
        // Show only purchase orders related to their welfare
        $purchaseOrders = PurchaseOrder::where('welfare',  auth()->user()->welfare->name)
            ->latest()
            ->get();
    } else {
        // Other roles can see all
        $purchaseOrders = PurchaseOrder::latest()->get();
    }

    return view('purchase_order.index', compact('purchaseOrders'));
}



    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $supplys = Supply::all(); // fetch all suppliers
        return view('purchase_order.add', compact('supplys'));
    }

    /**
     * Store a newly created resource in storage.
     */
public function store(Request $request)
{
   $validated = $request->validate([
    'date'          => 'required|date',
    'welfare'       => 'required|string|max:255',
    'supply_id'     => 'required|integer',
    'supplier_code' => 'required|string|max:255',
    'item_name'     => 'required|array',
    'model'         => 'required|array',
    'qty'           => 'required|array',
    'welfare_price' => 'required|array',
    'welfare_total' => 'required|array',
    'mrp'           => 'required|array',
    'mrp_total'     => 'required|array',
]);

PurchaseOrder::create([
    'date'          => $validated['date'],
    'welfare'       => $validated['welfare'],     
    'supply_id'     => $validated['supply_id'],
    'supplier_code' => $validated['supplier_code'],
    'items'         => $validated['item_name'],   
    'models'        => $validated['model'],
    'quantities'    => $validated['qty'],
    'welfare_price' => $validated['welfare_price'],
    'welfare_total' => $validated['welfare_total'],
    'mrp'           => $validated['mrp'],
    'mrp_total'     => $validated['mrp_total'],
]);


    return redirect()->route('purchaseorder.index')
                     ->with('success', 'Purchase order created successfully.');
}



    /**
     * Display the specified resource.
     */
    public function show(PurchaseOrder $purchaseOrder)
    {
        return view('purchaseorders.show', compact('purchaseOrder'));
    }

    /**
     * Show the form for editing the specified resource.
     */
  public function edit(PurchaseOrder $purchaseorder)
{
    $supplys = Supply::all();

    // Pass variable with the name used in your blade
    return view('purchase_order.edit', [
        'purchaseOrder' => $purchaseorder, // note the key matches Blade
        'supplys' => $supplys
    ]);
}


public function update(Request $request, PurchaseOrder $purchaseorder)
{
    $validated = $request->validate([
        'date'          => 'required|date',
        'welfare'       => 'required|string|max:255',
        'supply_id'     => 'required|integer',
        'supplier_code' => 'required|string|max:255',
        'item_name'     => 'required|array',
        'model'         => 'required|array',
        'qty'           => 'required|array',
        'welfare_price' => 'required|array',
        'welfare_total' => 'required|array',
        'mrp'           => 'required|array',
        'mrp_total'     => 'required|array',
        
    ]);

    $purchaseorder->update([
        'date'          => $validated['date'],
        'welfare'       => $validated['welfare'],
        'supply_id'     => $validated['supply_id'],
        'supplier_code' => $validated['supplier_code'],
        'items'         => $validated['item_name'],
        'models'        => $validated['model'],
        'quantities'    => $validated['qty'],
        'welfare_price' => $validated['welfare_price'],
        'welfare_total' => $validated['welfare_total'],
        'mrp'           => $validated['mrp'],
        'mrp_total'     => $validated['mrp_total'],
    ]);

    return redirect()->route('purchaseorder.edit', $purchaseorder->id)
                     ->with('success', 'Purchase order updated successfully.');
}


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PurchaseOrder $purchaseOrder)
    {
        $purchaseOrder->delete();
        return redirect()->route('purchaseorder.index')
                         ->with('success', 'Purchase order deleted successfully.');
    }

    public function approve($purchaseOrderId)
{
    $purchaseOrder = PurchaseOrder::findOrFail($purchaseOrderId);

    // If less than 4, increase by 1
    if ($purchaseOrder->active < 4) {
        $purchaseOrder->active += 1;
    }

    $purchaseOrder->save();

    return redirect()->route('purchaseorder.index')->with('success', 'Purchase order approved successfully.');
}

public function reject($purchaseOrderId)
{
    $purchaseOrder = PurchaseOrder::findOrFail($purchaseOrderId);

    // Reject: set to 0
    $purchaseOrder->active = 0;

    $purchaseOrder->save();

    return redirect()->route('purchaseorder.index')->with('error', 'Purchase order rejected.');
}

}
