<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Supply; 
use App\Models\Product; 
use App\Models\Welfare;
use App\Models\Regement;
use App\Models\Rank;
use App\Models\Unit;
use App\Models\Stock;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $user = Auth::user();
        
        $totalSuppliers = Supply::count();
        $products = Product::count();
        $welfares = Welfare::count();
        $regements = Regement::count();
        $ranks = Rank::count();
        $units = Unit::count();
        
        // Get monthly product counts for the current year
        $currentYear = date('Y');
        $productCounts = [];
        $welfareCounts = [];
        
        for ($month = 1; $month <= 12; $month++) {
            // Product counts
            $productCount = Product::whereYear('created_at', $currentYear)
                ->whereMonth('created_at', $month)
                ->count();
            $productCounts[] = $productCount;
            
            // Welfare counts
            $welfareCount = Welfare::whereYear('created_at', $currentYear)
                ->whereMonth('created_at', $month)
                ->count();
            $welfareCounts[] = $welfareCount;
        }
        $users = User::where('id', '!=', auth()->id())
                ->where('role', '!=', 'user')
                ->with(['welfare'])
                ->get();
        
        // Stock counts for Welfare Shop Clerk and Welfare Shop OC
        $totalStock = 0;
        $availableStock = 0;
        $soldStock = 0;
        $damagedStock = 0;
        $productStocks = collect();
        $categories = collect();
        $categoryStocks = collect();
        
        if ($user->hasRole('Welfare Shop Clerk') || $user->hasRole('Welfare Shop OC')) {
            $totalStock = Stock::where('welfare_id', $user->welfare_id)->count();
            $availableStock = Stock::where('welfare_id', $user->welfare_id)->where('status', 'available')->count();
            $soldStock = Stock::where('welfare_id', $user->welfare_id)->where('status', 'sold')->count();
            $damagedStock = Stock::where('welfare_id', $user->welfare_id)->where('status', 'damaged')->count();
            
            // Get all categories that have approved products (active = 0)
            $categories = \App\Models\Category::whereHas('products', function($query) {
                    $query->where('active', 0); // Only approved products
                })
                ->withCount(['products' => function($query) {
                    $query->where('active', 0);
                }])
                ->orderBy('category')
                ->get();
            
            // Get products grouped by category (only approved products)
            $categoryStocks = \App\Models\Product::with('category')
                ->where('active', 0) // Only approved products
                ->whereHas('category')
                ->get()
                ->groupBy(function($product) {
                    return $product->category->category;
                })
                ->map(function($products) use ($user) {
                    return $products->map(function($product) use ($user) {
                        // Count available stock for this product in user's welfare
                        $stockCount = Stock::where('welfare_id', $user->welfare_id)
                            ->where('product_id', $product->id)
                            ->where('status', 'available')
                            ->count();
                        
                        return (object)[
                            'item_name' => $product->product,
                            'item_category' => $product->category->category,
                            'item_model' => $product->product_number,
                            'available_count' => $stockCount,
                            'normal_price' => $product->normal_price,
                            'welfare_price' => $product->welfare_price,
                        ];
                    });
                });
        }
        
        // Welfare Shop Wise Stock Count for Shop Coord Clerk and Shop Coord OC
        $welfareStockCounts = collect();
        $totalStockItems = 0;
        
        if ($user->hasRole('Shop Coord Clerk') || $user->hasRole('Shop Coord OC')) {
            // Get welfare shops with product-wise stock counts
            $welfareStockCounts = Welfare::all()
                ->map(function($welfare) {
                    // Group stocks by product for this welfare
                    $productStocks = Stock::where('welfare_id', $welfare->id)
                        ->with('product')
                        ->get()
                        ->groupBy('product_id')
                        ->map(function($stocks) {
                            $product = $stocks->first()->product;
                            if (!$product) {
                                return null;
                            }
                            return (object)[
                                'product_id' => $product->id,
                                'product_name' => $product->product,
                                'product_number' => $product->product_number,
                                'available_count' => $stocks->where('status', 'available')->count(),
                                'issued_count' => $stocks->where('status', 'issued')->count(),
                                'damaged_count' => $stocks->where('status', 'damaged')->count(),
                                'total_count' => $stocks->count(),
                            ];
                        })
                        ->filter()
                        ->values();
                    
                    $totalStock = Stock::where('welfare_id', $welfare->id)->count();
                    
                    return (object)[
                        'welfare_id' => $welfare->id,
                        'welfare_name' => $welfare->name,
                        'welfare_location' => $welfare->location,
                        'total_stock' => $totalStock,
                        'product_count' => Stock::where('welfare_id', $welfare->id)->distinct('product_id')->count('product_id'),
                        'products' => $productStocks,
                    ];
                })
                ->filter(function($welfare) {
                    return $welfare->total_stock > 0; // Only show welfares with stock
                });
            
            $totalStockItems = Stock::count();
        }
        
        // Get recently added products
        $recentProducts = Product::with('category')
            ->where('is_deleted', 0)
            ->where('active', 0) // Only approved products
            ->orderBy('created_at', 'desc')
            ->take(5) // Show 5 most recent products
            ->get();
            
        // Get welfare product distribution
        $welfareProductDistribution = \App\Models\Stock::with('welfare')
            ->selectRaw('welfare_id, COUNT(*) as product_count')
            ->groupBy('welfare_id')
            ->get()
            ->map(function($item) {
                return [
                    'name' => $item->welfare->name ?? 'Unknown',
                    'y' => (int)$item->product_count,
                    'location' => $item->welfare->location ?? 'N/A'
                ];
            });
        
        return view('home', compact(
            'totalSuppliers', 'products', 'welfares', 'regements', 'ranks', 'units', 'users', 
            'totalStock', 'availableStock', 'soldStock', 'damagedStock', 'categories', 
            'categoryStocks', 'welfareStockCounts', 'totalStockItems', 'productCounts', 
            'welfareCounts', 'recentProducts', 'welfareProductDistribution'
        ));
    }
}
