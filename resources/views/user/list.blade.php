@extends('layoutAdmin')

@section('content')
    <section class="ml-10 mr-10">
        @include('errorAlert')

        <h2 class="self-center text-2xl font-semibold whitespace-nowrap dark:text-white">Lista de usuarios</h2>

        <button
            class="mb-4 mt-4 text-white bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 md:px-5 md:py-2.5 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800"><a
                href="{{ route('register') }}">Crear usuario</a></button>


        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
            <x-table.table>
                <x-slot name="thead">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            Nombre
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Email
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Fecha de registro
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Acciones
                        </th>
                    </tr>
                </x-slot>
                <x-slot name="tbody">
                    @foreach ($users as $user)
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 border-gray-200">
                            <td class="px-6 py-4">{{ $user->name }}</td>
                            <td class="px-6 py-4">{{ $user->email }}</td>
                            <td class="px-6 py-4">{{ $user->created_at }}</td>

                            <td class="px-6 py-4">
                                <button><a href="{{ route('userEdit', $user) }}"
                                        class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Editar</a></button>
                                <form method="POST" action="{{ route('userDelete', $user) }}">
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

        {{-- Esta sección añade la paginación. --}}
        <section class="mt-4 flex justify-center">
            {{ $users->links('pagination') }}
        </section>
    </section>
@endsection
