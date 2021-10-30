@extends('layouts.blog')

@section('title')
    Post
@endsection
@section('description')

@endsection

@section('content')
    <div class="container">
        <div class="row mt-5">
            <div class="col">
                <div class="row">
                    <div class="col">
                        <!-- Breadcrumb:Start -->
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="#" style="color: #005331">Beranda</a></li>
                                <li class="breadcrumb-item"><a href="#" style="color: #005331">Post</a></li>
                                <li class="breadcrumb-item active" aria-current="page">{{ $post->title }}</li>
                            </ol>
                        </nav>
                        <!-- Breadcrumb:end -->
                    </div>
                </div>

                {{-- Post --}}
                <!-- Title:start -->
                <div class="row">
                    <div class="col">
                        <hr style="margin-top: -15px">
                        <h2 class="mt-4 mb-3">
                            {{ $post->title }}
                        </h2>

                        <!-- Title:end -->
                        <div class="row">
                            <!-- Post Content Column:start -->
                            <div class="col-lg-8">
                                <!-- thumbnail:start -->
                                @if (file_exists(public_path($post->thumbnail)))
                                    <a href="">
                                        <img src="{{ asset($post->thumbnail) }}" class="card-img-top mb-3"
                                            alt="{{ $post->title }}">
                                    </a>
                                @else
                                    <img class="img-fluid rounded" src="http://placehold.it/750x300"
                                        alt="{{ $post->title }}">
                                @endif
                                <!-- thumbnail:end -->

                                <small> <i class="far fa-calendar-alt"></i> Dipubliaksikan tanggal :
                                    {{ $post->created_at }}</small>
                                <hr>
                                <!-- Post Content:start -->
                                <div>
                                    <p>{!! $post->content !!}
                                </div>
                                <!-- Post Content:end -->
                            </div>

                            <!-- Sidebar Widgets Column:start -->
                            <div class="col-md-4">
                                <!-- Categories Widget -->
                                <div class="card mb-3">
                                    <h5 class="card-header">
                                        Categories
                                    </h5>
                                    <div class="card-body">
                                        <!-- category list:start -->
                                        @foreach ($post->categories as $category)
                                            <a href="{{ route('blog.posts.category', ['slug'=>$category->slug]) }}" class="badge badge-primary py-2 px-4 my-1">
                                                {{ $category->title }}
                                            </a>
                                        @endforeach
                                        <!-- category list:end -->
                                    </div>
                                </div>

                                <!-- Side Widget tags:start -->
                                <div class="card mb-3">
                                    <h5 class="card-header">
                                        Tags
                                    </h5>
                                    <div class="card-body">
                                        <!-- tag list:start -->
                                        @foreach ($post->tags as $tag)
                                        @endforeach
                                        <a href="" class="badge badge-info py-2 px-4 my-1">
                                            #{{ $tag->title }}
                                        </a>
                                        <!-- tag list:end -->
                                    </div>
                                </div>
                                <!-- Side Widget tags:start -->
                            </div>
                            <!-- Sidebar Widgets Column:end -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
