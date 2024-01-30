<!DOCTYPE html>
<html>

<head>

</head>

<body>
    <h2>Editando el producto {{ $product->id }}</h2>
    @if (session('mensaje'))
        <div class="alert alert-success">{{ session('mensaje') }}</div>
    @endif
    <form action="{{ route('product.save', $product->id) }}" method="POST">
        
        @csrf
        {{-- Cláusula para obtener un token de formulario al enviarlo --}}
        @error('name')
            <div class="alert alert-danger"> El nombre es obligatorio </div>
        @enderror
        @error('description')
            <div class="alert alert-danger"> La descripción es obligatoria </div>
        @enderror
        <input type="text" name="name" class="form-control mb-2" value="{{ $product->title }}"
            placeholder="Nombre del Producto" autofocus>
        <input type="text" name="description" placeholder="Descripción del Producto" class="form-control mb-2"
            value="{{ $product->text }}">
            <input type="number" name="id" value="{{$product->id}}" hidden>
        <button class="btn btn-primary btn-block" type="submit">Guardar cambios</button>
    </form>
</body>

</html>