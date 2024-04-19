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

                            <div class="card-trailing">
                                <h1>&gt;</h1>
                            </div>
                        </a>
                    @endforeach
                </div>
            </section>
        </main>
    </body>
</html>
