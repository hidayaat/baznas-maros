@extends('layouts.blog')

@section('title')
    Program
@endsection

@section('content')
    <div class="container">
        <h2 class="mt-5">
            Program
        </h2>
        <!-- Breadcrumb:Start -->
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#" style="color: #005331">Beranda</a></li>
                <li class="breadcrumb-item active" aria-current="page">Program</li>
            </ol>
        </nav>
        <!-- Breadcrumb:end -->

        <!-- List category -->
        <div class="row">
            @forelse ($categories as $category)
                <!-- true -->
                <div class="col-lg-4 col-sm-6 portfolio-item my-3">
                    <div class="card h-100">
                        <!-- tumbnail -->
                        @if (file_exists(public_path($category->thumbnail)))
                            <a href="{{ route('blog.posts.category', ['slug' => $category->slug]) }}">
                                <img src="{{ asset($category->thumbnail) }}" class="card-img mb-3" alt="{{ $category->title }}">
                            </a>
                        @else
                            <img class="img-fluid rounded" src="http://placehold.it/750x300" alt="{{ $category->title }}">
                        @endif
                        <div class="card-body">
                            <h4 class="card-title">
                                <a href="{{ route('blog.posts.category', ['slug' => $category->slug]) }}">
                                    {{  $category->title }}
                                </a>
                            </h4>
                            <p class="card-text">
                               {{ $category->description }}
                            </p>
                        </div>
                    </div>
                </div>
            @empty
                <!-- false -->
                <h3 class="text-center">
                    Belum ada data
                </h3>
            @endforelse

        </div>
        <!-- List category -->

        <!-- pagination:start -->
        <div class="row">
            <div class="col">

            </div>
        </div>
        <!-- pagination:end -->
    </div>
@endsection
