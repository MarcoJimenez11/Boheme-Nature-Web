@extends('layoutAdmin')

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

    <h2>Crear nueva Categoría</h2>
    <form method="POST" action="{{ route('categoryCreatePost') }}">
        <!-- csrf es un token para validar el POST, evitando POST maliciosos de terceros -->
        @csrf

        <label for="categoryName">Nombre</label>
        <input type="text" name="categoryName" value="{{ old('categoryName') }}">

        <button type="submit">Crear</button>
    </form>
@endsection
