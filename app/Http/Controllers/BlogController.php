<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Donor;
use App\Models\Category;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;


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
        $categoryRoot = $category->root();
        return view('blog.post-category',[
            'posts' => $post,
            'category' => $category,
            'categoryRoot' => $categoryRoot
        ]);
    }

    public function showCategories()
    {
        return view('blog.category', [
            'categories' => Category::onlyParent()->paginate(9)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('blog.zakat');
    }

     /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules =[
            'phone' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:12|max:14|unique:donors,phone',
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email|unique:donors,email',
            'location' => 'required',
            'donation' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:5',
            'donation_category' => 'required',
            'message' => 'nullable',
            'bank_payment' => 'required'
        ];

        $text =[
            'phone.required' => 'Nomor telpon tidak boleh kosong',
            'phone.regex' => 'Nomor telpon tidak valid',
            'phone.min' => 'Nomor telpon kurang dari 12 digit',
            'phone.min' => 'Nomor telpon lebih dari 14 digit',
            'phone.unique' => 'Nomor telpon telah terdaftar',
            'first_name.required' => 'Nama depan tidak boleh kosong',
            'last_name.required' => 'Nama belakang tidak boleh kosong',
            'email.required' => 'Email tidak boleh kosong',
            'email.unique' => 'Email telah terdaftar',
            'location.required' => 'Domisili tidak boleh kosong',
            'donation.required' => 'Nominal titipan tidak boleh kosong',
            'donation.regex' => 'Nominal titipan tidak valid',
            'donation.min' => 'Nominal titipan minimal Rp.10000',
            'donation_category.required' => 'Kategori titipan tidak boleh kosong',
            'bank_payment.required' => 'Transfer bank tidak boleh kosong'
        ];
        
        Validator::make($request->all(), $rules, $text)->validate();

        try {
            Donor::create([
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'phone' => $request->phone,
                'email' => $request->email,
                'location' => $request->location,
                'donation' => $request->donation,
                'donation_category' => $request->donation_category,
                'message' => $request->message,
                'bank_payment' => $request->bank_payment
            ]);
            Alert::success('Zakat Online','Data berhasil dikirim, jangan lupa melakukan konfirmasi setelah transfer');
            return redirect()->route('blog.home');

        } catch (\Throwable $th) {
            Alert::error('Zakat Online', 'Terjadi kesalahan saat menyimpan data. '.$th->getMessage());
            return redirect()->back()->withInput($request->all());
        }

    }

    public function profil()
    {
        return view('blog.profil');
    }

}
