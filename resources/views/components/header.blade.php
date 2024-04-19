<header>
    <div class="flex-row">
        <div class="title-and-subtitle">
            <h1>🍽️ RestoPro</h1>
            @if($subtitle != null)
                <h4>{{$subtitle}}</h4>
            @else
                <h4 style="color: transparent">x</h4>
            @endif
        </div>

        <nav>
            <ul>
                <li><a href="/hub">
                    <span>Hub</span>
                </a></li>

                <li><a href="/tables-and-seating">
                    <span>Маси и настаняване</span>
                </a></li>

                <li><a href="/orders">
                    <span>Поръчки</span>
                </a></li>

                <li><a href="/analytics">
                    <span>Статистики</span>
                </a></li>

                <li><a href="/settings" >
                    <span>Настройки </span>
                </a></li>
            </ul>
        </nav>
    </div>

    <form method="POST" action="/logout">
        @csrf
        <button class="danger-outlined" type="submit">Logout</button>
    </form>
</header>
