<?php
use App\Models\Product;
?>


@extends('layout')

@section('content')

    @if ($errors->any())
        <section class="errorList">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </section>
    @endif

    <h2>Lista de productos del pedido</h2>

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
    <p>Coste total: {{ $totalCost }} €</p>

@endsection