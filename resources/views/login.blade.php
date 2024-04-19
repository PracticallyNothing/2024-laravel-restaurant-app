<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <title>Login</title>
        <style type="text/css" media="screen">

         body.centered {
             margin: 0;
             padding: 0;

             width: 100%;
             height: 100vh;

             display: flex;
             flex-direction: column;
             align-items: center;
             justify-content: center;
             gap: 16px;
         }

         .login-form {
             border: 1px solid black;
             border-radius: 15px;
             padding: 25px;
         }

         form#login-form {
             margin: 0;
             display: flex;
             flex-direction: column;
             gap: 20px;
             font-size: 1.25rem;
         }

         form#login-form input { padding: 10px; font-size: 1.25rem; border-radius: 15px; }
         .login-form h1 { margin: 0; text-align: center; }
         form#login-form button {
             font-size: 2rem;
             padding: 2px 15px;
         }

         label  { margin-bottom: -15px; }

         button:hover { cursor: pointer; }

         .align-right { display: flex; flex-direction: column; align-items: flex-end;}
        </style>
    </head>

    <body class="centered">
        <div class="branding">
        </div>

        <div class="login-form">
            <h1>Вход в приложението</h1>

            <form method="POST" id="login-form" action="/login">
                @csrf
                <label for="name">Username</label>
                <input type="string"
                       id="name"
                       name="name"
                       autocomplete="username"
                       required>

                <label for="password">Password</label>
                <input type="password"
                       id="password"
                       name="password"
                       autocomplete="current-password"
                       required>

                <div class="align-right">
                    <button type="submit">Вход</button>
                </div>
            </form>
        </div>
    </body>
</html>
