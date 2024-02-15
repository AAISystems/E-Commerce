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
        @if (isset($orders))
            <h2 class="fw-light">Estos son tus pedidos</h2>
            @foreach ($orders as $order)
                <div class="border p-4">
                    <p>{{ $order->created_at }}</p>
                    <a href="{{route('invoices.create',$order->id)}}">Enviar factura por correo</a>
                </div>
            @endforeach
        @else
            <h2 class="fw-light">Todavía no hay pedidos</h2>
        @endif

    </div>
@endsection

@section('footer')
    @include('template.footer')
@endsection
