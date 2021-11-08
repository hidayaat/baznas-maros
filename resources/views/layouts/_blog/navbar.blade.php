<nav class="navbar fixed-top navbar-expand-lg navbar-dark fixed-top" style="background: #005331">
    <a href="{{ route('blog.home') }}" class="navbar-brand">
        <img src="{{ asset('vendor/img/logo.png') }}" alt="logo" style="height : 60px;">
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown"
        aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavDropdown">
        <ul class="navbar-nav text-uppercase">
            <!-- nav-home:start -->
            <li class="nav-item">
                <a class="nav-link" href="{{ route('blog.home') }}">
                    Beranda
                </a>
            </li>
            <!-- nav-home:end -->
            <!-- nav-categories:start -->
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button"
                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Tentang Kami
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                    <a class="dropdown-item" href="#">Profil</a>
                    <a class="dropdown-item" href="#">Struktur Organisasi</a>
                </div>
            </li>
            <!-- nav-categories:tags -->
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button"
                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Program
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                    <a class="dropdown-item" href="#">Ekonimi</a>
                    <a class="dropdown-item" href="#">Pendidikan</a>
                    <a class="dropdown-item" href="#">Kesehatan</a>
                    <a class="dropdown-item" href="#">Dakwah & Advokasi</a>
                    <a class="dropdown-item" href="#">Kemanusiaan</a>
                </div>
            </li>
            <!-- nav-tags:end -->
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button"
                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Layanan
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                    <a class="dropdown-item" href="#">Zakat Online</a>
                    <a class="dropdown-item" href="#">Jemput Zakat</a>
                </div>
            </li>
        </ul>
    </div>
    <a clas=""href="">
        <a class="btn btn-warning btn-lg text-right" href="{{ route('blog.create') }}" role="button">Bayar Zakat</a>
    </a>
    {{-- <!-- Search for post:start -->
    <form class="input-group my-1 mr-5" action="" method="GET">
        <input name="keyword" value="" type="search" class="form-control" placeholder="Enter title">
        <div class="input-group-append">
            <button class="btn btn-warning" type="submit">
                <i class="fas fa-search"></i>
            </button>
        </div>
    </form>
    <!-- Search for post:end --> --}}
</nav>
