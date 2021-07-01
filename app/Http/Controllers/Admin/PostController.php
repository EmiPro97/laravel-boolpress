<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use App\Post;
use App\Category;
use App\Tag;
use Illuminate\Support\Facades\Storage;

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
        $tags = Tag::all();

        return view('admin.posts.create', compact('categories', 'tags'));
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
                'category_id' => 'nullable|exists:categories,id',
                'tags' => 'nullable|exists:tags,id',
                'cover' => 'nullable|mimes:jpg,bmp,png,jpeg',
            ],
            [
                'required' => 'The :attribute is required!'
            ]
        );

        $data = $request->all();
        // dd($data);

        //Add cover image if present
        if (array_key_exists('cover', $data)) {
            $img_path = Storage::put('posts-covers', $data['cover']);

            //Override cover with path
            $data['cover'] = $img_path;
        }

        // Gen. slug
        $data['slug'] = Str::slug($data['title'], '-');

        // Create and save record on db
        $new_post = new Post();

        $new_post->fill($data);

        $new_post->save();

        // Save relation with tags in pivot table
        if (array_key_exists('tags', $data)) {
            $new_post->tags()->attach($data['tags']); //Adds new records in pivot table
        }

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
        $tags = Tag::all();

        if ($post) {
            return view('admin.posts.edit', compact('post', 'categories', 'tags'));
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
                'category_id' => 'nullable|exists:categories,id',
                'tags' => 'nullable|exists:tags,id',
                'cover' => 'nullable|mimes:jpg,bmp,png,jpeg',
            ],
            [
                'required' => 'The :attribute is required!'
            ]
        );

        $data = $request->all();

        $post = Post::find($id);

        // Image update
        if (array_key_exists('cover', $data)) {
            // Delete previous one if present
            if ($post->cover) {
                Storage::delete($post->cover);
            }

            // Set new one
            $data['cover'] = Storage::put('posts-covers', $data['cover']);
        }

        // Gen. slug
        if ($data['title'] != $post->title) {
            $data['slug'] = Str::slug($data['title'], '-');
        }

        $post->update($data);

        // Update relation in pivot table
        if (array_key_exists('tags', $data)) {
            $post->tags()->sync($data['tags']); // adds / remove records in pivot table
        } else {
            $post->tags()->detach(); // if there is no tags, delete all records in pivot table
        }

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
        // Remove image if present
        if ($post->cover) {
            Storage::delete($post->cover);
        }

        // Delete records in pivot table
        $post->tags()->detach();

        $post->delete();

        return redirect()->route('admin.posts.index')->with('Deleted', $post->title);
    }
}
