<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Factura</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            
        }

        .container {
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
            margin-top: 20px;
            border-radius: 10px;
            max-width: 600px;
            margin: 0 auto;
        }

        h1 {
            color: #9500ff;
            text-align: center;
        }

        h5 {
            color: #6c757d;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            border: 1px solid #dee2e6;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #da74ff;
            color: #fff;
        }

        .mt-4 {
            margin-top: 1.5rem;
        }

        .text-end {
            text-align: right;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Factura</h1>
        <div>
            <div>
                <h5>Vendedor</h5>
                <p><strong>Nombre:</strong> {{ $invoice->sellerName }}</p>
                <p><strong>NIF:</strong> {{ $invoice->sellerNIF }}</p>
                <p><strong>Dirección:</strong> {{ $invoice->sellerAddress }}</p>
            </div>
            <div>
                <h5>Comprador</h5>
                <p><strong>Nombre:</strong> {{ $invoice->userName }}</p>
                <p><strong>NIF:</strong> {{ $invoice->userNIF }}</p>
                <p><strong>Dirección:</strong> {{ $invoice->userAddress }}</p>
            </div>
        </div>

        <table>
            <thead>
                <tr>
                    <th>Producto</th>
                    <th>Cantidad</th>
                    <th>Precio/unidad</th>
                    <th>Precio</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($invoice->products as $key)
                    <tr>
                        <td>{{ $key->name }}</td>
                        <td>{{ $key->pivot->quantity }}</td>
                        <td>{{ $key->price }}€</td>
                        <td>{{ $key->price * $key->pivot->quantity }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="mt-4">
            <div>
                <p><strong>Subtotal:</strong> {{ $invoice->total * 0.79 }}€</p>
                <p><strong>Base imponible:</strong> {{ $invoice->total * 0.79 }}€</p>
            </div>
            <div class="text-end">
                <p><strong>% Impuesto:</strong> 21%</p>
                <p><strong>Total:</strong> {{ $invoice->total }}€</p>
            </div>
        </div>
    </div>
</body>
</html>
