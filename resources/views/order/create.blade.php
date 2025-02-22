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

    <h2>Datos del pedido</h2>
    <form method="POST" action="{{ route('orderCreatePost') }}">
        <!-- csrf es un token para validar el POST, evitando POST maliciosos de terceros -->
        @csrf

        <label for="orderProvince">Provincia</label>
        <input type="text" name="orderProvince" value="{{ old('orderProvince') }}">
        
        <label for="orderLocality">Localidad</label>
        <input type="text" name="orderLocality" value="{{ old('orderLocality') }}">
        
        <label for="orderDirection">Dirección</label>
        <input type="text" name="orderDirection" value="{{ old('orderDirection') }}">

        <button type="submit">Realizar pedido</button>
    </form>
@endsection
