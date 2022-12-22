<nav class="navbar navbar-expand-lg navbar-light bg-light shadow-sm">
    <div class="container px-4 px-lg-5">
        <a class="navbar-brand" style="font-size:1.7rem" href="{{ url('/') }}">
            GlQuadrics
        </a>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4">
                <li class="nav-item"><a class="nav-link active" aria-current="page" href="/">Home</a></li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false" v-pre>Platforms</a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="#!">All Products</a></li>
                        <li>
                            <hr class="dropdown-divider" />
                        </li>
                        @foreach($platforms as $platform)
                        <li><a class="dropdown-item" href="/platforms/{$platform}">{{$platform}}</a></li>
                        @endforeach
                    </ul>
                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false" v-pre>Categories</a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="#!">All Products</a></li>
                        <li>
                            <hr class="dropdown-divider" />
                        </li>
                        @foreach($categories as $category)
                        <li><a class="dropdown-item" href="/categories/{$category}">{{$category}}</a></li>
                        @endforeach
                    </ul>
                </li>
            </ul>
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0 ms-lg-4">
                <div class="d-flex">
                    <form action="{{ url('search') }}" method="GET" role="search"
                        class="d-flex justify-content-center">
                        <input class="form-control me-2 outline-dark search-bar" name="search" type="text"
                            value="{{ Request::get('search') }}" placeholder="Search" aria-label="Search"
                            style="width: 65%;">
                        <button class="btn btn-outline-dark" type="submit">Search</button>

                    </form>
                    <form class="d-flex ml-auto" style="margin-right:15px;">
                        @livewire('cart-counter')
                    </form>
                </div>
                @guest
                    <li class="nav-item"><a class="nav-link" href="/login">Login</a></li>
                    <li class="nav-item"><a class="nav-link" href="/register">Register</a></li>
                @else
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            User
                        </a>
                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('profile.show') }}">Profile</a>

                            <a class="dropdown-item" href="{{ route('logout') }}"
                                onclick="event.preventDefault();  document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>
