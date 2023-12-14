<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function create()
    {
        return view('post.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => ['required', 'min:10', 'max:150'],
            'content' => ['required', 'min:100']
        ]);
        $post = new Post;
        $post->title = $data['title'];
        $post->slug = str_replace(' ', '-', str_replace(['!', '@', '#', '$', '%', '^' . '&', '*', '(', ')'], '', $data['title']));
        $post->content = $data['content'];
        if ($post->save())
            return redirect('/post/show/' . $post->id)->with('success', 'Post created');
        return redirect()->back()->with('failure', 'something went wrong');
    }
}
