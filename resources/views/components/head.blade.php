<head>
    <title>RestoPro - {{ $subtitle }}</title>

    <!-- Ползваме HTMX, за да правим заявки към сървъра по-лесно. -->
    <script src="https://unpkg.com/htmx.org@1.9.11"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script id="script-target"></script>

    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
