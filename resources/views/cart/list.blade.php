<?php
use App\Models\Product;
?>


@extends('layout')

@section('content')

    @include('errorAlert')


    @if (!is_null($cartItems) && count($cartItems) > 0)
        <section class="bg-white py-8 antialiased dark:bg-gray-900 md:py-16">
            <div class="mx-auto max-w-screen-xl px-4 2xl:px-0">
                <h2 class="text-xl font-semibold text-gray-900 dark:text-white sm:text-2xl">Carrito de la compra</h2>

                <div class="mt-6 sm:mt-8 md:gap-6 lg:flex lg:items-start xl:gap-8">
                    {{-- ITEM LIST --}}
                    <div class="mx-auto w-full flex-none lg:max-w-2xl xl:max-w-4xl">
                        <div class="space-y-6">
                            {{-- ITEM --}}
                            @forelse ($cartItems as $key => $item)
                                <div
                                    class="rounded-lg border border-gray-200 bg-white p-4 shadow-sm dark:border-gray-700 dark:bg-gray-800 md:p-6">
                                    <div class="space-y-4 md:flex md:items-center md:justify-between md:gap-6 md:space-y-0">
                                        <a href="#" class="shrink-0 md:order-1">
                                            @if (file_exists('storage/' . Product::find($item['id'])->image))
                                                <img class="h-20 w-20"
                                                    src="{{ asset('storage/' . Product::find($item['id'])->image) }}"
                                                    alt="Imagen del producto" />
                                            @else
                                                <img class="h-20 w-20" src="{{ asset('storage/images/placeholder.jpg') }}"
                                                    alt="Imagen del producto" />
                                            @endif
                                        </a>

                                        <label for="counter-input" class="sr-only">Elige cantidad:</label>
                                        <div class="flex items-center justify-between md:order-3 md:justify-end">
                                            <div class="flex items-center">
                                                {{-- DECREMENT AMOUNT --}}
                                                <form method="POST"
                                                    action="{{ route('changeAmountItem', ['item' => $key, 'amount' => -1]) }}">
                                                    @csrf
                                                    @method('PUT')
                                                    <button type="submit" id="decrement-button"
                                                        data-input-counter-decrement="counter-input"
                                                        class="inline-flex h-5 w-5 shrink-0 items-center justify-center rounded-md border border-gray-300 bg-gray-100 hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-gray-100 dark:border-gray-600 dark:bg-gray-700 dark:hover:bg-gray-600 dark:focus:ring-gray-700">
                                                        <svg class="h-2.5 w-2.5 text-gray-900 dark:text-white"
                                                            aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                                            fill="none" viewBox="0 0 18 2">
                                                            <path stroke="currentColor" stroke-linecap="round"
                                                                stroke-linejoin="round" stroke-width="2" d="M1 1h16" />
                                                        </svg>
                                                    </button>
                                                </form>

                                                {{-- ITEM AMOUNT --}}
                                                <input type="text" id="counter-input" data-input-counter
                                                    class="w-10 shrink-0 border-0 bg-transparent text-center text-sm font-medium text-gray-900 focus:outline-none focus:ring-0 dark:text-white"
                                                    placeholder="" value="{{ $item['amount'] }}" required />
                                                {{-- ADD AMOUNT --}}
                                                <form method="POST"
                                                    action="{{ route('changeAmountItem', ['item' => $key, 'amount' => 1]) }}">
                                                    @csrf
                                                    @method('PUT')
                                                    <button type="submit" id="increment-button"
                                                        data-input-counter-increment="counter-input"
                                                        class="inline-flex h-5 w-5 shrink-0 items-center justify-center rounded-md border border-gray-300 bg-gray-100 hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-gray-100 dark:border-gray-600 dark:bg-gray-700 dark:hover:bg-gray-600 dark:focus:ring-gray-700">
                                                        <svg class="h-2.5 w-2.5 text-gray-900 dark:text-white"
                                                            aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                                            fill="none" viewBox="0 0 18 18">
                                                            <path stroke="currentColor" stroke-linecap="round"
                                                                stroke-linejoin="round" stroke-width="2"
                                                                d="M9 1v16M1 9h16" />
                                                        </svg>
                                                    </button>
                                                </form>

                                            </div>
                                            {{-- ITEM PRICE --}}
                                            <div class="text-end md:order-4 md:w-32">
                                                <p class="text-base font-bold text-gray-900 dark:text-white">
                                                    {{ number_format(Product::find($item['id'])->price * $item['amount'],2) }} €</p>
                                            </div>
                                        </div>

                                        <div class="w-full min-w-0 flex-1 space-y-4 md:order-2 md:max-w-md">
                                            {{-- ITEM NAME --}}
                                            <a href="#"
                                                class="text-base font-medium text-gray-900 hover:underline dark:text-white">{{ Product::find($item['id'])->name }}</a>

                                            <div class="flex items-center gap-4">
                                                {{-- REMOVE ITEM --}}
                                                <form method="POST" action="{{ route('cartItemDelete', $key) }}">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                        class="inline-flex items-center text-sm font-medium text-red-600 hover:underline dark:text-red-500">
                                                        <svg class="me-1.5 h-5 w-5" aria-hidden="true"
                                                            xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                            fill="none" viewBox="0 0 24 24">
                                                            <path stroke="currentColor" stroke-linecap="round"
                                                                stroke-linejoin="round" stroke-width="2"
                                                                d="M6 18 17.94 6M18 18 6.06 6" />
                                                        </svg>
                                                        Quitar
                                                    </button>
                                                </form>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{-- <form method="POST" action="{{ route('cartDeleteAll') }}">
                                    @csrf
                                    @method('DELETE')
                                    <button class="inline-flex items-center text-sm font-medium text-red-600 hover:underline dark:text-red-500" type="submit"><svg class="me-1.5 h-5 w-5" aria-hidden="true"
                                        xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        fill="none" viewBox="0 0 24 24">
                                        <path stroke="currentColor" stroke-linecap="round"
                                            stroke-linejoin="round" stroke-width="2"
                                            d="M6 18 17.94 6M18 18 6.06 6" />
                                    </svg> Vaciar carrito</button>
                                </form> --}}
                            @empty
                                <section
                                    class="flex flex-col items-center justify-center min-h-[40vh] bg-white dark:bg-gray-900">
                                    <h2 class="text-2xl font-bold text-primary-700 dark:text-white mb-2">Tu carrito está
                                        vacío</h2>
                                    <p class="text-gray-500 dark:text-gray-400 mb-6 text-center max-w-md">
                                        Aún no has añadido productos a tu carrito.<br>
                                        Descubre nuestros productos y encuentra lo que buscas.
                                    </p>
                                    <a href="{{ route('productListByCategory', '1') }}"
                                        class="inline-flex items-center rounded-lg bg-primary-700 px-5 py-2.5 text-sm font-medium text-white hover:bg-primary-800 focus:outline-none focus:ring-4 focus:ring-primary-300 dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800 transition">
                                        <svg class="h-5 w-5 mr-2" fill="none" stroke="currentColor" stroke-width="2"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13l-1.35 2.7A1 1 0 0 0 7 17h10a1 1 0 0 0 .95-.68L21 9M7 13V6h13" />
                                        </svg>
                                        Ver tienda
                                    </a>
                                </section>
                            @endforelse
                        </div>
                    </div>

                    <div class="mx-auto mt-6 max-w-4xl flex-1 space-y-6 lg:mt-0 lg:w-full">
                        <div
                            class="space-y-4 rounded-lg border border-gray-200 bg-white p-4 shadow-sm dark:border-gray-700 dark:bg-gray-800 sm:p-6">
                            <p class="text-xl font-semibold text-gray-900 dark:text-white">Resumen del pedido</p>

                            <div class="space-y-4">
                                <div class="space-y-2">
                                    {{-- Calcular el precio total --}}
                                    @php
                                        $total = 0;
                                        foreach ($cartItems as $item) {
                                            $total += Product::find($item['id'])->price * $item['amount'];
                                        }
                                    @endphp

                                    <dl class="flex items-center justify-between gap-4">
                                        <dt class="text-base font-normal text-gray-500 dark:text-gray-400">Precio original
                                        </dt>
                                        <dd class="text-base font-medium text-gray-900 dark:text-white">{{ number_format($total,2) }}
                                            €</dd>
                                    </dl>

                                    {{-- <dl class="flex items-center justify-between gap-4">
                                        <dt class="text-base font-normal text-gray-500 dark:text-gray-400">Descuento</dt>
                                        <dd class="text-base font-medium text-green-600">-$299.00</dd>
                                    </dl> --}}

                                    {{-- <dl class="flex items-center justify-between gap-4">
                                        <dt class="text-base font-normal text-gray-500 dark:text-gray-400">Gastos de envío
                                        </dt>
                                        <dd class="text-base font-medium text-gray-900 dark:text-white">$99</dd>
                                    </dl> --}}

                                    {{-- <dl class="flex items-center justify-between gap-4">
                                        <dt class="text-base font-normal text-gray-500 dark:text-gray-400">IVA</dt>
                                        <dd class="text-base font-medium text-gray-900 dark:text-white">$799</dd>
                                    </dl> --}}
                                </div>

                                <dl
                                    class="flex items-center justify-between gap-4 border-t border-gray-200 pt-2 dark:border-gray-700">
                                    <dt class="text-base font-bold text-gray-900 dark:text-white">Total</dt>
                                    <dd class="text-base font-bold text-gray-900 dark:text-white">{{ number_format($total,2) }} €
                                    </dd>
                                </dl>
                            </div>

                            @auth
                                <a class="flex w-full items-center justify-center rounded-lg bg-primary-700 px-5 py-2.5 text-sm font-medium text-white hover:bg-primary-800 focus:outline-none focus:ring-4 focus:ring-primary-300 dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800"
                                    href="{{ route('orderCreate') }}">Proceder con el pedido</a>
                            @endauth
                            @guest
                                <a class="flex w-full items-center justify-center rounded-lg bg-primary-700 px-5 py-2.5 text-sm font-medium text-white hover:bg-primary-800 focus:outline-none focus:ring-4 focus:ring-primary-300 dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800"
                                    href="{{ route('login') }}">Inicia sesión para proceder con el pedido</a>
                            @endguest

                            <div class="flex items-center justify-center gap-2">
                                <span class="text-sm font-normal text-gray-500 dark:text-gray-400"> o </span>
                                <a href="{{ route('productListByCategory', '1') }}" title=""
                                    class="inline-flex items-center gap-2 text-sm font-medium text-primary-700 underline hover:no-underline dark:text-primary-500">
                                    Continuar comprando
                                    <svg class="h-5 w-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                        fill="none" viewBox="0 0 24 24">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="2" d="M19 12H5m14 0-4 4m4-4-4-4" />
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @else
        <section class="flex flex-col items-center justify-center min-h-[40vh] bg-white dark:bg-gray-900">
            <h2 class="text-2xl font-bold text-primary-700 dark:text-white mb-2">Tu carrito está vacío</h2>
            <p class="text-gray-500 dark:text-gray-400 mb-6 text-center max-w-md">
                Aún no has añadido productos a tu carrito.<br>
                Descubre nuestros productos y encuentra lo que buscas.
            </p>
            <a href="{{ route('productListByCategory', '1') }}"
                class="inline-flex items-center rounded-lg bg-primary-700 px-5 py-2.5 text-sm font-medium text-white hover:bg-primary-800 focus:outline-none focus:ring-4 focus:ring-primary-300 dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800 transition">
                <svg class="h-5 w-5 mr-2" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13l-1.35 2.7A1 1 0 0 0 7 17h10a1 1 0 0 0 .95-.68L21 9M7 13V6h13" />
                </svg>
                Ver tienda
            </a>
        </section>
    @endif
@endsection
