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

    <h2>Registrar usuario</h2>
    <form method="POST" action="{{ route('registerPost') }}">
        <!-- csrf es un token para validar el POST, evitando POST maliciosos de terceros -->
        @csrf

        <label for="userName">Nombre de usuario</label>
        <input type="text" name="userName">

        <label for="userEmail">Correo electrónico</label>
        <input type="email" name="userEmail">

        <label for="userPassword">Contraseña</label>
        <input type="password" name="userPassword">

        <label for="userRepeatPassword">Repetir contraseña</label>
        <input type="password" name="userRepeatPassword">

        <button type="submit">Registrar</button>
    </form>
@endsection
