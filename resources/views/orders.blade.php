<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    @include('components.head', ["subtitle" => 'Поръчки'])

    <body hx-headers='{"X-CSRF-TOKEN": "{{csrf_token()}}"}'>
        @include("components.header", ["subtitle" => 'Поръчки'])

        <main>
            <section>
                <p class="section-divider">Активни поръчки</p>

                <div class="orders-list cards">
                    @foreach($openBills as $bill)
                        <a href="/orders/{{ $bill->id }}" class="card">
                            <div class="card-leading green-dot">
                                <div></div>
                            </div>

                            <h1 class="card-title">Маса {{ $bill->table()->first()->name }}</h1>
                            <p class="card-content"> Създадена: {{ $bill->humanReadableAge() }} </p>

                            <div class="card-trailing" style="width: max-content; text-align: center">
                                <b>Общо:</b>
                                <br/>
                                <span>{{ $bill->totalFormatted() }} лв</span>
                            </div>

                            <div class="card-actions">
                                <button
                                    onclick="event.preventDefault(); event.stopPropagation();"
                                    hx-post="/bills/{{$bill->id}}/close"
                                    hx-confirm="Маркирай сметка като платена и я затвори?"
                                    class="action">💲</button>
                                <!-- <button onclick="alert('aaaaaa')" class="action">❌</button> -->
                            </div>
                        </a>
                    @endforeach
                </div>
            </section>

            <section>
                <p class="section-divider">Затворени поръчки</p>

                <div class="orders-list cards">
                    @foreach($closedBills as $bill)
                        <a class="card"
                            @if ($bill->table()->first() != null)
                              href="/orders/{{ $bill->id }}"
                            @endif
                        >
                            @if ($bill->table()->first() == null)
                                <h1 class="card-title">[Изтрита маса]</h1>
                            @else
                                <h1 class="card-title">Маса {{ $bill->table()->first()->name }}</h1>
                            @endif

                            <div class="card-content">
                                <p style="margin: 0"> Създадена: {{ $bill->humanReadableAge() }} </p>

                                @if (sizeof($bill->menuItems()->get()) == 0)
                                    <p style="margin-bottom: 0"><i>Нищо не беше поръчано...</i></p>
                                @else
                                    <p style="margin-bottom: 0"> Поръчано: </p>
                                    <ul style="margin-top: 0; margin-bottom: 0; padding-left: 1em">
                                        @foreach($bill->menuItems()->get() as $item)
                                        <li><b>{{ $item->name }}</b>:
                                                @if($item->proxy == null)
                                                    {{ $item->price_bgn_formatted() }} лв.
                                                @else
                                                    {{ $item->proxy }} &times; {{ $item->price_bgn_formatted() }} лв.
                                                @endif
                                            </li>
                                        @endforeach
                                    </ul>
                                @endif

                            </div>

                            <div class="card-trailing" style="width: max-content; text-align: center">
                                <b>Общо:</b>
                                <br/>
                                <span>{{ $bill->totalFormatted() }} лв</span>
                            </div>
                        </a>
                    @endforeach
                </div>
            </section>
        </main>
        <script>

        </script>
    </body>
</html>
