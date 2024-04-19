<head>
    <title>RestoPro - {{ $subtitle }}</title>

    <!-- Ползваме HTMX, за да правим заявки към сървъра по-лесно. -->
    <script src="https://unpkg.com/htmx.org@1.9.11"></script>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
