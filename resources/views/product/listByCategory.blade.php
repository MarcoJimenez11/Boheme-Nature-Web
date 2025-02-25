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

    @if (isset($category))
        <h2>{{ $category->name }}</h2>
    @else
        <h2>Todos los productos</h2>
    @endif

    <section class="product-list">
        @foreach ($products as $product)
            <section class="product-item">
                {{-- <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}"> --}}
                <img src="{{ asset('../resources/storage/placeholder.webp') }}" alt="{{ $product->name }}">
                <h3 id="product-name">{{ $product->name }}</h3>
                <section>
                    <h3 id="product-price">{{ $product->price }}€</h3>
                    <p>En stock: {{ $product->stock }}</p>
                </section>
                <button><a href="{{ route('cartAdd', $product) }}">Añadir al carrito</a></button>
            </section>
        @endforeach
    </section>
@endsection
