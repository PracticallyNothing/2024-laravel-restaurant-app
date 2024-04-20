<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    @include('components.head', ["subtitle" => "Поръчкa $bill->id"])

<body hx-headers='{"X-CSRF-TOKEN": "{{csrf_token()}}"}'>
    @include("components.header", ["subtitle" => "Поръчкa $bill->id (за маса " . $bill->table()->first()->name . ")"])

    <div class="split-60-40 with-border">
        <main style="height: 100%">
            <div style="display: flex;
                        flex-direction: row;
                        justify-content: space-between;
                        padding-left: 10px;
                        padding-right: 10px;
                        align-items: center">
                <div class="title-and-subtitle">
                    <h1>Поръчка за Маса {{ $bill->table()->first()->name }}</h1>
                    <p>Общо: {{ $bill->total() }} лв.</p>
                </div>
                <div>
                    <button hx-post="/bills/{{ $bill->id }}/close"
                            hx-confirm="Маркирай сметка като платена и я затвори?">
                        Завърши поръчка
                    </button>
                </div>
            </div>
            <hr>

            <div id="menu-items" class="cards cards-2">
                @foreach($bill->menuItems()->get() as $menuItem)
                    <div class="card" id="menu-item-{{ $menuItem->id }}">
                        <h3 class="card-title">{{ $menuItem->name }}</h3>
                        <p class="card-content">
                            {{ $menuItem->pivot->quantity }} x {{ number_format($menuItem->price_bgn, 2, '.', '') }} лв.
                        </p>
                        <div class="card-actions">
                            <form class="action-form"
                                hx-target="#menu-item-{{ $menuItem->id }}"
                                hx-swap="outerHTML"
                                hx-post="/bills/{{ $bill->id }}/{{ $menuItem->id }}/update_amount">
                                <input type="hidden" name="quantity" value="-5"/>
                                <button class="action">-5</button>
                            </form>

                            <form class="action-form"
                                hx-target="#menu-item-{{ $menuItem->id }}"
                                hx-swap="outerHTML"
                                hx-post="/bills/{{ $bill->id }}/{{ $menuItem->id }}/update_amount">
                                <input type="hidden" name="quantity" value="-1"/>
                                <button class="action">-1</button>
                            </form>

                            <form class="action-form"
                                hx-target="#menu-item-{{ $menuItem->id }}"
                                hx-swap="outerHTML"
                                hx-post="/bills/{{ $bill->id }}/{{ $menuItem->id }}/update_amount">
                                <input type="hidden" name="quantity" value="1"/>
                                <button type="submit" class="action">+1</button>
                            </form>

                            <form class="action-form"
                                hx-target="#menu-item-{{ $menuItem->id }}"
                                hx-swap="outerHTML"
                                hx-post="/bills/{{ $bill->id }}/{{ $menuItem->id }}/update_amount">
                                <input type="hidden" name="quantity" value="5"/>
                                <button type="submit" class="action">+5</button>
                            </form>

                            <form class="action-form"
                                hx-target="#menu-item-{{ $menuItem->id }}"
                                hx-swap="delete"
                                hx-delete="/bills/{{ $bill->id }}/{{ $menuItem->id }}"
                                hx-confirm="Сигурни ли сте, че искате да премахнете артикула от сметката?">
                                <button type="submit" class="action">❌</button>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>
        </main>

        <div style="height: 100%">
            <aside style="height: 100%;">
                <p>Меню</p>
                <hr>

                <div class="cards-list" style="overflow-y: auto; flex: 1">
                    @foreach($menu_items as $item)
                        <button hx-swap="delete" hx-post="/bills/{{ $bill->id }}/add/{{ $item->id }}" class="card">
                            <h1 class="card-title"> {{ $item->name }} </h1>
                            <p class="card-content">
                                {{ number_format($item->price_bgn, 2, '.', '') }} лв.
                            </p>
                            <p class="card-trailing">
                                +
                            </p>
                        </button>
                    @endforeach
                </div>
            </aside>
        </div>
    </div>
</body>

</html>
