<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    @include('components.head', ["subtitle" => 'Аналитики'])

    <body hx-headers='{"X-CSRF-TOKEN": "{{csrf_token()}}"}'>
        @include('components.header', ["subtitle" => "Аналитики"])

        <center>
            <p>Coming soon...</p>
        </center>
    </body>
</html>
