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
                    <button>Завърши поръчка</button>
                </div>
            </div>
            <hr>
        </main>

        <div style="height: 100%">
            <aside style="height: 100%;">
                <p>Меню</p>
                <hr>

                <div class="cards-list" style="overflow-y: auto; flex: 1">
                    @foreach($menu_items as $item)
                        <button hx-post="/bills/{{ $bill->id }}/add/{{ $item->id }}" class="card">
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
