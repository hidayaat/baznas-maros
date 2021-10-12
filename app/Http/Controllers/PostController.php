<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

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
        return view('posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create', [
            'categories' => Category::with('descendants')->onlyParent()->get(),
            'statuses' => $this->statuses()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //proses validasi data kategori
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:60',
            'slug' => 'required|string|unique:categories,slug',
            'thumbnail' => 'required',
            'description' => 'required|string|max:240',
            'content' => 'required',
            'category' => 'required',
            'tag' => 'required',
            'status' => 'required'
        ]);

        if ($validator->fails()) {
            if ($request->has('tag')) {
                $request['tag'] = Tag::select('id', 'title')->whereIn('id', $request->tag)->get();
            }
            return redirect()->back()->withInput($request->all())->withErrors($validator);
        }

        dd($request->all());

        // //proses insert data kategori
        // try {
        //     Category::create([
        //         'title' => $request->title,
        //         'slug' => $request->slug,
        //         'thumbnail' => parse_url($request->thumbnail)['path'],
        //         'description' => $request->description,
        //         'parent_id' => $request->parent_category
        //     ]);
        //     Alert::success('Tambah Kategori', 'Berhasil');
        //     return redirect()->route('categories.index');
        // } catch (\Throwable $th) {
        //     if ($request->has('parent_category')) {
        //         $request['parent_category'] = Category::select('id', 'title')->find($request->parent_category);
        //     }
        //     Alert::error('Tambah Kategori', 'Terjadi kesalahan saat menyimpan kategori'.$th->getMessage());
        //     return redirect()->back()->withInput($request->all());
        // }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        //
    }

    private function statuses()
    {
        return[
            'draft' => 'Draft',
            'publish' => 'Terbitkan',
        ];
    }
}
