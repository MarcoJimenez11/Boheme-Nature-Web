<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Marcodona</title>
  <link href="../resources/sass/principal.css" rel="stylesheet">
</head>

<body>
  <header>
    <h1>Marcodona</h1>
    <nav>
      <a href="{{ route('shop') }}">Tienda</a>
      <a href="">Pedidos</a>
      @forelse($categories as $category)
      <a href="{{ route('shop') }}">{{ $category->name }}</a>
      @empty
      <p>No hay usuarios registrados.</p>
      @endforelse

      <!-- Esta etiqueta Blade equivale a un condicional en caso de estar autenticado el usuario (Auth) -->
      @auth
      <p>Bienvenid@ {{ Auth::user()->name }}</p>
      <a href="{{ route('logout') }}">Cerrar Sesión</a>
      @if (Auth::user()->is_admin)
      Soy admin
      @else
      No soy nada
      @endif
      @endauth

      @guest
      <a href="{{ route('login') }}">Iniciar Sesión</a>
      <a href="{{ route('register') }}">Registro</a>
      @endguest




    </nav>
  </header>

  <main>

    @yield('content')



  </main>

  <footer>

  </footer>
</body>

</html>