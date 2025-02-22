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

    <table>
        <thead>
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
                    <td>{{ $product->name }}</td>
                    <td>{{ $product->description }}</td>
                    <td>{{ $product->price }}</td>
                    <td>{{ $product->stock }}</td>
                    <td>{{ $product->image }}</td>

                    <td>
                        <a href="{{ route('cartAdd', $product) }}">Añadir al carrito</a>
                        {{-- <form method="POST" action="{{ route('cartAdd', ['name' => $product->name, 'price' => $product->price, 'amount' => 1]) }}">
                            @csrf
                            <button type="submit">Añadir al carrito</button>
                        </form> --}}
                    </td>
                </tr>
            @endforeach

        </tbody>

    </table>

@endsection
