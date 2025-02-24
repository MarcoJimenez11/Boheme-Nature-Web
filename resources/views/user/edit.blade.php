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

    <h2>Cambiar nombre de usuario</h2>
    <form method="POST" action="{{ route('userEditNamePut', $user) }}">
        <!-- csrf es un token para validar el POST, evitando POST maliciosos de terceros -->
        @csrf
        <!-- method('PUT) especifica que el formulario enviará una petición PUT en vez de POST -->
        @method('PUT')

        <label for="userName">Nombre</label>
        <input type="text" name="userName" value="{{ $user->name }}">

        <button type="submit">Confirmar</button>
    </form>

    <h2>Cambiar e-mail de usuario</h2>
    <form method="POST" action="{{ route('userEditEmailPut', $user) }}">
        <!-- csrf es un token para validar el POST, evitando POST maliciosos de terceros -->
        @csrf
        <!-- method('PUT) especifica que el formulario enviará una petición PUT en vez de POST -->
        @method('PUT')

        <label for="userEmail">Email</label>
        <input type="email" name="userEmail" value="{{ $user->email }}">

        <button type="submit">Confirmar</button>
    </form>

    <h2>Cambiar contraseña</h2>
    <form method="POST" action="{{ route('userEditPasswordPut', $user) }}">
        <!-- csrf es un token para validar el POST, evitando POST maliciosos de terceros -->
        @csrf
        <!-- method('PUT) especifica que el formulario enviará una petición PUT en vez de POST -->
        @method('PUT')

        <label for="userOldPassword">Antigua contraseña</label>
        <input type="password" name="userOldPassword">

        <label for="userNewPassword">Nueva contraseña</label>
        <input type="password" name="userNewPassword">

        <label for="userNewPasswordRepeat">Repetir nueva contraseña</label>
        <input type="password" name="userNewPasswordRepeat">

        <button type="submit">Confirmar</button>
    </form>

    @auth
        @if (Auth::user()->is_admin)
            <h2>Cambiar rol de usuario</h2>
            <form method="POST" action="{{ route('userEditIsAdminPut', $user) }}">
                <!-- csrf es un token para validar el POST, evitando POST maliciosos de terceros -->
                @csrf
                <!-- method('DELETE) especifica que el formulario enviará una petición DELETE en vez de POST -->
                @method('PUT')

                <label for="userIsAdmin">Administrador</label>
                <input type="checkbox" name="userIsAdmin" checked="@if($user->is_admin)checked @endif">
                <button type="submit">Confirmar</button>
            </form>
        @endif
    @endauth
@endsection
