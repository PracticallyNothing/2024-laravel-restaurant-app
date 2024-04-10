<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <title>RestoPro Hub</title>

        <!-- Ползваме HTMX, за да правим заявки към сървъра по-лесно. -->
        <script src="https://unpkg.com/htmx.org@1.9.11"></script>

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>

    <body hx-headers='{"X-CSRF-TOKEN": "{{csrf_token()}}"}'>
        <header>
            <h1>🍽️ RestoPro Hub</h1>

            <form method="POST" action="/logout">
                @csrf
                <button class="btn btn-outline-danger" type="submit">Logout</button>
            </form>
        </header>

        <main class="gigantic-buttons">
            <a href="/tables-and-seating"> 🪑 Маси и настаняване </a>
            <button> 🍽️ Меню и поръчки </button>
            <div class="group">
                <button> 📈 Аналитики и данни </button>
                <button> ⚙️ Настройки заведение </button>
            </div>
        </main>
    </body>
</html>
