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

    <h2>Lista de usuarios</h2>

    <button><a href="{{ route('register') }}">Crear usuario</a></button>


    <table>
        <thead>
            <th>Nombre</th>
            <th>Email</th>
            <th>Fecha de registro</th>
            <th>Acciones</th>
        </thead>
        <tbody>
            @foreach ($users as $user)
                <tr>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->created_at }}</td>

                    <td>
                        <button><a href="{{ route('userEdit', $user) }}">Editar</a></button>
                        <form method="POST" action="{{ route('userDelete', $user) }}">
                            @csrf
                            @method('DELETE')
                            <button type="submit">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{-- Esta sección añade la paginación. El parámetro de links, por alguna razón, me permite dar estilos propios(sin él no funcionan) --}}
    <section class="pagination">
        {{ $users->links('pagination::bootstrap-4') }}
    </section>

@endsection
