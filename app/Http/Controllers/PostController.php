<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function create()
    {
        return view('post.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => ['required', 'min:10', 'max:150'],
            'content' => ['required', 'min:10']
        ]);
        $post = new Post;
        $post->title = strip_tags($data['title']);
        $post->slug = Str::slug($data['title']);
        $post->content = strip_tags($data['content']);
        $post->user_id = auth()->id();
        if ($post->save())
            return redirect('/posts/' . $post->slug)->with('success', 'Post created');
        return redirect()->back()->with('failure', 'something went wrong');
    }

    public function show(Post $post)
    {
        $post->content = Str::markdown($post->content);
        return view('post.show', compact('post'));
    }

    public function edit(Request $request, Post $post)
    {
        // $this->middleware('can:update,post')
        $this->authorize('update', $post);
        return view('post.edit', compact('post'));
    }

    public function update(Request $request, Post $post)
    {
        $this->authorize('update', $post);
        $data = $request->validate([
            'title' => ['required', 'min:10', 'max:150'],
            'content' => ['required', 'min:10']
        ]);
        $post->update($data);
        return redirect('/posts/' . $post->slug)->with('success', 'Post updated successfully');
    }

    public function destroy(Post $post)
    {
        $this->authorize('delete', $post);
        $post->delete();
        return redirect('/profile/' . auth()->user()->username)->with('success', 'Post deleted successfully');
    }
    private function generateSlug($string)
    {
        return str_replace(
            ' ',
            '-',
            strtolower(
                str_replace(
                    ['!', '@', '#', '$', '%', '^', '&', '*', '(', ')'],
                    '',
                    $string
                )
            )
        );
    }
}
