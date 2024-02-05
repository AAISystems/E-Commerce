<li class="nav-item dropdown">
    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown"
        aria-haspopup="true" aria-expanded="false">
        <img src="" class="img-fluid rounded-top" alt="logoCart" />
    </a>
    <div class="dropdown-menu overflow-auto" aria-labelledby="navbarDropdown">
        <div class="container">
            @if (isset($productsInCart))
                @if ($productsInCart->isEmpty())
                    <p class="text-muted">El carrito está vacío</p>
                @endif
                @foreach ($productsInCart as $product)
                    <div class="row justify-content-center align-items-center g-2 w-50">
                        <div class="col-6">
                            <img src="" class="img-fluid rounded-top" alt="imgProduct" />
                        </div>
                        <div class="col-6">
                            <p>{{ $product->name }}</p>
                            <p>Cantidad: {{ $product->pivot->quantity }}</p>

                        </div>
                        <div class="col-6">

                        </div>

                    </div>

                    <form action="{{ route('removeFromCart') }}">
                        @csrf
                        <input type="text" name="idProduct" value={{ $product->id }} hidden>
                        <button class="btn btn-danger" type="submit">Eliminar del carrito</button>
                    </form>
                @endforeach
                <div class="row justify-content-center align-items-center mt-3 g-2">
                    <a name="" id="" class="btn btn-warning col-6" href="{{ route('dumpCart') }}"
                    role="button">Vaciar carrito</a>
                    <a name="" id="" class="btn btn-success col-6" href="{{ route('checkout') }}"
                    role="button">Comprar</a>
                </div>

                
            @else
                <p class="text-muted">El carrito está vacío</p>
            @endif
        </div>
    </div>
</li>
