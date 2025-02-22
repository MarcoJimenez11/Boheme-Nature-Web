@extends('layout')

@section('content')

    @if ($errors->any())
        <section class="errorList">
            <h4>Corrige los siguientes errores:</h4>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </section>
    @endif

    <h2>Editar Usuario</h2>
    <form method="POST" action="{{ route('userEditPut', $user) }}">
        <!-- csrf es un token para validar el POST, evitando POST maliciosos de terceros -->
        @csrf
        <!-- method('PUT) especifica que el formulario enviará una petición PUT en vez de POST -->
        @method('PUT')

        <label for="userName">Nombre</label>
        <input type="text" name="userName" value="{{ $user->name }}">

        @auth
            @if (Auth::user()->is_admin)
                <section>
                    <label for="userEmail">Email</label>
                    <input type="email" name="userEmail" value="{{ $user->email }}">
                </section>
            @endif
        @endauth

        <button type="submit">Editar</button>
    </form>
@endsection
