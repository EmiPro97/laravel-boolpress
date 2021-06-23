<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use App\Post;
use App\Category;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::all();

        return view('admin.posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();

        return view('admin.posts.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Valiudation
        $request->validate(
            [
                'title' => 'required|unique:posts|min:5|max:50',
                'content' => 'required',
                'category_id' => 'nullable|exists:categories,id'
            ],
            [
                'required' => 'The :attribute is required!'
            ]
        );

        $data = $request->all();

        // Gen. slug
        $data['slug'] = Str::slug($data['title'], '-');

        // Create and save record on db
        $new_post = new Post();

        $new_post->fill($data);

        $new_post->save();

        return redirect()->route('admin.posts.show', $new_post->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        // $post = Post::find($id);

        if ($post) {
            return view('admin.posts.show', compact('post'));
        }

        abort(404);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        $categories = Category::all();

        if ($post) {
            return view('admin.posts.edit', compact('post', 'categories'));
        }
        abort(404);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // Valiudation
        $request->validate(
            [
                'title' => [
                    'required',
                    Rule::unique('posts')->ignore($id),
                    'max:50'
                ],
                'content' => 'required',
                'category_id' => 'nullable|exists:categories,id'
            ],
            [
                'required' => 'The :attribute is required!'
            ]
        );

        $data = $request->all();

        $post = Post::find($id);

        // Gen. slug
        if ($data['title'] != $post->title) {
            $data['slug'] = Str::slug($data['title'], '-');
        }

        $post->update($data);

        return redirect()->route('admin.posts.show', $post->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $post->delete();

        return redirect()->route('admin.posts.index')->with('Deleted', $post->title);
    }
}
