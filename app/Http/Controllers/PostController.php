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
            'content' => ['required', 'min:10']
        ]);
        $post = new Post;
        $post->title = $data['title'];
        $post->slug = $this->generateSlug($data['title']);
        $post->content = $data['content'];
        $post->user_id = auth()->id();
        if ($post->save())
            return redirect('/post/show/' . $post->slug)->with('success', 'Post created');
        return redirect()->back()->with('failure', 'something went wrong');
    }

    public function show($slug)
    {

        $post = Post::where('slug', '=', $slug)->first();
        return $post ? view('post.show', ['post' => $post]) : [];
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
