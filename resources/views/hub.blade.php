<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <title>RestoPro Hub</title>

        <!-- Ползваме HTMX, за да правим заявки към сървъра по-лесно. -->
        <script src="https://unpkg.com/htmx.org@1.9.11"></script>

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>

    <body hx-headers='{"X-CSRF-TOKEN": "{{csrf_token()}}"}'>
        @include('components.header', ["subtitle" => "Хъб"])

        <main class="gigantic-buttons">
            <a href="/tables-and-seating"> 🪑 Маси и настаняване </a>
            <a href="/orders"> 🍽️ Меню и поръчки </a>
            <div class="group">
                <a href="/analytics"> 📈 Аналитики и данни </a>
                <a href="/settings"> ⚙️ Настройки заведение </a>
            </div>
        </main>
    </body>
</html>
