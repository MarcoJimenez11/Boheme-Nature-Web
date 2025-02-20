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

    <h2>Crear nuevo Producto</h2>
    <form method="POST" action="{{ route('productCreatePost') }}">
        <!-- csrf es un token para validar el POST, evitando POST maliciosos de terceros -->
        @csrf

        <label for="productName">Categoría</label>
        <select name="productCategory">
            @foreach ($categories as $category)
                <option value="{{ $category->id }}">{{ $category->name }} </option>
            @endforeach

        </select>

        <label for="productName">Nombre</label>
        <input type="text" name="productName" value="{{ old('productName') }}">

        <label for="productDescription">Descripción</label>
        <input type="text" name="productDescription" value="{{ old('productDescription') }}">

        <label for="productPrice">Precio</label>
        <input type="number" name="productPrice" min="0" step=".01" value="{{ old('productPrice') }}">

        <label for="productStock">Stock</label>
        <input type="number" name="productStock" min="0" value="{{ old('productStock') }}">

        <label for="productImage">Imagen</label>
        <input type="text" name="productImage" value="{{ old('productImage') }}">

        <button type="submit">Crear</button>
    </form>
@endsection
