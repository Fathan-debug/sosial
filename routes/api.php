<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Api\FlutterController;
use App\Models\Post;
use App\Models\User;

Route::post('/login-mobile', [FlutterController::class, 'login']);
Route::post('/register-mobile', [FlutterController::class, 'register']);
Route::get('/posts', function () {
    return response()->json(
        Post::with('user') // Assuming you have a user relationship
            ->orderBy('created_at')
            ->get()
    );
});
Route::get('/search-users', function (Request $request) {
    $query = $request->query('query');
    
    $users = User::where('name', 'like', "%$query%")
        ->orWhere('email', 'like', "%$query%")
        ->withCount(['followers', 'following'])
        ->paginate(10);
    
    return response()->json($users);
});
Route::post('/update-profile', function (Request $request) {
    $validated = $request->validate([
        'user_id' => 'required|exists:users,id',
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email,'.$request->user_id,
        'phone' => 'nullable|string|max:20',
        'birth_date' => 'nullable|date',
        'bio' => 'nullable|string|max:500',
        'location' => 'nullable|string|max:255',
        'website' => 'nullable|url|max:255',
        'profile_pic' => 'nullable|image|max:5120', // 5MB max
    ]);

    $user = User::find($request->user_id);
    
    // Handle profile picture upload
    if ($request->hasFile('profile_pic')) {
        // Delete old image if exists
        if ($user->profile_pic) {
            Storage::delete($user->profile_pic);
        }
        
        $path = $request->file('profile_pic')->store('profile_pictures');
        $user->profile_pic = $path;
    }

    // Update user fields
    $user->name = $validated['name'];
    $user->email = $validated['email'];
    $user->birthDate = $validated['birth_date'] ?? $user->birthDate;
    $user->save();

    // Update profile data (you might need a separate profile table)
    $user->profile()->updateOrCreate(
        ['user_id' => $user->id],
        [
            'phone' => $validated['phone'],
            'bio' => $validated['bio'],
            'location' => $validated['location'],
            'website' => $validated['website'],
        ]
    );

    return response()->json([
        'success' => true,
        'user' => $user->load('profile'),
        'message' => 'Profile updated successfully']);
});