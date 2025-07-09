<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Post;
use Illuminate\Support\Facades\Storage;

class UserProfileController extends Controller
{
    public function index($id)
    {
        $user = User::with(['followers', 'following']) // eager load relationships
            ->findOrFail($id);

        $posts = $user->posts()->latest()->get(); // fetch the user's posts

        return view('auth.profile', compact('user', 'posts'));
    }


    public function follow($id)
    {
        $userToFollow = User::findOrFail($id);
        Auth::user()->following()->attach($userToFollow);
        return back();
    }

    public function unfollow($id)
    {
        $userToUnfollow = User::findOrFail($id);
        Auth::user()->following()->detach($userToUnfollow);
        return back();
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('auth.UpdateProfile', compact('user'));
    }

    public function update(Request $request)
    {
        $user = User::find(Auth::id());
        // Update user fields
        $user->name     = $request->name;
        $user->email    = $request->email;
        $user->birthDate = $request->birthDate;
        $user->bio      = $request->bio;
        $user->location = $request->location;
        $user->website  = $request->website;
        $user->phone    = $request->phone;

        // Handle profile picture upload
        if ($request->hasFile('profile_pic')) {

            $file = $request->file('profile_pic')->store('profiles', 'public');

            $user->profile_pic = $file;
        }

        $user->save();

        return redirect()->route('profile', ['id' => $user->id])->with('success', 'Profile updated successfully.');
    }

    public function connect(Request $request)
    {
        $query = $request->input('search');

        $users = User::where('id', '!=', auth()->id())
            ->when($query, function ($q) use ($query) {
                $q->where('name', 'like', "%{$query}%")
                    ->orWhere('username', 'like', "%{$query}%")
                    ->orWhere('bio', 'like', "%{$query}%");
            })
            ->paginate(12); // You can change the number

        return view('connect', compact('users'));
    }
}
