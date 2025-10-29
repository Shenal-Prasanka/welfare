<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Support\Facades\Storage;


class ProfileController extends Controller
{
    /**
     * Show the user's profile form.
     */
    public function show()
{
    $user = auth()->user();

    if ($user->hasRole('User')) {
        return view('profile', compact('user'));
    }

    return view('auth.profile', compact('user'));
}


    /**
     * Update the user's profile information.
     */
   public function update(Request $request)
{
    $user = auth()->user();

    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|max:255|unique:users,email,' . $user->id,
        'mobile' => 'required|string|min:10',
        'address' => 'required|string',
        'password' => 'nullable|confirmed|min:6',
        'profile_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    // 🟢 Handle profile image upload
    if ($request->hasFile('profile_image')) {
        // Delete old image if it exists
        if ($user->profile_image && Storage::exists('photos' . $user->profile_image)) {
            Storage::delete('photos' . $user->profile_image);
        }

        // Store new image in public/upload
        $imagePath = $request->file('profile_image')->store('photos');
        $validated['profile_image'] = basename($imagePath); // Save only filename
    }

    // 🟢 Handle optional password update
    if (!empty($validated['password'])) {
        $validated['password'] = bcrypt($validated['password']);
    } else {
        unset($validated['password']);
    }

    // 🟢 Update user
    $user->update($validated);

    return redirect()->back()->with('success', 'Profile updated successfully!');
}


}