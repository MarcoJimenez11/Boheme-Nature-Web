@extends('layoutAdmin')

@section('content')
    <section class="ml-10 mr-10">

        @include('errorAlert')


        <div class="relative overflow-x-auto shadow-md sm:rounded-lg w-full max-w-4xl mx-auto">
            <h2 class="self-center text-2xl font-semibold whitespace-nowrap dark:text-white">Lista de categorías</h2>

            <button
                class="mb-4 mt-4 text-white bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 md:px-5 md:py-2.5 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800"><a
                    href="{{ route('categoryCreate') }}">Crear Categoría</a></button>
            <x-table.table>
                <x-slot name="thead">
                    <th scope="col" class="px-6 py-3">Categoría</th>
                    <th scope="col" class="px-6 py-3">Acciones</th>
                </x-slot>
                <x-slot name="tbody">
                    @foreach ($categories as $category)
                        <tr>
                            <td class="px-6 py-4">{{ $category->name }} </td>
                            <td class="px-6 py-4">
                                <button><a href="{{ route('categoryEdit', $category) }}"
                                        class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Editar</a></button>
                                <form method="POST" action="{{ route('categoryDelete', $category) }}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="font-medium text-red-600 dark:text-red-500 hover:underline">Eliminar</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </x-slot>
            </x-table.table>
        </div>


        <section class="mt-4 flex justify-center">
            {{ $categories->links('pagination') }}
        </section>

    </section>
@endsection
