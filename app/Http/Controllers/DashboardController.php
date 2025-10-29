<?php

namespace App\Http\Controllers;
use App\Models\Itemloanrequest;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function dashboard()
    {
        return view('dashboard'); 
    }
    public function show(){
        return view('about');
    }
    
}

