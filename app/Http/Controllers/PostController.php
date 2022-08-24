<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    function make_slug($string) {
        return preg_replace('/\s+/u', '-', trim($string));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $post = Post::orderBy('id', 'Desc')->get();
        return view('admin.post.index', compact('post'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.post.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $image = null;
        if ($request->has('image')) {
            $fileOriginalName = $request->file('image')->getClientOriginalExtension();
            $image = time() . '.' . $fileOriginalName;
            $request->image->storeAs('image', $image, 'public');
        }

        auth()->user()->posts()->create([
            'title' => $request->title,
            'body' => $request->body,
            'published' => $request->published,
            'image' => $image,
            'slug' => $this->make_slug($request->title),
        ]);

        if ($request->has('save')) {
            return redirect(route('post.index'))->with('message', 'Post Added');
        } else {
            return redirect(route('post.create'))->with('message', 'Post Added');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        return view('admin.post.edit', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        if ($request->has('image')) {
            $fileOriginalName = $request->file('image')->getClientOriginalExtension();
            $image = time() . '.' . $fileOriginalName;
            $request->image->storeAs('image', $image, 'public');
            if (!empty($post->image)){
                Storage::delete('/public/image/'.$post->image);
            }
            $post->update([
                'image' => $image,
            ]);
        }
        $post->update([
            'title' => $request->title,
            'body' => $request->body,
            'published' => $request->published,
        ]);

        if ($request->has('update')) {
            return redirect(route('post.index'))->with('message', 'Post Updated');
        } else {
            return redirect()->back()->with('message', 'Post Updated');
        }


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        if (!empty($post->image)){
            Storage::delete('/public/image/'.$post->image);
        }
        $post->delete();
        return redirect()->back()->with('message', 'Post Deleted');
    }
}
