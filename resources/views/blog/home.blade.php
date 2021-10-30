@extends('layouts.blog')

@section('title')
    Home
@endsection

@section('content')
    <div id="carouselExampleIndicators" class="carousel slide mt-3" data-ride="carousel">
        <ol class="carousel-indicators">
            <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="3"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="4"></li>
        </ol>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img class="d-block w-100" src="{{ asset('vendor/img/carousel/carousel-1.jpg') }}" alt="First slide">
            </div>
            <div class="carousel-item">
                <img class="d-block w-100" src="{{ asset('vendor/img/carousel/carousel-2.jpg') }}" alt="Second slide">
            </div>
            <div class="carousel-item">
                <img class="d-block w-100" src="{{ asset('vendor/img/carousel/carousel-3.jpg') }}" alt="Third slide">
            </div>
            <div class="carousel-item">
                <img class="d-block w-100" src="{{ asset('vendor/img/carousel/carousel-4.jpg') }}" alt="Second slide">
            </div>
            <div class="carousel-item">
                <img class="d-block w-100" src="{{ asset('vendor/img/carousel/carousel-5.jpg') }}" alt="Third slide">
            </div>
        </div>
        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>
    <section class="p-5 text-center">
        <div class="container">
            <div class="row">
                <div class="col">
                    <h3 class="mb-5">BERITA</h3>
                    <div class="owl-carousel posts-carousel owl-theme">
                        @foreach ($posts as $post)
                            <div class="item">
                                <div class="">
                                    @if (file_exists(public_path($post->thumbnail)))
                                        <a href="">
                                            <img src="{{ asset($post->thumbnail) }}" class="card-img-top mb-3"
                                                alt="{{ $post->title }}">
                                        </a>
                                    @else
                                        <img class="img-fluid rounded" src="http://placehold.it/750x300"
                                            alt="{{ $post->title }}">
                                    @endif
                                    <a href="{{ route('blog.post.detail', ['slug' => $post->slug]) }}">
                                        <h5 style="font-weight: bold; color: #005331">{{ $post->title }}</h5>
                                    </a>
                                        <p>{{ $post->description }}</p>
                                    
                                    {{-- <p>{!! html_entity_decode($post->content) !!}</p> --}}
                                </div>
                                {{-- <div class="d-flex justify-content-center">
                                <a href="" class="btn btn-success float-right" style="width: 100%;"role="button">
                                    Baca Selengkapnya
                                </a>
                            </div> --}}
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="text-center p-5">
        <div class="container">
            <div class="row">
                <div class="col">
                    <h3 class="mb-5">Video Kegiatan</h3>
                    <div class="owl-carousel owl-theme video-slider-1">

                        <iframe onplay="pauseSlider();" onpause="playSlider();" onended="playSlider();" controls=""
                            width="672" height="378" src="https://www.youtube.com/embed/8iEgci-npU8" frameborder="0"
                            allow="autoplay; encrypted-media" allowfullscreen>
                        </iframe>

                        <iframe onplay="pauseSlider();" onpause="playSlider();" onended="playSlider();" controls=""
                            width="672" height="378" src="https://www.youtube.com/embed/8iEgci-npU8" frameborder="0"
                            allow="autoplay; encrypted-media" allowfullscreen>
                        </iframe>

                        <iframe onplay="pauseSlider();" onpause="playSlider();" onended="playSlider();" controls=""
                            width="672" height="378" src="https://www.youtube.com/embed/8iEgci-npU8" frameborder="0"
                            allow="autoplay; encrypted-media" allowfullscreen>
                        </iframe>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </section>


@endsection

@section('scripts')
    <script>
        $('.posts-carousel').owlCarousel({
            loop: true,
            margin: 10,
            nav: true,
            dots: false,
            responsive: {
                0: {
                    items: 1
                },
                600: {
                    items: 3
                },
                1000: {
                    items: 3
                }
            }
        })
    </script>
    <script type="text/javascript">
        //owlCarousel slider  
        var owl = $(".video-slider-1").owlCarousel({
            stagePadding: 200,
            // items: 1,
            loop: true,
            margin: 10,
            autoplay: true,
            autoplayTimeout: 4000,
            //autoplayHoverPause: true,
            lazyLoad: true,
            dots: true,
            responsive: {
                600: {
                    items: 1
                },
                1000: {
                    items: 1
                }
            },
            onTranslate: function() {
                $('.owl-item').find('video').each(function() {
                    this.pause();
                });
            }
        });

        // Play slider when video pause
        function playSlider() {
            window.owl.trigger('play.owl.autoplay')
        }

        // Pause slider when video play
        function pauseSlider() {
            window.owl.trigger('stop.owl.autoplay')
        }
    </script>
@endsection
