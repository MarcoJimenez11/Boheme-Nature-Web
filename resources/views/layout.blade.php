<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bohême Nature</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script type="module" src={{ asset('../resources/js/categoriesMenu.js') }} defer></script>
    <script src="//unpkg.com/alpinejs" defer></script> {{-- Script para abrir y cerrar líneas de pedido en Ver Pedidos --}}
</head>

<body>

    <header>

        @include('header')

        @include('adminHeader')

    </header>

    <main>

        <section id="content">
            @yield('content')
        </section>

    </main>

    <footer class="bg-white rounded-lg shadow-sm dark:bg-gray-900 m-4">

        @include('footer')

    </footer>



</body>

</html>
