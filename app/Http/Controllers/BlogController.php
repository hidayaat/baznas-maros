<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class BlogController extends Controller
{   
    private $perPage = 10;
    public function home()
    {
        
        return view('blog.home', [
            'posts' => Post::publish()->latest()->get()
        ]);
    }

    public function showPostDetail($slug)
    {
        
        $post = Post::publish()->with(['categories', 'tags'])->where('slug', $slug)->first();
        if (!$post) {
            return redirect()->route('blog.home');
        }

        return view('blog.post-detail', [
            'post' => $post,
        ]);
    }

}
