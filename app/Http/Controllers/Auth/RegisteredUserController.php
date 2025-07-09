<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use Illuminate\Support\Facades\Storage;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'gender' => $request->gender,
            'phone' => $request->phone,
            'birthDate' => $request->birth_date,
            'role_id' => 2, // Assuming '2' is the default role ID for new users
            'profile_pic' => 'default.png', // Default profile picture
        ]);

        event(new Registered($user));

        // Auth::login($user);


        return redirect()->route('test');
    }

    public function update(Request $request)
    {
        $user = $request->user();

        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email,' . $user->id,
            'phone'    => 'nullable|string|max:20',
            'birthDate' => 'nullable|date',
            'bio'      => 'nullable|string|max:500',
            'location' => 'nullable|string|max:255',
            'website'  => 'nullable|url|max:255',
            'profile_pic' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:5120', // 5MB
        ]);

        // Update user fields
        $user->name     = $request->name;
        $user->email    = $request->email;
        $user->phone    = $request->phone;
        $user->birthDate = $request->birthDate;
        $user->bio      = $request->bio;
        $user->location = $request->location;
        $user->website  = $request->website;
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

        return redirect()->route('profile', ['id' => $user->id]);
    }
}
