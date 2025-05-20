{{-- filepath: resources/views/order/list.blade.php --}}
@extends('layout')

@section('content')
    <section class="bg-white py-8 antialiased dark:bg-gray-900 md:py-16">
        <div class="mx-auto max-w-screen-xl px-4 2xl:px-0">
            <div class="mx-auto max-w-5xl">
                <div class="gap-4 sm:flex sm:items-center sm:justify-between">
                    @include('errorAlert')

                    <h2 class="text-xl font-semibold text-primary-800 dark:text-white sm:text-2xl">Mis pedidos</h2>

                </div>
                @foreach ($orders as $order)
                    <div x-data="{ open: false }" class="mt-6 flow-root sm:mt-8 shadow-md rounded-lg pl-6 pr-6 pt-2 pb-2">
                        <div class="divide-y divide-gray-200 dark:divide-gray-700">
                            <div class="flex flex-wrap items-center gap-y-4 py-6">
                                <dl class="mr-2 w-1/2 sm:w-1/4 lg:w-auto lg:flex-1">
                                    <dt class="text-base font-medium text-gray-500 dark:text-gray-400">Dirección:</dt>
                                    <dd class="mt-1.5 text-base font-semibold text-gray-800 dark:text-white">
                                        {{ $order->locality }},{{ $order->province }} - {{ $order->direction }}
                                    </dd>
                                </dl>

                                <dl class="w-1/2 sm:w-1/4 lg:w-auto lg:flex-1">
                                    <dt class="text-base font-medium text-gray-500 dark:text-gray-400">Fecha:</dt>
                                    <dd class="mt-1.5 text-base font-semibold text-gray-900 dark:text-white">
                                        {{ $order->created_at }}</dd>
                                </dl>

                                <dl class="w-1/2 sm:w-1/4 lg:w-auto lg:flex-1">
                                    <dt class="text-base font-medium text-gray-500 dark:text-gray-400">Importe total:</dt>
                                    <dd class="mt-1.5 text-base font-semibold text-gray-900 dark:text-white">
                                        {{ $order->getTotalCost() }} €</dd>
                                </dl>

                                {{-- Estilos para el Estado del Pedido --}}
                                @php
                                    $statusStyles = [
                                        'Pendiente' => [
                                            'color' =>
                                                'bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-300',
                                            'icon' =>
                                                '<svg class="me-1 h-3 w-3" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><circle cx="12" cy="12" r="10" /><path d="M12 6v6l4 2" /></svg>',
                                        ],
                                        'En curso' => [
                                            'color' => 'bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-300',
                                            'icon' =>
                                                '<svg class="me-1 h-3 w-3" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M3 12h18M3 12l4-4m-4 4l4 4" /></svg>',
                                        ],
                                        'Recibido' => [
                                            'color' =>
                                                'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-300',
                                            'icon' =>
                                                '<svg class="me-1 h-3 w-3" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M5 13l4 4L19 7" /></svg>',
                                        ],
                                        'Cancelado' => [
                                            'color' => 'bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-300',
                                            'icon' =>
                                                '<svg class="me-1 h-3 w-3" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M6 18L18 6M6 6l12 12" /></svg>',
                                        ],
                                    ];
                                    $status = $order->status ?? 'pre-order';
                                    $style = $statusStyles[$status] ?? $statusStyles['pre-order'];
                                @endphp
                                <dl class="w-1/2 sm:w-1/4 lg:w-auto lg:flex-1">
                                    <dt class="text-base font-medium text-gray-500 dark:text-gray-400">Estado:</dt>
                                    <dd
                                        class="me-2 mt-1.5 inline-flex items-center rounded px-2.5 py-0.5 text-xs font-medium {!! $style['color'] !!}">
                                        {!! $style['icon'] !!}
                                        {{ $order->status }}
                                    </dd>
                                </dl>

                                <div
                                    class="w-full grid sm:grid-cols-2 lg:flex lg:w-64 lg:items-center lg:justify-end gap-4">
                                    <button @click="open = !open" type="button"
                                        class="w-full inline-flex justify-center rounded-lg border border-gray-200 bg-white px-3 py-2 text-sm font-medium text-gray-900 hover:bg-gray-100 hover:text-primary-700 focus:z-10 focus:outline-none focus:ring-4 focus:ring-gray-100 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white dark:focus:ring-gray-700 lg:w-auto">
                                        Ver detalles
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div x-show="open" x-transition>
                            <h3 class="text-base font-semibold text-primary-700 dark:text-primary-300 mb-2">Líneas del pedido</h3>
                            <ul>
                                @foreach ($order->orderLines as $line)
                                    <li
                                        class="flex justify-start items-center border-b border-gray-200 dark:border-gray-700 py-2">
                                        <span
                                            class="font-medium mr-2 text-gray-700 dark:text-gray-200">{{ $line->product->name }}</span>
                                        <span class="mr-2 text-gray-500 dark:text-gray-400">x{{ $line->amount }}</span>
                                        <span class="text-gray-900 dark:text-white">{{ $line->product->price }} €</span>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <section class="mt-4 flex justify-center">
            {{ $orders->links('pagination') }}
        </section>
    </section>
@endsection
