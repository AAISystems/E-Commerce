<li class="nav-item dropdown">
    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown"
        aria-haspopup="true" aria-expanded="false">
        <img src="{{asset('img/cart-shopping-svgrepo-com.svg')}}" class="img-fluid rounded-top" alt="logoCart" />
    </a>
    <div class="dropdown-menu overflow-auto cart-size shadow" aria-labelledby="navbarDropdown">
        <div class="container">
            @if (isset($productsInCart))
                @if ($productsInCart->isEmpty())
                    <p class="text-muted">El carrito está vacío</p>
                @endif
                @foreach ($productsInCart as $product)
                    <div class="row justify-content-center align-items-center gap-1 border-bottom mb-1 shadow-sm">
                        <div class="col-3 border-end">
                            <img src="{{ asset($product->images->first()->route) }}" class="img-fluid rounded-top" alt="imgProduct" />
                        </div>
                        <div class="col-5">
                            <p>{{ $product->name }}</p>
                            <p>x{{ $product->pivot->quantity }}</p>

                        </div>
                        <div class="col-3">
                            <a href="{{route('removeFromCart',$product->id)}}"><button class="btn  fw-light" type="submit">X</button></a>
                        </div>

                    </div>

                    
                @endforeach
                <p class="text-end mb-2 mt-3 fw-light">Total:<span class='fs-5'> {{Auth::user()->cart->amount}}</span>€</p>
                <div class="row justify-content-center align-items-center mt-3 gap-1">
                    <a name="" id="" class="btn btn-light col-3" href="{{ route('dumpCart') }}"
                    role="button"><img src="{{asset('img/cart-xmark-svgrepo-com.svg')}}" class="img-fluid rounded-top" alt="vaciarCarrito" /></a>
                    <a name="" id="" class="btn btn-light col-8" href="@if(!$productsInCart->isEmpty()) {{ route('checkout')}} @endif"
                    role="button"><img src="{{asset('img/cart-shopping-fast-svgrepo-com.svg')}}" class="img-fluid rounded-top" alt="Comprar" /></a>
                </div>

                
            @else
                <p class="text-muted">El carrito está vacío</p>
            @endif
        </div>
    </div>
</li>
