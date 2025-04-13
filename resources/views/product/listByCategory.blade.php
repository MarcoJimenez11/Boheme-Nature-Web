@extends('layout')

@section('content')
    @if (isset($category))
        <h2 class="m-8 text-2xl font-bold text-gray-900 dark:text-white mb-4">{{ $category->name }}</h2>
    @else
        <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-4">Todos los productos</h2>
    @endif

    {{-- PRODUCTS --}}
    <section class="m-10 grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-10">
        @foreach ($products as $product)
            {{-- PRODUCT CARD --}}
            <section class="bg-white dark:bg-gray-800 shadow-md rounded-lg overflow-hidden">
                @if (file_exists('storage/' . $product->image))
                    <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}"
                        class="w-full h-32 object-cover">
                @else
                    <img src="{{ asset('storage/images/placeholder.jpg') }}" alt="{{ $product->name }}"
                        class="w-full h-32 object-cover">
                @endif
                <div class="p-3">
                    <h3 id="product-name" class="text-lg font-semibold text-gray-900 dark:text-white">{{ $product->name }}
                    </h3>
                    <section class="mt-2">
                        <h3 id="product-price" class="text-xl font-bold text-gray-900 dark:text-white">
                            {{ $product->price }}€</h3>
                        <p class="text-sm text-gray-600 dark:text-gray-400">En stock: {{ $product->stock }}</p>
                    </section>
                    @if ($product->stock > 0)
                        <button
                            class="mt-4 w-full bg-primary-500 hover:bg-primary-700 text-white font-bold py-1 px-3 rounded">
                            <a href="{{ route('cartAdd', $product) }}">Añadir al carrito</a>
                        </button>
                    @else
                        <p class="mt-4 text-red-500 font-semibold">Producto agotado</p>
                    @endif
                </div>
            </section>
        @endforeach
    </section>

    <section class="mt-4 flex justify-center">
        {{ $products->links('pagination') }}
    </section>
@endsection
