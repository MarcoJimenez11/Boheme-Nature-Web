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
    </nav>
  </header>

  <main>

    @forelse($users as $user)
      <li>{{ $user->name }}</li>
    @empty
      <li>No hay usuarios registrados.</li>
    @endforelse

  </main>

  <footer>

  </footer>
</body>

</html>