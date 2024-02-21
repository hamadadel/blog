<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SearchController extends Controller
{
    public function search($word)
    {
        // DB::enableQueryLog();
        // return Post::with('user')->where('title', 'LIKE', '%' . $word . '%')->get();
        // dump(DB::getQueryLog());
        $posts = Post::search($word)->get();
        $posts->load('user');
        return $posts;
    }
}
