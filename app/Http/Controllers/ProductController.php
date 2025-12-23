<?php

namespace App\Http\Controllers;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;

class ProductController extends Controller
{
    public function __construct()
    {
    $this->middleware(['permission:product-list'],["only"=>['index', 'show']]);
    $this->middleware(['permission:product-create'],["only"=>['create', 'store']]);
    $this->middleware(['permission:product-edit'],["only"=>['edit', 'update']]);
    $this->middleware(['permission:product-delete'],["only"=>['destroy']]);
    $this->middleware(['permission:product-approve'],["only"=>['toggleStatus']]);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
          // Fetch all units with their category
        $products = Product::with('category')->where('is_deleted', 0)->get(); // eager load category
        $categorys = Category::with('product')->get(); // Fetch all category

        //$products = Product::where('delete', 0)->get(); // Return all non-deleted records
        return view('products.index', compact('products', 'categorys'));
    }

        
    //Active Deactive section
    public function toggleStatus($productId)
    {
        $product = Product::findOrFail($productId); // Find the unit by ID
       if ($product) {
           if($product->active)
                {
                    $product->active = 0;
                }
            else
                {
                    $product->active = 1; 
                }
            $product->save();
        }
        return back()->with('info', 'Product created successfully.');      
    }

    /**
     * Store a newly created resource in storage.
     */
  public function store(Request $request)
{
    $request->validate([
        'product' => 'required|string|unique:products,product',
        'category_id' => 'required|exists:categorys,id',
        'active' => 'required|boolean',
        'normal_price' => 'required|numeric',
        'vat' => 'required|numeric',  // Enter 4 for 4%
        'tax' => 'required|numeric',  // Enter 2 for 2%
    ]);

    // Calculate welfare_price with percentages
    $welfare_price = $request->normal_price 
                     + ($request->normal_price * $request->vat / 100)
                     + ($request->normal_price * $request->tax / 100);

    Product::create([
        'product' => $request->product,
        'category_id' => $request->category_id,
        'active' => $request->active,
        'normal_price' => $request->normal_price,
        'vat' => $request->vat,
        'tax' => $request->tax,
        'welfare_price' => $welfare_price,
    ]);

    return redirect()->route('products.index')->with('success', 'Product created successfully.');
}


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'vat' => 'required|numeric',
            'tax' => 'required|numeric',
            'welfare_price' => 'required|numeric',
        ]);

        $product = Product::findOrFail($id);
        $product->vat = $request->vat;
        $product->tax = $request->tax;
        $product->welfare_price = $request->welfare_price;
        $product->save();

        return redirect()->route('products.index')->with('warning', 'Product pricing updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product = Product::findOrFail($id);
        $product->is_deleted = 1;
        $product->save();

        return redirect()->route('products.index')->with('error', 'product deleted successfully.');
    }
}
