<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <title>RestoPro Hub</title>

        <!-- Ползваме Bootstrap, за да изглежда по-красиво приложението ни. -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

        <!-- Ползваме HTMX, за да правим заявки към сървъра по-лесно. -->
        <script src="https://unpkg.com/htmx.org@1.9.11"></script>
    </head>

    <body hx-headers='{"X-CSRF-TOKEN": "{{csrf_token()}}"}'>
        <nav class="navbar navbar-expand-lg bg-body-secondary">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">RestoPro</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#hub-navbar-buttons" aria-controls="hub-navbar-buttons" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="navbar-collapse collapse d-flex justify-content-between" id="hub-navbar-buttons">
                    <ul class="navbar-nav justify-content-end">
                        <li class="nav-item"><a class="nav-link active" href="/hub">Hub</a></li>
                        <li class="nav-item"><a class="nav-link" href="/profile">Profile</a></li>
                    </ul>
                    <form method="POST" action="/logout" style="margin-bottom: 0">
                        @csrf
                        <button class="btn btn-outline-danger" type="submit">Logout</button>
                    </form>
                </div>
            </div>
        </nav>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    </body>
</html>
