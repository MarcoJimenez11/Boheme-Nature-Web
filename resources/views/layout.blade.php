<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Marcodona</title>
    {{-- <link href="{{ asset('../resources/scss/principal.css') }}" rel="stylesheet"> --}}
    {{-- <link href="{{ asset('../resources/css/app.css') }}" rel="stylesheet"> --}}
    @vite(['resources/css/app.css', 'resources/scss/principal.scss', 'resources/js/app.js'])
    <script type="module" src={{ asset('../resources/js/categoriesMenu.js') }} defer></script>
</head>

<body>

    @include('header')
    
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
                    @if (Auth::user()->hasverifiedemail())
                        <a href="{{ route('userEdit', Auth::user()) }}">Bienvenid@ {{ Auth::user()->name }} </a>
                        <a href="{{ route('orderList') }}">Mis Pedidos</a>
                        <a href="{{ route('logout') }}">Cerrar Sesión</a>
                    @else
                        <a href="{{ route('verification.notice') }}">Pendiente de verificación de correo</a>
                    @endif

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
            @yield('content')
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

    

<footer class="bg-white rounded-lg shadow-sm dark:bg-gray-900 m-4">
    <div class="w-full max-w-screen-xl mx-auto p-4 md:py-8">
        <div class="sm:flex sm:items-center sm:justify-between">
            <a href="https://flowbite.com/" class="flex items-center mb-4 sm:mb-0 space-x-3 rtl:space-x-reverse">
                <img src="https://flowbite.com/docs/images/logo.svg" class="h-8" alt="Flowbite Logo" />
                <span class="self-center text-2xl font-semibold whitespace-nowrap dark:text-white">Flowbite</span>
            </a>
            <ul class="flex flex-wrap items-center mb-6 text-sm font-medium text-gray-500 sm:mb-0 dark:text-gray-400">
                <li>
                    <a href="#" class="hover:underline me-4 md:me-6">About</a>
                </li>
                <li>
                    <a href="#" class="hover:underline me-4 md:me-6">Privacy Policy</a>
                </li>
                <li>
                    <a href="#" class="hover:underline me-4 md:me-6">Licensing</a>
                </li>
                <li>
                    <a href="#" class="hover:underline">Contact</a>
                </li>
            </ul>
        </div>
        <hr class="my-6 border-gray-200 sm:mx-auto dark:border-gray-700 lg:my-8" />
        <span class="block text-sm text-gray-500 sm:text-center dark:text-gray-400">© 2023 <a href="https://flowbite.com/" class="hover:underline">Flowbite™</a>. All Rights Reserved.</span>
    </div>
</footer>


    
</body>

</html>
