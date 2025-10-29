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

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {

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
        return view('home', compact('totalSuppliers', 'products', 'welfares', 'regements', 'ranks','units','users'));
    }
}
