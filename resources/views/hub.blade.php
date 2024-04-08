<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <title>RestoPro Hub</title>

        <!-- Ползваме HTMX, за да правим заявки към сървъра по-лесно. -->
        <script src="https://unpkg.com/htmx.org@1.9.11"></script>

        <style type="text/css" media="screen">
         :root {
             --surface: #CFC9CB;
             --surface-darker: #61565A;

             --on-surface: black;
             --on-surface-darker: white;

             --primary: rgb(63, 132, 229);
             --on-primary: white;

             --primary-darker: rgb(27, 98, 197);
             --primary-brighter: rgb(93, 152, 233);

             --secondary: rgb(63, 120, 76);
             --on-secondary: white;

             --success: lightgreen;
             --warning: #D0C94E;
             --error: #C92318;

             --on-success: black;
             --on-warning: black;
             --on-error: white;
         }

         body {
             width: 100%; min-height: 100vh; padding: 0; margin: 0;
             background-color: var(--surface, white);
             display: flex;
             flex-direction: column;
         }

         header {
             padding: 4px 16px;
             display: flex;
             justify-content: space-between;
             align-items: center;

             border-bottom: 1px solid #aaa;

             background-color: var(--surface-darker);
             color: var(--on-surface-darker, white);
         }

         header form {
             padding: 0; margin: 0;
         }

         .gigantic-buttons {
             display: flex;
             flex-direction: row;
             gap: 0px;
             width: 100%;
             flex-grow: 1;
         }
         .gigantic-buttons .group { display: flex; width: 100%; flex-direction: column; }

         .gigantic-buttons > button:not(:last-child) {
             border-right: 1px solid var(--on-surface);
         }
         .gigantic-buttons .group > button:not(:last-child) {
             border-bottom: 1px solid var(--on-surface);
         }

         .gigantic-buttons button { border: none; }
         .gigantic-buttons a { text-decoration: none; color: inherit; }

         .gigantic-buttons button,
         .gigantic-buttons a {
             flex-grow: 1;
             font-size: 2.2rem;
             width: 100%;
             transition: 0.2s all;
         }

         .gigantic-buttons button:hover {
             cursor: pointer;
             font-size: 2.6rem;
             transition: 0.2s all;
         }
        </style>
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
            <button> 🪑 Маси и настаняване </button>
            <button> 🍽️ Меню и поръчки </button>
            <div class="group">
                <button> 📈 Аналитики и данни </button>
                <button> ⚙️ Настройки заведение </button>
            </div>
        </main>
    </body>
</html>
