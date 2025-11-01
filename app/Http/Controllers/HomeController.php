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
        $users = User::where('id', '!=', auth()->id())
                ->where('role', '!=', 'user')
                ->with(['welfare'])
                ->get();
        
        // Stock counts for Welfare Shop Clerk and Welfare Shop OC
        $totalStock = 0;
        $availableStock = 0;
        $soldStock = 0;
        $damagedStock = 0;
        
        if ($user->hasRole('Welfare Shop Clerk') || $user->hasRole('Welfare Shop OC')) {
            $totalStock = Stock::where('welfare_id', $user->welfare_id)->count();
            $availableStock = Stock::where('welfare_id', $user->welfare_id)->where('status', 'available')->count();
            $soldStock = Stock::where('welfare_id', $user->welfare_id)->where('status', 'sold')->count();
            $damagedStock = Stock::where('welfare_id', $user->welfare_id)->where('status', 'damaged')->count();
        }
        
        return view('home', compact('totalSuppliers', 'products', 'welfares', 'regements', 'ranks', 'units', 'users', 'totalStock', 'availableStock', 'soldStock', 'damagedStock'));
    }
}
