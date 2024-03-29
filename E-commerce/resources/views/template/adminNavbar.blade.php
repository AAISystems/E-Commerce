<nav class="navbar navbar-expand-lg bg-purple shadow sticky-top">
    <div class="container">
        <a class="navbar-brand" href="{{ route('home') }}">
            <img src="{{ asset('img/lavandaResize.png') }}" class="img-fluid w-25 p-3" alt="logoAAISystems" />
            AAISystems</a>
        
            <button class="navbar-toggler d-lg-none" type="button" data-bs-toggle="collapse"
                data-bs-target="#collapsibleNavId" aria-controls="collapsibleNavId" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="collapsibleNavId">
                <ul class="navbar-nav me-auto mt-2 mt-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" href="#" aria-current="page"><img
                                src="{{ asset('img//shop-svgrepo-com.svg') }}" class="img-fluid rounded-top"
                                alt="" />
                        </a>
                    </li>

                {{-- <form class="d-flex my-2 my-lg-0">
                    <input class="form-control me-sm-2 shadow-sm rounded-5" type="text" placeholder="Buscar..." />
                    <button class="btn text-light my-2 my-sm-0" type="submit">
                        <img src="{{ asset('/img/search-svgrepo-com.svg') }}" class="img-fluid rounded-top"
                            alt="logoLupa" />

                    </button>

                </form> --}}
                @guest
                    <button class="nav-item btn btn-primary me-2">
                        <a class="nav-link " href="{{ route('login') }}">{{ __('Login') }}</a>
                    </button>
                    @if (Route::has('register'))
                        <button class="nav-item btn btn-primary me-2">
                            <a class="nav-link  " href="{{ route('register') }}">{{ __('Register') }}</a>
                        </button>
                    @endif
                @else
                    {{-- @if (Auth::user()->email_verified_at) --}}
                    <div class="dropdown">
                        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            {{ Auth::user()->name }}
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                            <li><a class="dropdown-item" href="{{ route('logout') }}"
                                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">{{ __('Logout') }}</a>
                            </li>
                           
                        </ul>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>

                        {{-- @endif --}}
                    </div>
                @endguest
                </ul>
            </div>
           
    </div>
</nav>
