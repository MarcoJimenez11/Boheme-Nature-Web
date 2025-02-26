<?php
use App\Models\Product;
?>

<h1>¡Gracias por compar en Marcodona!</h1>

<p>Tu pedido se ha realizado con éxito. Puedes seguir el estado desde nuestra página web en el apartado "Mis Pedidos"</p>

<p>Estos son los detalles de tu pedido</p>

<table>
    <thead>
        <th>Provincia</th>
        <th>Localidad</th>
        <th>Dirección</th>
        <th>Coste total</th>
        <th>Estado</th>
        <th>Fecha de creación</th>
    </thead>
    <tbody>
        <tr>
            <td>{{ $order->province }}</td>
            <td>{{ $order->locality }}</td>
            <td>{{ $order->direction }}</td>
            <td>{{ $order->getTotalCost() }} €</td>
            <td>{{ $order->status }}</td>
            <td>{{ $order->created_at }}</td>
        </tr>
    </tbody>
</table>

<table>
    <thead>
        <th>Producto</th>
        <th>Cantidad</th>
        <th>Precio</th>
        <th>Precio total</th>
    </thead>
    <tbody>
        @foreach ($orderLines as $line)
            <tr>
                <td>{{ Product::find($line->product_id)->name }}</td>
                <td>{{ $line->amount }}</td>
                <td>{{ Product::find($line->product_id)->price }} €</td>
                <td>{{ Product::find($line->product_id)->price * $line->amount }} €</td>
            </tr>
        @endforeach
    </tbody>
</table>

<h2>¡Esperamos que haya tenido una agradable experiencia!</h2>