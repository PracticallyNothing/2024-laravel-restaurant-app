<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    @include('components.head', ["subtitle" => 'Настройки заведение'])

    <body hx-headers='{"X-CSRF-TOKEN": "{{csrf_token()}}"}'>
        @include("components.header", ["subtitle" => 'Настройки заведение'])

        <form>
            <fieldset>
                <input type="number">
                <input type="number">
                <input type="number">
                <input type="number">
            </fieldset>
        </form>
   </body>
</html>
