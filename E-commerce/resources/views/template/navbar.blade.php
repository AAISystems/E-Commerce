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

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="dropdownId" data-bs-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false"><img
                            src="{{ asset('/img/collapse-categories-svgrepo-com.svg') }}" class="img-fluid rounded-top"
                            alt="logoCategorias" />
                    </a>
                    <div class="dropdown-menu bg-light-purple" aria-labelledby="dropdownId">
                       
                        @foreach($categories as $category)
                        <a class="dropdown-item" href="{{route('category.products',$category)}}">@lang('messages.' . $category->name)</a>


                        @endforeach

                    </div>
                </li>
                @include('template.cart')
            </ul>
            {{-- <form class="d-flex my-2 my-lg-0">
                    <input class="form-control me-sm-2 shadow-sm rounded-5" type="text" placeholder="Buscar..." />
                    <button class="btn text-light my-2 my-sm-0" type="submit">
                        <img src="{{ asset('/img/search-svgrepo-com.svg') }}" class="img-fluid rounded-top"
                            alt="logoLupa" />

                    </button>

                </form> --}}

            </ul>
            <ul class="navbar-nav me-auto mt-2 mt-lg-0">
                <li class="nav-item">
                    @guest
                        <div class="row justify-content-center align-items-center g-2">
                            <div class="col-6"> <a class="nav-link " href="{{ route('login') }}">{{ __('Login') }}</a>
                            </div>
                            <div class="col-6">
                                @if (Route::has('register'))
                                    <a class="nav-link  " href="{{ route('register') }}">{{ __('Register') }}</a>
                                @endif
                            </div>

                        </div>
                    @else
                        {{-- @if (Auth::user()->email_verified_at) --}}
                        <div class="dropdown">
                            <button class="btn text-light dropdown-toggle text" type="button" id="dropdownMenuButton1"
                                data-bs-toggle="dropdown" aria-expanded="false">
                               <img src="{{asset('img/profile-svgrepo-com.svg')}}" alt="icono perfil">
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                <li><a class="dropdown-item" href="{{ route('logout') }}"
                                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">{{ __('Logout') }}</a>
                                </li>
                                <li><a class="dropdown-item" href="{{ route('user.edit') }}"
                                        onclick="event.preventDefault(); document.getElementById('UsersData').submit();">{{ __('Editar perfil') }}</a>
                                </li>
                                <li><a class="dropdown-item" href="{{ route('user.address') }}"
                                    onclick="event.preventDefault(); document.getElementById('UsersAddresses').submit();">{{ __('Envíos') }}</a>
                            </li>
                                <li><a class="dropdown-item" href="{{ route('wishlist.wishes') }}"
                                        onclick="event.preventDefault(); document.getElementById('wishlist').submit();">{{ __('Favoritos') }}</a>
                                </li>
                            </ul>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                            <form id="UsersData" action="{{ route('user.edit') }}" method="GET" class="d-none">
                                @csrf
                            </form>
                            <form id="UsersAddresses" action="{{ route('user.address') }}" method="GET" class="d-none">
                                @csrf
                            </form>
                            <form id="wishlist" action="{{ route('wishlist.wishes') }}" method="GET" class="d-none">
                                @csrf
                            </form>

                            {{-- @endif --}}
                        </div>
                    @endguest
                </li>
            </ul>
        </div>

    </div>
</nav>


