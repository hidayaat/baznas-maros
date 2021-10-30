<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Category;

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
            'posts' => Post::publish()->latest()->paginate(3)
        ]);
    }

    public function showPostByCategory($slug)
    {
        $post = Post::publish()->whereHas('categories', function ($query) use ($slug)
        {
            return $query->where('slug', $slug);
        })->paginate($this->perPage);

        $category = Category::where('slug', $slug)->first();

        return view('blog.post-category',[
            'posts' => $post,
            'category' => $category
        ]);
    }

}
