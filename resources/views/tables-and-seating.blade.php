<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    @include('components.head', ["subtitle" => 'Поръчки'])

    <body hx-headers='{"X-CSRF-TOKEN": "{{csrf_token()}}"}'>
        @include("components.header", ["subtitle" => 'Маси и настаняване'])

        <main>
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <section>
                <p class="section-divider">Свободни маси</p>
                <div class="cards">
                    @foreach($free_tables as $table)
                        <form style="display: flex"
                              hx-post="/bills/create"
                              hx-confirm="Сигурни ли сте, че искате да маркирате маса {{ $table->name }} като заета?">
                            @csrf
                            <input type="hidden" name="table_id" value="{{ $table->id }}">
                            <button class="card" type="submit" >
                                <h1 class="card-title">Маса {{ $table->name }}</h1>
                                <p class="card-content">{{ $table->capacity }} места</p>
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
                            <p class="card-content">{{ $table->capacity }} места</p>
                        </div>
                    @endforeach
                </div>
            </section>
        </main>
    </body>
</html>
