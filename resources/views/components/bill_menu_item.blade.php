@isset ($is_oob)
<div id="menu-items" hx-swap-oob="beforeend">
@endisset
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
@isset ($is_oob)
</div>
@endisset
