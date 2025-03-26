<?php
use App\Models\Category;
?>

@extends('layoutAdmin')

@section('content')
    <section class="ml-10 mr-10">
        @include('errorAlert')

        <h2 class="self-center text-2xl font-semibold whitespace-nowrap dark:text-white">Lista de productos</h2>

        <button
            class="mb-4 mt-4 text-white bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 md:px-5 md:py-2.5 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800"><a
                href="{{ route('productCreate') }}">Crear Producto</a></button>

        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
            <x-table.table>
                <x-slot name="thead">
                    <th scope="col" class="px-6 py-3">Categoría</th>
                    <th scope="col" class="px-6 py-3">Producto</th>
                    <th scope="col" class="px-6 py-3">Descripción</th>
                    <th scope="col" class="px-6 py-3">Precio</th>
                    <th scope="col" class="px-6 py-3">Stock</th>
                    <th scope="col" class="px-6 py-3">Imagen</th>
                    <th scope="col" class="px-6 py-3">Acciones</th>
                </x-slot>
                <x-slot name="tbody">
                    @foreach ($products as $product)
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 border-gray-200">
                            <td class="px-6 py-4">{{ Category::find($product->category_id)->name }}</td>
                            <td class="px-6 py-4">{{ $product->name }}</td>
                            <td class="px-6 py-4">{{ $product->description }}</td>
                            <td class="px-6 py-4">{{ $product->price }} €</td>
                            <td class="px-6 py-4">{{ $product->stock }}</td>
                            <td class="px-6 py-4">{{ $product->image }}</td>

                            <td class="px-6 py-4">
                                <button><a href="{{ route('productEdit', $product) }}">Editar</a></button>
                                <form method="POST" action="{{ route('productDelete', $product) }}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit">Eliminar</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </x-slot>
            </x-table.table>
        </div>
        <section class="mt-4 flex justify-center">
            {{ $products->links('pagination') }}
        </section>
    </section>
@endsection
