<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    @include('components.head', ["subtitle" => 'Настройки заведение'])

    <body hx-headers='{"X-CSRF-TOKEN": "{{csrf_token()}}"}'>
        @include("components.header", ["subtitle" => 'Настройки заведение'])

        <form style="margin-top: 10px">
            <fieldset style="display: flex; flex-direction: column; gap: 10px; width: 80ch; margin: 0 auto;">
                <legend style="font-weight: bold">Настройки заведение</legend>

                <label for="restaurant-name" style="margin-bottom: -10px;"> Име на заведение: </label>
                <input type="text" id="restaurant-name" name="name">

                <br>

                <label for="logo" style="margin-bottom: -10px;"> Лого на заведение: </label>
                <input type="file" id="logo" name="logo">

                <br>

                <div style="display: flex; flex-direction: row; justify-content: center; gap: 8px">
                    <button>Възстанови</button>
                    <input type="submit" value="Запиши">
                </div>
            </fieldset>
        </form>

        <fieldset style="display: flex; flex-direction: column; gap: 10px; width: 80ch; margin: 0 auto;">
            <legend style="font-weight: bold">Редактирай маси</legend>

            <div class="split-60-40 with-border">
                @include('components.edit_table')

                <aside>

                    <div style="height: 400px; overflow-y: scroll;" class="cards-list">
                        <button hx-swap="none" hx-get="/tables/create" class="card">
                            <p class="card-leading">➕</p>

                            <h1 class="card-title">Нова маса</h1>
                            <p style="font-style: italic" class="card-content">Създай нова маса</p>
                        </button>

                        @foreach($tables as $table)
                            <a
                               id="table-{{$table->id}}"
                               hx-swap="none"
                               hx-get="/tables/{{ $table->id }}/edit"
                               class="card">
                                <button
                                    onclick="event.preventDefault(); event.stopPropagation();"
                                    hx-delete="/tables/{{ $table->id }}"
                                    hx-swap="delete"
                                    hx-target="#table-{{ $table->id }}"
                                    hx-confirm="Сигурни ли сте, че искате да изтриете тази маса?"
                                    class="card-trailing">
                                    ❌
                                </button>

                                <span class="card-leading">✏️</span>
                                <b class="card-title"> Маса {{ $table->name }} </b>
                                <span class="card-content"> {{ $table->capacity }} места </span>
                            </a>
                        @endforeach
                    </div>
                </aside>
            </div>
        </fieldset>

        <fieldset style="display: flex; flex-direction: column; gap: 10px; width: 80ch; margin: 0 auto;">
            <legend style="font-weight: bold">Редактирай меню</legend>

            <div class="split-60-40 with-border">
                <aside>
                    <div style="height: 400px; overflow-y: scroll;" class="cards-list">
                        <button hx-swap="none" hx-get="/menu_items/create" class="card">
                            <p class="card-leading">➕</p>

                            <h1 class="card-title">Нов артикул</h1>
                            <p style="font-style: italic" class="card-content">Създай нов артикул</p>
                        </button>

                        @foreach($menu_items as $item)
                            <a
                               id="menu-item-{{$item->id}}"
                               hx-swap="none"
                               hx-get="/menu_items/{{ $item->id }}/edit"
                               class="card">
                                <button
                                    onclick="event.preventDefault(); event.stopPropagation();"
                                    hx-delete="/menu_items/{{ $item->id }}"
                                    hx-swap="delete"
                                    hx-target="#menu-item-{{ $item->id }}"
                                    hx-confirm="Сигурни ли сте, че искате да изтриете този артикул?"
                                    class="card-trailing">
                                    ❌
                                </button>

                                <span class="card-leading">✏️</span>
                                <b class="card-title"> {{ $item->name }} </b>
                                <span class="card-content">
                                    {{ number_format($item->price_bgn, 2, '.', '') }} лв.
                                </span>

                            </a>
                        @endforeach
                    </div>
                </aside>

                @include('components.edit_menu_item')
            </div>
        </fieldset>

        <div style="height: 20px;"></div>
   </body>
</html>
