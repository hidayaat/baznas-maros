@extends('layouts.blog')'

@section('title')
    Category
@endsection

@section('content')
    <div class="container">
        <!-- Title -->
        <h2 class="mt-4 mb-3">
            Category : {{ $category->title }}
        </h2>

        <!-- Breadcrumb:Start -->
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#" style="color: #005331">Beranda</a></li>
                <li class="breadcrumb-item"><a href="#" style="color: #005331">Categories</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ $category->title }}</li>
            </ol>
        </nav>
        <!-- Breadcrumb:end -->

        <div class="row">
            <div class="col-lg-8">
                <!-- Post list:start -->
                @forelse ($posts as $post)
                    <div class="card mb-4">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-6">
                                    <!-- tumbnail -->
                                    @if (file_exists(public_path($post->thumbnail)))
                                        <a href="{{ route('blog.post.detail', ['slug' => $post->slug]) }}">
                                            <img src="{{ asset($post->thumbnail) }}" class="card-img mb-3"
                                                alt="{{ $post->title }}">
                                        </a>
                                    @else
                                        <img class="img-fluid rounded" src="http://placehold.it/750x300"
                                            alt="{{ $post->title }}">
                                    @endif
                                </div>
                                <div class="col-lg-6">
                                    <h2 class="card-title">{{ $post->title }}</h2>
                                    <p class="card-text">{{ $post->description }}</p>
                                    <a href="{{ route('blog.post.detail', ['slug' => $post->slug]) }}" class="btn btn-warning">
                                        Baca Selengkapnya
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <!-- empty -->
                    <h3 class="text-center">
                        Data belum ada
                    </h3>
                @endforelse
                @if ($posts->hasPages())
                    <div class="row">
                        <div class="col">
                            {{ $posts->links('vendor.pagination.bootstrap-4') }}
                        </div>
                    </div>
                @endif
                <!-- Post list:end -->
            </div>
            <div class="col-md-4">
                <!-- Categories list:start -->
                <div class="card mb-1">
                    <h5 class="card-header">
                        Categories
                    </h5>
                    <div class="card-body">
                        <ul class="list-unstyled">
                            <li>
                                <a href="">
                                    Category title
                                </a>
                                <!-- category descendants:start -->

                                <!-- category descendants:end -->
                            </li>
                        </ul>
                    </div>
                </div>
                <!-- Categories list:end -->
            </div>
        </div>
    </div>
@endsection
