<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bohême Nature</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>
    <header>

    </header>

    <main>

        <section id="email-verification">
            <p>Se ha enviado un correo de confirmación a tu email. Pincha en el botón para verificar tu usuario</p>

            <form method="POST" action="{{ route('verification.send') }}">
                <!-- csrf es un token para validar el POST, evitando POST maliciosos de terceros -->
                @csrf
                <button type="submit">Enviar correo de nuevo</button>
            </form>
        </section>
        
    </main>

    <footer>

    </footer>
</body>

</html>
