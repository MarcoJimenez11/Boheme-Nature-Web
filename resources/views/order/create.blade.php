<?php
use App\Models\Product;
?>

@extends('layout')

@section('content')
    <section class="bg-white py-8 antialiased dark:bg-gray-900 md:py-16">
        @include('errorAlert')
        <div class="mx-auto max-w-screen-xl px-4 2xl:px-0">
            <div class="mx-auto max-w-5xl">
                <h2 class="text-xl font-semibold text-gray-900 dark:text-white sm:text-2xl">Datos del pedido</h2>

                <div class="mt-6 sm:mt-8 lg:flex lg:items-start lg:gap-12">
                    <form action="{{ route('orderCreatePost') }}" method="POST"
                        class="w-full rounded-lg border border-gray-200 bg-white p-4 shadow-sm dark:border-gray-700 dark:bg-gray-800 sm:p-6 lg:max-w-xl lg:p-8">
                        @csrf
                        <div class="mb-6 grid grid-cols-2 gap-4">
                            {{-- PROVINCE --}}
                            <div class="col-span-2 sm:col-span-1">
                                <label for="orderProvince"
                                    class="mb-2 block text-sm font-medium text-gray-900 dark:text-white">
                                    Provincia </label>
                                <input type="text" id="orderProvince" name="orderProvince"
                                    class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-primary-500 focus:ring-primary-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder:text-gray-400 dark:focus:border-primary-500 dark:focus:ring-primary-500"
                                    placeholder="Granada" value="{{ old('orderProvince') }}" required />
                            </div>

                            {{-- LOCALITY --}}
                            <div class="col-span-2 sm:col-span-1">
                                <label for="orderLocality"
                                    class="mb-2 block text-sm font-medium text-gray-900 dark:text-white">
                                    Localidad </label>
                                <input type="text" id="orderLocality" name="orderLocality"
                                    class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-primary-500 focus:ring-primary-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder:text-gray-400 dark:focus:border-primary-500 dark:focus:ring-primary-500"
                                    placeholder="Atarfe" value="{{ old('orderLocality') }}" required />
                            </div>

                            {{-- DIRECTION --}}
                            <div class="col-span-2 sm:col-span-1">
                                <label for="orderDirection"
                                    class="mb-2 block text-sm font-medium text-gray-900 dark:text-white">
                                    Dirección </label>
                                <input type="text" id="orderDirection" name="orderDirection"
                                    class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-primary-500 focus:ring-primary-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder:text-gray-400 dark:focus:border-primary-500 dark:focus:ring-primary-500"
                                    placeholder="Calle Real Nº 1" value="{{ old('orderDirection') }}" required />
                            </div>

                            {{-- POSTAL CODE --}}
                            <div class="col-span-2 sm:col-span-1">
                                <label for="postal_code"
                                    class="mb-2 block text-sm font-medium text-gray-900 dark:text-white">
                                    Código Postal
                                </label>
                                <input type="text" id="postal_code" name="postal_code"
                                    class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-primary-500 focus:ring-primary-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white"
                                    placeholder="18000" required>
                            </div>

                            {{-- CARD HOLDER NAME --}}
                            <div class="col-span-2 sm:col-span-1">
                                <label for="card-holder-name"
                                    class="mb-2 block text-sm font-medium text-gray-900 dark:text-white">
                                    Titular de la tarjeta
                                </label>
                                <input type="text" id="card-holder-name"
                                    class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-primary-500 focus:ring-primary-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder:text-gray-400 dark:focus:border-primary-500 dark:focus:ring-primary-500"
                                    placeholder="Bonnie Green" autocomplete="cc-name" required />
                            </div>
                            {{-- CARD NUMBER --}}
                            <div class="col-span-2">
                                <label class="mb-2 block text-sm font-medium text-gray-900 dark:text-white">
                                    Número de tarjeta
                                </label>
                                <div id="card-number-element"
                                    class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 dark:border-gray-600 dark:bg-gray-700 dark:text-white">
                                </div>
                            </div>
                            {{-- EXPIRATION --}}
                            <div class="col-span-1">
                                <label class="mb-2 block text-sm font-medium text-gray-900 dark:text-white">
                                    Fecha de expiración
                                </label>
                                <div id="card-expiry-element"
                                    class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 dark:border-gray-600 dark:bg-gray-700 dark:text-white">
                                </div>
                            </div>
                            {{-- CVC --}}
                            <div class="col-span-1">
                                <label class="mb-2 block text-sm font-medium text-gray-900 dark:text-white">
                                    CVC
                                </label>
                                <div id="card-cvc-element"
                                    class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 dark:border-gray-600 dark:bg-gray-700 dark:text-white">
                                </div>
                            </div>
                            <div class="col-span-2">
                                <div id="card-errors" class="mt-2 text-sm text-red-600"></div>
                            </div>

                            {{-- HIDDEN STRIPE TOKEN --}}
                            <input type="hidden" name="stripeToken" id="stripeToken">
                        </div>

                        <button type="submit"
                            class="flex w-full items-center justify-center rounded-lg bg-primary-700 px-5 py-2.5 text-sm font-medium text-white hover:bg-primary-800 focus:outline-none focus:ring-4  focus:ring-primary-300 dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">Realizar
                            pedido</button>
                    </form>

                    {{-- Calcular el precio total --}}
                    @php
                        $total = 0;
                        foreach ($cartItems as $item) {
                            $total += Product::find($item['id'])->price * $item['amount'];
                        }
                    @endphp

                    <div class="mt-6 grow sm:mt-8 lg:mt-0">
                        <div
                            class="space-y-4 rounded-lg border border-gray-100 bg-gray-50 p-6 dark:border-gray-700 dark:bg-gray-800">
                            <div class="space-y-2">
                                <dl class="flex items-center justify-between gap-4">
                                    <dt class="text-base font-normal text-gray-500 dark:text-gray-400">Precio original</dt>
                                    <dd class="text-base font-medium text-gray-900 dark:text-white">{{ $total }} €
                                    </dd>
                                </dl>

                                {{-- <dl class="flex items-center justify-between gap-4">
                                    <dt class="text-base font-normal text-gray-500 dark:text-gray-400">Savings</dt>
                                    <dd class="text-base font-medium text-green-500">-$299.00</dd>
                                </dl> --}}

                                <dl class="flex items-center justify-between gap-4">
                                    <dt class="text-base font-normal text-gray-500 dark:text-gray-400">Gastos de envío</dt>
                                    <dd class="text-base font-medium text-gray-900 dark:text-white">0 €</dd>
                                </dl>

                                {{-- <dl class="flex items-center justify-between gap-4">
                                    <dt class="text-base font-normal text-gray-500 dark:text-gray-400">Tax</dt>
                                    <dd class="text-base font-medium text-gray-900 dark:text-white">$799</dd>
                                </dl> --}}
                            </div>

                            <dl
                                class="flex items-center justify-between gap-4 border-t border-gray-200 pt-2 dark:border-gray-700">
                                <dt class="text-base font-bold text-gray-900 dark:text-white">Total</dt>
                                <dd class="text-base font-bold text-gray-900 dark:text-white">{{ $total }} €</dd>
                            </dl>
                        </div>

                        <div class="mt-6 flex items-center justify-center gap-8">
                            <img class="h-8 w-auto dark:hidden"
                                src="https://flowbite.s3.amazonaws.com/blocks/e-commerce/brand-logos/paypal.svg"
                                alt="" />
                            <img class="hidden h-8 w-auto dark:flex"
                                src="https://flowbite.s3.amazonaws.com/blocks/e-commerce/brand-logos/paypal-dark.svg"
                                alt="" />
                            <img class="h-8 w-auto dark:hidden"
                                src="https://flowbite.s3.amazonaws.com/blocks/e-commerce/brand-logos/visa.svg"
                                alt="" />
                            <img class="hidden h-8 w-auto dark:flex"
                                src="https://flowbite.s3.amazonaws.com/blocks/e-commerce/brand-logos/visa-dark.svg"
                                alt="" />
                            <img class="h-8 w-auto dark:hidden"
                                src="https://flowbite.s3.amazonaws.com/blocks/e-commerce/brand-logos/mastercard.svg"
                                alt="" />
                            <img class="hidden h-8 w-auto dark:flex"
                                src="https://flowbite.s3.amazonaws.com/blocks/e-commerce/brand-logos/mastercard-dark.svg"
                                alt="" />
                        </div>
                    </div>
                </div>

                <p class="mt-6 text-center text-gray-500 dark:text-gray-400 sm:mt-8 lg:text-left">
                    Pago procesado de forma segura mediante <a href="https://stripe.com/" title="Stripe" target="_blank"
                        class="font-medium text-primary-700 underline hover:no-underline dark:text-primary-500">Stripe</a>
                </p>
            </div>
        </div>
    </section>

    {{-- Para usar la variable de la key en el javascript del pago --}}
    <script>
        const stripePublicKey = "{{ config('services.stripe.key') }}";
    </script>
    {{-- Script de pago de Stripe --}}
    <script src="https://js.stripe.com/v3/"></script>
    {{-- <script type="module" src={{ asset('../resources/js/stripePaymentForm.js') }} defer></script> --}}
    @vite('resources/js/stripePaymentForm.js')
@endsection
