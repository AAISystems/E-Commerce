@extends('template.template')

@section('navbar')
    @include('template.navbar')
@endsection

@section('title', 'Generar factura')

@section('script')
    <script defer src="{{ asset('js/orderAddress.js') }}"></script>

@endsection

@section('content')
    <div class="container mt-5 min-vh-100">

        <h2 class="fw-light">Esta es tu factura</h2>
        <p>{{ $invoice->id }}</p>


    </div>
@endsection

@section('footer')
    @include('template.footer')
@endsection
