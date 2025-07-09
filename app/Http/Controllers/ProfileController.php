<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Illuminate\Support\Facades\Storage;


class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('auth.profile', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $user = $request->user();

        // $request->validate([
        //     'name'     => 'required|string|max:255',
        //     'email'    => 'required|email|unique:users,email',
        //     'phone'    => 'nullable|string|max:20',
        //     'birthDate' => 'nullable|date',
        //     'bio'      => 'nullable|string|max:500',
        //     'location' => 'nullable|string|max:255',
        //     'website'  => 'nullable|url|max:255',
        //     'profile_pic' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:5120', // 5MB
        // ]);

        // Update user fields
        $user->name     = $request->name;
        $user->email    = $request->email;
        $user->birthDate = $request->birthDate;
        $user->bio      = $request->bio;
        $user->location = $request->location;
        $user->website  = $request->website;
        $user->phone  = $request->phone;

        // Handle profile picture upload
        if ($request->hasFile('profile_pic')) {
            // Delete old profile pic if not default
            // if ($user->profile_pic && $user->profile_pic != 'default.png') {
            //     Storage::delete('public/profile_pics/' . $user->profile_pic);
            // }

            $file = $request->file('profile_pic')->store('profiles', 'public');
            
            $user->profile_pic = $file;
        }
        $user->save();

        return redirect()->back()->with('success', 'Profile updated successfully.');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }

    public function show($username)
    {
        // Dapatkan user berdasarkan username
        $user = \App\Models\User::where('username', $username)->firstOrFail();

        // Hantar $user ke view
        return view('auth.profile', compact('user'));
    }
}
