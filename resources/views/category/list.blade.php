@extends('layoutAdmin')

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

    <button><a href="{{ route('categoryCreate') }}">Crear Categoría</a></button>

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
                        <button><a href="{{ route('categoryEdit', $category) }}">Editar</a></button>
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
