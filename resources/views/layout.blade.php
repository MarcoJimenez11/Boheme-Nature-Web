<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Marcodona</title>
  <link href="{{ asset('../resources/sass/principal.css') }}" rel="stylesheet">
</head>

<body>
  <header>
    <h1><a href="{{ route('home') }}">Marcodona</a></h1>
    <nav>
      <a href="">Tienda</a>
      <a href="{{ route('orderList') }}">Pedidos</a>
      @forelse($categories as $category)
      <a href="">{{ $category->name }}</a>
      @empty
      <p>No hay categorías.</p>
      @endforelse

      <!-- Esta etiqueta Blade equivale a un condicional en caso de estar autenticado el usuario (Auth) -->
      @auth
        <p>Bienvenid@ {{ Auth::user()->name }}</p>
        <a href="{{ route('logout') }}">Cerrar Sesión</a>
      @endauth

      @guest
        <a href="{{ route('login') }}">Iniciar Sesión</a>
        <a href="{{ route('register') }}">Registro</a>
      @endguest

    </nav>
    @auth
      @if (Auth::user()->is_admin)
      <h2>Menú de Administrador</h2>
      <nav>
        <a href="{{ route('register') }}">Registro</a>
        <a href="{{ route('categoryList') }}">Gestionar Categorías</a>
        <a href="{{ route('productList') }}">Gestionar Productos</a>
      </nav>
          
      @endif
    @endauth

  </header>

  <main>

    @yield('content')

  </main>

  <footer>

  </footer>
</body>

</html>