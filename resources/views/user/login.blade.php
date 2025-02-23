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

    <h2>Inicio de sesión</h2>
    <form method="POST" action="{{ route('loginPost') }}">
        <!-- csrf es un token para validar el POST, evitando POST maliciosos de terceros -->
        @csrf

        <label for="userEmail">Correo electrónico</label>
        <input type="email" name="userEmail">

        <label for="userPassword">Contraseña</label>
        <input type="password" name="userPassword">

        <label for="rememberSession">Mantener sesión iniciada</label>
        <input type="checkbox" name="rememberSession" value="false">

        <button type="submit">Iniciar Sesión</button>
    </form>
@endsection
