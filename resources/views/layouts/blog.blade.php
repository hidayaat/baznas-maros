<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="@yield('description')">

    <title img="">
        BAZNAS Maros - @yield('title')
    </title>

    <!-- Bootstrap core CSS -->
    <link href="{{ asset('vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="{{ asset('vendor/custom-css/style.css') }}" rel="stylesheet">
    <!-- fontawesome free -->
    <script src="{{ asset('vendor/fontawesome-free/js/all.min.js') }}"></script>
    <!-- icon flag -->
    <link rel="shortcut icon" href='{{ asset('vendor/img/logo-baznas.png') }}' />
    {{-- owl carousel --}}
    <link href="{{ asset('vendor/owl-carousel/css/owl.carousel.min.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/owl-carousel/css/owl.theme.default.min.css') }}" rel="stylesheet">


</head>

<body>

    <!-- Navigation:start -->
    @include('layouts._blog.navbar')
    <!-- Navigation:end -->

    <!-- Page Content -->
    <!-- content:start -->
    @yield('content')
    <!-- content:end -->
    <!-- /.container -->

    <!-- Footer:start -->
    @include('layouts._blog.footer')
    <!-- Footer:end -->

    <!-- jquery -->
    <script src="{{ asset('vendor/jquery/jquery-3.6.0.min.js') }}"></script>
    <!-- bootstrap -->
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    {{-- owl carousel js --}}
    <script src="{{ asset('vendor/owl-carousel/js/owl.carousel.min.js') }}"></script>

    @yield('scripts')

    @include('sweetalert::alert')

</body>

</html>
