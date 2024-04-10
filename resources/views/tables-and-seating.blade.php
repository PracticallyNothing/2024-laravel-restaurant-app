<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <title>RestoPro - Tables and Seating</title>
        <meta name="csrf_token" content="{{ csrf_token() }}">

        <!-- Ползваме HTMX, за да правим заявки към сървъра по-лесно. -->
        <script src="https://unpkg.com/htmx.org@1.9.11"></script>

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>

    <body>
        <header>
            <div class="flex-row">
                <div class="title-and-subtitle">
                    <h1>🍽️ RestoPro</h1>
                    <h4>Маси и настаняване</h4>
                </div>
                <nav>
                    <ul>
                        <li><a href="/hub">Hub</a></li>
                        <li><a href="/orders">Поръчки</a></li>
                        <li><a href="/analytics">Статистики</a></li>
                        <li><a href="/settings">Настройки</a></li>
                    </ul>
                </nav>
            </div>
        </header>

        <main>
            <section>
                <p class="section-divider">Свободни маси</p>
                <div class="cards">
                    @foreach($free_tables as $table)
                        <form style="display: flex" hx-post="/tables/reserve">
                            <button id="table-{{$table->id}}" class="card">
                                <h1 class="card-title">Маса {{ $table->name }}</h1>
                                <p>{{ $table->capacity }} места</p>
                            </button>
                        </form>
                    @endforeach
                </div>
            </section>

            <section>
                <p class="section-divider">Заети маси</p>
                <div class="cards">
                    @foreach($taken_tables as $table)
                        <div class="card">
                            <h1 class="card-title">Маса {{ $table->name }}</h1>
                            <p>{{ $table->capacity }} места</p>
                        </div>
                    @endforeach
                </div>
            </section>
        </main>
    </body>
</html>
