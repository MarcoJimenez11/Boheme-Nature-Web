<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bohême Nature</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script type="module" src={{ asset('../resources/js/categoriesMenu.js') }} defer></script>
</head>

<body>

    <header>

        @include('header')

        @include('adminHeader')

    </header>

    <main>

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

    </main>

    <footer class="bg-white rounded-lg shadow-sm dark:bg-gray-900 m-4">

        @include('footer')

    </footer>



</body>

</html>
