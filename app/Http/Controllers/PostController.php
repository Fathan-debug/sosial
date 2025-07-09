<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'caption' => 'nullable|string|max:255',
            'image' => 'nullable|file|mimes:jpeg,png,jpg,gif,mp4|max:10240', // 10MB
        ]);

        // Only attempt to store if file is uploaded
        $imagePath = null;

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('posts', 'public');
        } else {
            // Optional: return error if image is missing (shouldn’t happen due to validation)
            return redirect()->back()->withErrors(['image' => 'No image file was uploaded.']);
        }

        Post::create([
            'user_id' => auth()->id(),
            'caption' => $request->caption,
            'image' => $imagePath, // Save path in DB
        ]);

        // Redirect to profile with user ID
        return redirect()->route('profile', ['id' => auth()->id()])
            ->with('success', 'Post created!');
    }

    public function destroy(Post $post)
    {
        // Only allow the post owner to delete it
        if (auth()->id() !== $post->user_id) {
            abort(403); // Unauthorized
        }

        // Delete the image from storage if it exists
        if ($post->image) {
            \Storage::delete('public/' . $post->image);
        }

        $post->delete();

        return back()->with('success', 'Post deleted successfully.');
    }
}
