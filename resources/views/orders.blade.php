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
        </main>
        <script>

        </script>
    </body>
</html>
