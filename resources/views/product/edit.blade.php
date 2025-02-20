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

    <h2>Editar Producto</h2>
    <form method="POST" action="{{ route('productEditPut',$product) }}">
        <!-- csrf es un token para validar el POST, evitando POST maliciosos de terceros -->
        @csrf
        <!-- method('PUT) especifica que el formulario enviará una petición PUT en vez de POST -->
        @method('PUT')

        <label for="productName">Categoría</label>
        <select name="productCategory">
            @foreach ($categories as $category)
                @if ($category->id == $product->category_id)
                    <option value="{{ $category->id }}" selected="selected">{{ $category->name }} </option>
                @else
                    <option value="{{ $category->id }}">{{ $category->name }} </option>
                @endif
            @endforeach

        </select>

        <label for="productName">Nombre</label>
        <input type="text" name="productName" value="{{ $product->name }}">

        <label for="productDescription">Descripción</label>
        <input type="text" name="productDescription" value="{{ $product->description }}">

        <label for="productPrice">Precio</label>
        <input type="number" name="productPrice" min="0" step=".01" value="{{ $product->price }}">

        <label for="productStock">Stock</label>
        <input type="number" name="productStock" min="0" value="{{ $product->stock }}">

        <label for="productImage">Imagen</label>
        <input type="text" name="productImage" value="{{ $product->image }}">

        <button type="submit">Editar</button>
    </form>
@endsection
