@extends('layout')

@section('content')

    @if ($errors->any())
        <section class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </section>
    @endif

    @if (isset($category))
        <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-4">{{ $category->name }}</h2>
    @else
        <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-4">Todos los productos</h2>
    @endif

    <section class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
        @foreach ($products as $product)
            <section class="bg-white dark:bg-gray-800 shadow-md rounded-lg overflow-hidden">
                <img src="{{ asset('../resources/storage/placeholder.webp') }}" alt="{{ $product->name }}" class="w-full h-48 object-cover">
                <div class="p-4">
                    <h3 id="product-name" class="text-lg font-semibold text-gray-900 dark:text-white">{{ $product->name }}</h3>
                    <section class="mt-2">
                        <h3 id="product-price" class="text-xl font-bold text-gray-900 dark:text-white">{{ $product->price }}€</h3>
                        <p class="text-gray-600 dark:text-gray-400">En stock: {{ $product->stock }}</p>
                    </section>
                    @if ($product->stock > 0)
                        <button class="mt-4 w-full bg-primary-500 hover:bg-primary-700 text-white font-bold py-2 px-4 rounded">
                            <a href="{{ route('cartAdd', $product) }}">Añadir al carrito</a>
                        </button>
                    @else
                        <p class="mt-4 text-red-500 font-semibold">Producto agotado</p>
                    @endif
                </div>
            </section>
        @endforeach
    </section>

    {{-- Esta sección añade la paginación. El parámetro de links, por alguna razón, me permite dar estilos propios(sin él no funcionan) --}}
    <section class="mt-6">
        {{ $products->links('pagination::bootstrap-4') }}
    </section>

@endsection