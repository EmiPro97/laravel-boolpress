<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Post;

class PostController extends Controller
{

    // Get blog's posts
    public function index()
    {
        $posts = Post::paginate(5);
        return response()->json($posts);
    }

    // Get blog's post detail by slug
    public function show($slug)
    {
        $post = Post::where('slug', $slug)->with(['category', 'tags'])->first();

        return response()->json($post);
    }
}
