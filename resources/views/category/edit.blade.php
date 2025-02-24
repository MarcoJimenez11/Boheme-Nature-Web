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

    <h2>Editar Categoría</h2>
    <form method="POST" action="{{ route('categoryEditPut', $category) }}">
        <!-- csrf es un token para validar el POST, evitando POST maliciosos de terceros -->
        @csrf
        <!-- method('PUT) especifica que el formulario enviará una petición PUT en vez de POST -->
        @method('PUT')



        <label for="categoryName">Nombre</label>
        <input type="text" name="categoryName" value="{{ $category->name }}">

        <button type="submit">Editar</button>
    </form>
@endsection
