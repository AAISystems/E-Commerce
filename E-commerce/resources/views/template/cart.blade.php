<li class="nav-item">
    </a>
<li class="nav-item dropdown">
    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown"
        aria-haspopup="true" aria-expanded="false">
        <img src="" class="img-fluid rounded-top" alt="logoCart" />
    </a>
    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
        <div class="container">
            @if (!$productsInCart->isEmpty())
                @foreach ($productsInCart as $product)
                    <p>{{ $product->name }}</p>
                    <form action="{{ route('removeFromCart') }}">
                        @csrf

                        <input type="text" name="idProduct" value={{ $product->id }} hidden>
                        <button class="btn btn-success" type="submit">Eliminar del carrito</button>
                    </form>
                @endforeach
            @else
                <p class="text-muted">El carrito está vacío</p>
            @endif
        </div>
    </div>
</li>
</li>
