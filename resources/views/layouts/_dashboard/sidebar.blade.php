<nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
    <div class="sb-sidenav-menu">
        <div class="nav">
            <a class="nav-link {{ set_active('dashboard.index') }}" href="{{ route('dashboard.index') }}">
                <div class="sb-nav-link-icon">
                    <i class="fas fa-tachometer-alt"></i>
                </div>
                Dashboard
            </a>
            <div class="sb-sidenav-menu-heading">Master</div>
            {{-- link: posts --}}
            @can('manage_posts')
                <a class="nav-link {{ set_active(['posts.index', 'posts.create', 'posts.show', 'posts.edit']) }}"
                    href="{{ route('posts.index') }}">
                    <div class="sb-nav-link-icon">
                        <i class="far fa-newspaper"></i>
                    </div>
                    Posts
                </a>
            @endcan
            {{-- Menu Categories --}}
            @can('manage_categories')
                <a class="nav-link {{ set_active(['categories.index', 'categories.create', 'categories.edit', 'categories.show']) }}"
                    href="{{ route('categories.index') }}">
                    <div class="sb-nav-link-icon">
                        <i class="fas fa-bookmark"></i>
                    </div>
                    Categories
                </a>
            @endcan
            {{-- link:tags --}}
            @can('manage_tags')
                <a class="nav-link {{ set_active(['tags.index', 'tags.create', 'tags.edit']) }}"
                    href="{{ route('tags.index') }}">
                    <div class="sb-nav-link-icon">
                        <i class="fas fa-tags"></i>
                    </div>
                    Tags
                </a>
            @endcan
            <div class="sb-sidenav-menu-heading">User permission</div>
            {{-- link:users --}}
            @can('manage_users')
                <a class="nav-link {{ set_active(['users.index', 'users.create', 'users.edit']) }}"
                    href="{{ route('users.index') }}">
                    <div class="sb-nav-link-icon">
                        <i class="fas fa-user"></i>
                    </div>
                    User
                </a>
            @endcan

            {{-- link:roles --}}
            @can('manage_roles')
                <a class="nav-link {{ set_active(['roles.index', 'roles.show', 'roles.create', 'roles.edit']) }}"
                    href="{{ route('roles.index') }}">
                    <div class="sb-nav-link-icon">
                        <i class="fas fa-user-shield"></i>
                    </div>
                    Role
                </a>
            @endcan
            <div class="sb-sidenav-menu-heading">Donatur ZIS</div>
            {{-- link : donatur --}}
            <a class="nav-link {{ set_active(['donors.index', 'donors.show']) }}" href="{{ route('donors.index') }}">
                <div class="sb-nav-link-icon">
                    <i class="fas fa-hand-holding-heart"></i>
                </div>
                Donatur
            </a>
            <div class="sb-sidenav-menu-heading">Settings</div>
            {{-- link : file manager --}}
            <a class="nav-link {{ set_active(['filemanager.index']) }}" href="{{ route('filemanager.index') }}">
                <div class="sb-nav-link-icon">
                    <i class="fas fa-photo-video"></i>
                </div>
                File manager
            </a>
        </div>
    </div>
    <div class="sb-sidenav-footer">
        <div class="small">Logged in as: {{ Auth::user()->name }}</div>
        <!-- show username -->
    </div>
</nav>
