<?php
use App\Models\Category;
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

    <h2>Lista de productos</h2>

    <a href="{{ route('productCreate') }}">Crear Producto</a>

    <table>
        <thead>
            <th>Categoría</th>
            <th>Producto</th>
            <th>Descripción</th>
            <th>Precio</th>
            <th>Stock</th>
            <th>Imagen</th>
            <th>Acciones</th>
        </thead>
        <tbody>
            @foreach ($products as $product)
                <tr>
                    <td>{{ Category::find($product->category_id)->name }}</td>
                    <td>{{ $product->name }}</td>
                    <td>{{ $product->description }}</td>
                    <td>{{ $product->price }}</td>
                    <td>{{ $product->stock }}</td>
                    <td>{{ $product->image }}</td>

                    <td>
                        <a href="{{ route('productEdit', $product) }}">Editar</a>
                        <form method="POST" action="{{ route('productDelete', $product) }}">
                            @csrf
                            @method('DELETE')
                            <button type="submit">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @endforeach

        </tbody>

    </table>

@endsection
