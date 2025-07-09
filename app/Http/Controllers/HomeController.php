<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\Storage;

class HomeController extends Controller
{
   public function index()
{
    // Fetch all posts with related user data
    $posts = Post::with('user')->latest()->get();

    // Pass it to the home view
    return view('Home', compact('posts'));
}
}
