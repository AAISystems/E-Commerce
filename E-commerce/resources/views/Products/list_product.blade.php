@extends('template.template')

@section('navbar')
    @include('template.navbar')
@endsection

@section('title', 'Lista de Productos')

@section('content')
    <div class="container">
        @foreach ($products as $product)
        <ul>
            <li>
                {{$product->name}};
            </li>
        </ul>



        @endforeach
    </div>
@endsection

@section('footer')
    @include('template.footer')
@endsection
