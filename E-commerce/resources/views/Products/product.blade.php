@extends('template.template')

@section('navbar')
    @include('template.navbar')
@endsection

@section('title', $product->name . ' - AAISystems')

@section('content')
    <div class="container mt-5">
        <div class="row gap-2 ">
            <div class="col-md-5 border p-2">
                <!-- Foto a la izquierda -->
                <img src="{{ asset($product->images()->first()->route) }}" class="img-fluid" alt="{{ $product->name }}">
            </div>
            <div class="col-md-6">
                <!-- Nombre, categoría, marca, descripción -->
                <h3 class="fw-light">{{ $product->name }}</h3>
                <div class="border p-2 mb-2">
                    <p class="text-muted">Categoría @switch($product->categories->first()->id)
                            @case(1)
                                <span class="badge text-bg-info fw-normal">@lang('messages.' . $product->categories->first()->name)</span>
                            @break

                            @case(2)
                                <span class="badge text-bg-success fw-normal">@lang('messages.' . $product->categories->first()->name)</span>
                            @break

                            @case(3)
                                <span class="badge text-bg-dark fw-normal">@lang('messages.' . $product->categories->first()->name)</span>
                            @break

                            @case(4)
                                <span class="badge text-bg-warning fw-normal">@lang('messages.' . $product->categories->first()->name)</span>
                            @break

                            @case(5)
                                <span class="badge text-bg-danger fw-normal">@lang('messages.' . $product->categories->first()->name)</span>
                            @break

                            @case(6)
                                <span class="badge text-bg-secondary fw-normal">@lang('messages.' . $product->categories->first()->name)</span>
                            @break
                        @endswitch
                    </p>

                </div>

                <div class="border p-2">
                    <p class='text-muted'>Descripción </p>
                    <p class="fw-light">{{ $product->description }}</p>
                </div>




                <form action="@if (Auth::user()) {{ route('addCart') }}@else {{ route('login') }} @endif"
                    class="mt-4">
                    @csrf
                    <input type="text" name="idProduct" value={{ $product->id }} hidden>
                    <div class="row justify-content-end align-items-center g-2">
                        <div class="col-6 col-md-4 col-lg-3">
                            <div class="input-group">
                                <input type="text" name="idProduct_{{ $product->id }}" value="{{ $product->id }}"
                                    hidden>
                                <button type="button" onclick="subtract('{{ $product->id }}', {{ $product->price }})"
                                    class="btn btn-light btn-outline-secondary rounded-start-pill">-</button>
                                <input type="text" class="form-control" name="inputQuantity"
                                    id="quantity_{{ $product->id }}" aria-describedby="helpId" placeholder="1"
                                    value="1" readonly />
                                <button type="button" onclick="add('{{ $product->id }}', {{ $product->price }})"
                                    class="btn btn-secondary rounded-end-pill">+</button>
                            </div>
                        </div>
                        <div class="col-6 col-md-4 col-lg-3">

                            @if ($product->discount && $product->discount->valid)
                                <p class="fs-6  fw-light text-danger"><del>{{ $product->price }} €</del></p>
                                <p class="fs-3  fw-light ">
                                    {{ $product->price * (1 - $product->discount->amount / 100) }} €</p>
                            @else
                                <p class="fs-3  fw-light">{{ $product->price }} €</p>
                            @endif

                        </div>

                    </div>



                    <div class="row justify-content-center align-items-center g-2">
                        <button class="btn btn-light mt-3 col-12 " type="submit">
                            <img src="{{ asset('img/cart-shopping-fast-svgrepo-com.svg') }}" class="img-fluid"
                                alt="" />

                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('footer')
    @include('template.footer')
@endsection
