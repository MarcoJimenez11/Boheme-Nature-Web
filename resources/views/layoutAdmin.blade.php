<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Marcodona</title>
    {{-- <link href="{{ asset('../resources/scss/principal.css') }}" rel="stylesheet"> --}}
    @vite(['resources/css/app.css', 'resources/scss/principal.scss', 'resources/js/app.js'])
    <script type="module" src={{ asset('../resources/js/categoriesMenu.js') }} defer></script>
</head>

<body>
    <header>
        <section>
            <h1><a href="{{ route('home') }}">Marcodona</a></h1>
            <nav>
                <a id="toggleCategories">Categorías</a>

                <a href="{{ route('cartList') }}">Ver carrito
                    @if (session()->has('cart'))
                        ( {{ count(session('cart')) }} )
                    @else
                        (0)
                    @endif

                </a>

                <!-- Esta etiqueta Blade equivale a un condicional en caso de estar autenticado el usuario (Auth) -->
                @auth
                    <a href="{{ route('userEdit', Auth::user()) }}">Bienvenid@ {{ Auth::user()->name }} </a>
                    <a href="{{ route('orderList') }}">Mis Pedidos</a>
                    <a href="{{ route('logout') }}">Cerrar Sesión</a>
                @endauth

                @guest
                    <a href="{{ route('login') }}">Iniciar Sesión</a>
                    <a href="{{ route('register') }}">Registro</a>
                @endguest

            </nav>
        </section>
        @auth
            @if (Auth::user()->is_admin)
                <section>
                    <h2>Menú de Administrador</h2>
                    <nav>
                        <a href="{{ route('userList') }}">Gestionar Usuarios</a>
                        <a href="{{ route('categoryList') }}">Gestionar Categorías</a>
                        <a href="{{ route('productList') }}">Gestionar Productos</a>
                    </nav>
                </section>
            @endif
        @endauth

    </header>

    <main>
        <section id="categories" class="hide">
            <h2>Categorías</h2>
            @forelse($categories as $category)
                <a href="{{ route('productListByCategory', $category) }}">{{ $category->name }}</a>
            @empty
                <p>No hay categorías.</p>
            @endforelse
        </section>

        <section id="content">
            @auth
                @if (Auth::user()->is_admin)
                    @yield('content')
                @else
                    <h2>Se necesitan permisos de Administrador para acceder</h2>
                @endif
            @endauth

            @guest
                <h2>Se necesitan permisos de Administrador para acceder</h2>
            @endguest
        </section>

        <section></section>
    </main>

    <footer>
        <a href="https://www.linkedin.com/in/marco-jiménez-ureña-7424b0183" target="_blank">Made by Marco Jiménez
            Ureña</a>
        <a href="">Av. de Francisco Ayala, s/n, Chana, 18014 Granada</a>
        <a href="https://www.instagram.com/" target="_blank">Instagram</a>
        <a href="https://www.facebook.com/" target="_blank">Facebook</a>
        <a href="https://www.linkedin.com/in/marco-jiménez-ureña-7424b0183" target="_blank">LinkedIn</i></a>
    </footer>
</body>

</html>
