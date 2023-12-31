<nav class="navbar navbar-expand-lg navbar-dark bg-primary mb-4">
    <div class="container">
        <a class="navbar-brand" href="/">My Blog</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav me-auto">
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('/') ? 'active' : '' }}" aria-current="page" href="{{ route('home') }}">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('about') ? 'active' : '' }}" href="{{ route('about') }}">About</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('gallery') ? 'active' : '' }}" href="{{ route('gallery') }}">Gallery</a>
                </li>
                {{-- @hasRole('admin')
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('users') ? 'active' : '' }}" href="{{ route('users') }}">Users</a>
                </li>
                @endHasRole --}}
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('articles') ? 'active' : '' }}" href="{{ route('articles.index') }}">Articles</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button"
                        aria-expanded="false">Categories</a>
                    <ul class="dropdown-menu">
                        @foreach ($categories as $category)
                        <li>
                            <a class="dropdown-item" href="{{ route('categories.show', $category) }}">
                                {{ $category->name }}
                            </a>
                        </li>
                        @endforeach
                    </ul>
                </li>
                <form action="{{ route('articles.search') }}" method="GET" class="d-flex ms-4" role="search">
                    <input class="form-control me-2" type="search" name="q" placeholder="Search" aria- label="Search">
                    <button class="btn btn-outline-secondary" type="submit">Search</button>
                </form>
            </ul>
            {{-- <form class="d-flex" role="search">
                <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-success" type="submit">Search</button>
            </form> --}}
            <ul class="navbar-nav">
                @auth
                <li class="nav-item dropdown">
                    <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown" role="button" aria-expanded="false">{{ Auth::user()->name }}</a>
                    <ul class="dropdown-menu">
                        <li>
                            <a class="dropdown-item" href="{{ route('users.edit') }}">
                                Settings
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="{{ route('change-password.edit') }}">
                                Change password
                            </a>
                        </li>
                        @hasAnyRoles(['admin', 'writer'])
                        <li><hr class="dropdown-divider"></li>
                        <li>
                            <a href="{{ route('articles.create') }}" class="dropdown-item">
                                Create new article
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="{{ route('articles.table') }}">
                                Articles
                            </a>
                        </li>
                        @endHasAnyRoles
                        @hasRole('admin')
                        <li>
                            <a href="{{ route('categories.create') }}" class="dropdown-item">
                                Create new category
                            </a>
                        </li>
                        <li><hr class="dropdown-divider"></li>
                        <li>
                            <a class="dropdown-item" href="{{ route('tags.create') }}">
                                Create new tag
                            </a>
                        </li>
                        <li><hr class="dropdown-divider"></li>
                        <li>
                            <a class="dropdown-item" href="{{ route('users') }}">
                                Users
                            </a>
                        </li>
                        @endHasRole
                        <li><hr class="dropdown-divider"></li>
                        <li>
                            <form method="POST" action="{{ route('logout') }}">
                            @csrf
                                <a href="{{ route('logout') }}" class="dropdown-item" onclick="event.preventDefault(); this.closest('form').submit();">Logout</a></li>
                            </form>
                    </ul>
                </li>
                @else
                <li class="nav-item">
                    <a href="{{ route('register') }}" class="nav-link {{ Request::is('register') ? 'active' : '' }}">
                        Register
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('login') }}" class="nav-link {{ Request::is('login') ? 'active' : '' }}">
                        Login
                    </a>
                </li>
                @endauth
            </ul>
        </div>
    </div>
</nav>