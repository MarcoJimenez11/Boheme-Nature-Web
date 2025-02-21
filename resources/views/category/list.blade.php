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

    <h2>Lista de categorías</h2>

    <a href="{{ route('categoryCreate') }}">Crear Categoría</a>

    <table>
        <thead>
            <th>Categoría</th>
            <th>Acciones</th>
        </thead>
        <tbody>
            @foreach ($categories as $category)
                <tr>
                    <td>{{ $category->name }} </td>
                    <td>
                        <a href="{{ route('categoryEdit', $category) }}">Editar</a>
                        <form method="POST" action="{{ route('categoryDelete', $category) }}">
                            @csrf
                            @method('DELETE')
                            <button type="submit">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @endforeach

        </tbody>

    </table>

@endsection
