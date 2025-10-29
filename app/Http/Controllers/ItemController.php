<?php

namespace App\Http\Controllers;
use App\Models\Item;
use App\Models\Product;
use App\Models\Welfare;
use Illuminate\Http\Request;


class ItemController extends Controller
{
   
    /**
     * Display a listing of the resource.
     */

public function index()
{
    $items = Item::latest()->get();
    $products = Product::all();
    $welfares = Welfare::all();

    return view('items.index', compact('items', 'products', 'welfares'));
}

  //Active Deactive section
public function toggleStatus($itemId)
{
    $item = Item::findOrFail($itemId);

    // Only change if item is currently in stock
    if ($item->active) {
        $item->active = 0; // Mark as Issued
        $item->save();
        return back()->with('info', 'Item has been issued.');
    }

    // If already issued, do nothing
    return back()->with('info', 'Item is already issued.');
}



public function store(Request $request)
{
    $request->validate([
        'product_id' => 'required|exists:products,id',
        'welfare_id' => 'required|exists:welfares,id',
        'serial_number' => 'required|string|unique:items,serial_number',
        'added_date' => 'required|date',
        'issued_date' => 'nullable|date|after_or_equal:added_date',
        'active' => 'required|boolean',
    ]);

    Item::create([
        'product_id' => $request->product_id,
        'welfare_id' => $request->welfare_id,
        'serial_number' => $request->serial_number,
        'added_date' => $request->added_date,
        'issued_date' => $request->issued_date,
        'active' => $request->active,
    ]);

    return redirect()->route('items.index')->with('success', 'Item created successfully.');
}


public function update(Request $request, string $id)
{
    $request->validate([
        'product_id' => 'required|exists:products,id',
        'welfare_id' => 'required|exists:welfares,id',
        'serial_number' => 'required|string|unique:items,serial_number,' . $id,
        'added_date' => 'required|date',
        'issued_date' => 'nullable|date|after_or_equal:added_date',
        'active' => 'required|boolean',
    ]);

    $item = Item::findOrFail($id);

    $item->product_id = $request->product_id;
    $item->welfare_id = $request->welfare_id;
    $item->serial_number = $request->serial_number;
    $item->added_date = $request->added_date;
    $item->issued_date = $request->issued_date;
    $item->active = $request->active;
    $item->save();

    return redirect()->route('items.index')->with('warning', 'Item updated successfully.');
}



    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {

    }
}
