<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function dashboard(Request $request)
    {
        return view('dashboard');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        return redirect('/'); // Redirect to the login page after logout
    }

    public function loginPost(Request $request)
    {
        // Validate the request data
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        // Attempt to log the user in
        if (Auth()->attempt(["email" => $request->email, "password" => $request->password])) {
            return redirect()->intended('dashboard')->with('success','User Login Successfully'); // Redirect to the intended page after login
        }

        // If login fails, redirect back with an error message
        return redirect('login')->with('error','Invalid Email or Password');
}
}