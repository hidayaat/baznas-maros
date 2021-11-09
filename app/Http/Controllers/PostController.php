<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:post_show',['only' => 'index']);
        $this->middleware('permission:post_create',['only' => ['create', 'store']]);
        $this->middleware('permission:post_update',['only' => ['edit', 'update']]);
        $this->middleware('permission:post_detail',['only' => 'show']);
        $this->middleware('permission:post_delete',['only' => 'destroy']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $statusSelected = in_array($request->get('status'), ['publish', 'draft']) ? $request->get('status') : "publish";
        $posts = $statusSelected == "publish" ? Post::publish() : Post::draft();
        if ($request->get('keyword')) {
            $posts->search($request->get('keyword'));
        }
        return view('posts.index', [
            'posts' => $posts->paginate(10)->withQueryString(),
            'statuses' => $this->statuses(),
            'statusSelected' => $statusSelected
        ]);
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
            'title' => 'required|string',
            'slug' => 'required|string|unique:categories,slug',
            'thumbnail' => 'required',
            'description' => 'required',
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

        //proses insert data kategori
        DB::beginTransaction();
        try {
            $post = Post::create([
                'title' => $request->title,
                'slug' => $request->slug,
                'thumbnail' => parse_url($request->thumbnail)['path'],
                'description' => $request->description,
                'parent_id' => $request->parent_category,
                'content' => $request->content,
                'status' => $request->status,
                'user_id' => Auth::user()->id,
            ]);
            $post->tags()->attach($request->tag);
            $post->categories()->attach($request->category);

            Alert::success('Tambah Posts', 'Berhasil');
            return redirect()->route('posts.index');
        } catch (\Throwable $th) {
            DB::rollBack();
            Alert::error('Tambah Posts', 'Terjadi kesalahan saat menyimpan post' . $th->getMessage());
            if ($request->has('tag')) {
                $request['tag'] = Tag::select('id', 'title')->whereIn('id', $request->tag)->get();
            }
            return redirect()->back()->withInput($request->all());
        } finally {
            DB::commit();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        $categories = $post->categories;
        $tags = $post->tags;
        return view('posts.detail', compact('post', 'categories', 'tags'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        return view('posts.edit', [
            'post' => $post,
            'categories' => Category::with('descendants')->onlyParent()->get(),
            'statuses' => $this->statuses()
        ]);
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
        //proses validasi data kategori
        $validator = Validator::make($request->all(), [
            'title' => 'required|string',
            'slug' => 'required|string|unique:categories,slug,' . $post->id,
            'thumbnail' => 'required',
            'description' => 'required',
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

        //proses insert data kategori
        DB::beginTransaction();
        try {
            $post->update([
                'title' => $request->title,
                'slug' => $request->slug,
                'thumbnail' => parse_url($request->thumbnail)['path'],
                'description' => $request->description,
                'parent_id' => $request->parent_category,
                'content' => $request->content,
                'status' => $request->status,
                'user_id' => Auth::user()->id,
            ]);
            $post->tags()->sync($request->tag);
            $post->categories()->sync($request->category);

            Alert::success('Edit Posts', 'Berhasil');
            return redirect()->route('posts.index');
        } catch (\Throwable $th) {
            DB::rollBack();
            Alert::error('Edit Posts', 'Terjadi kesalahan saat menyimpan post' . $th->getMessage());
            if ($request->has('tag')) {
                $request['tag'] = Tag::select('id', 'title')->whereIn('id', $request->tag)->get();
            }
            return redirect()->back()->withInput($request->all());
        } finally {
            DB::commit();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        //proses insert data kategori
        DB::beginTransaction();
        try {
            $post->tags()->detach();
            $post->categories()->detach();
            $post->delete();


            Alert::success('Hapus Posts', 'Berhasil');
            return redirect()->route('posts.index');
        } catch (\Throwable $th) {
            DB::rollBack();
            Alert::error('Hapus Posts', 'Terjadi kesalahan saat menghapus post' . $th->getMessage());
        } finally {
            DB::commit();
            return redirect()->back();
        }
    }

    private function statuses()
    {
        return [
            'draft' => 'Draft',
            'publish' => 'Terbit',
        ];
    }
}
