@extends('layout')

@section('content')
    <section class="mt-10 mb-10 ml-30 mr-30">
        @if (isset($category))
            <h2 class="text-center text-2xl font-bold text-primary-900 dark:text-white mb-4">{{ $category->name }}</h2>
        @else
            <h2 class="text-center text-2xl font-bold text-primary-900 dark:text-white mb-4">Todos los productos</h2>
        @endif
        {{-- PRODUCTS --}}
        <section class="mt-6 grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-20">
            @foreach ($products as $product)
                {{-- PRODUCT CARD --}}
                <section class="bg-white dark:bg-gray-800 shadow-md rounded-lg overflow-hidden">
                    @if (file_exists('storage/' . $product->image))
                        <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}"
                            class="w-full h-64 object-cover">
                    @else
                        <img src="{{ asset('storage/images/placeholder.jpg') }}" alt="{{ $product->name }}"
                            class="w-full h-64 object-cover">
                    @endif
                    <div class="p-3">
                        <h3 id="product-name" class="text-lg font-semibold text-primary-800 dark:text-white">
                            {{ $product->name }}
                        </h3>
                        <section class="mt-2">
                            <h3 id="product-price" class="text-xl font-bold text-primary-600 dark:text-white">
                                {{ $product->price }}€</h3>
                            <p class="text-sm text-gray-400 dark:text-gray-400">En stock: {{ $product->stock }}</p>
                        </section>
                        @if ($product->stock > 0)
                            <a href="{{ route('cartAdd', $product) }}"
                                class="block mt-4 w-full bg-primary-600 hover:bg-primary-800 text-white font-bold py-1 px-3 rounded text-center">
                                Añadir al carrito
                            </a>
                        @else
                            <p class="mt-4 text-red-500 font-semibold">Producto agotado</p>
                        @endif
                    </div>
                </section>
            @endforeach
        </section>

        <section class="mt-8 flex justify-center">
            {{ $products->links('pagination') }}
        </section>
    </section>
@endsection
